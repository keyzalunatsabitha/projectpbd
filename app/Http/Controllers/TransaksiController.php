<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
// --- PENERIMAAN STOK ---
    public function penerimaanIndex()
    {
        // Ambil daftar pengadaan yang masih berstatus Diproses ('P') beserta detail barang & sisa yang belum diterima
        $pengadaanDiproses = DB::table('pengadaan as p')
            ->join('vendor as v', 'p.vendor_idvendor', '=', 'v.idvendor')
            ->select(
                'p.idpengadaan',
                'p.timestamp as tanggal_pengadaan',
                'v.nama_vendor',
                'p.total_nilai'
            )
            ->where('p.status',['D', 'P'])
            ->orderBy('p.idpengadaan', 'desc')
            ->get()
            ->map(function ($po) {
                $po->items = DB::table('detail_pengadaan as dp')
                    ->join('barang as b', 'dp.idbarang', '=', 'b.idbarang')
                    ->leftJoin('satuan as s', 'b.idsatuan', '=', 's.idsatuan')
                    ->where('dp.idpengadaan', $po->idpengadaan)
                    ->select(
                        'dp.idbarang',
                        'b.nama as nama_barang',
                        's.nama_satuan',
                        'dp.jumlah as jumlah_pesan',
                        'dp.harga_satuan',
                        DB::raw('(
                            SELECT COALESCE(SUM(dpr.jumlah_terima), 0)
                            FROM detail_penerimaan dpr
                            JOIN penerimaan pr ON dpr.idpenerimaan = pr.idpenerimaan
                            WHERE pr.idpengadaan = dp.idpengadaan
                              AND dpr.barang_idbarang = dp.idbarang
                        ) as sudah_diterima')
                    )
                    ->get()
                    ->map(function ($item) {
                        $item->sisa = max(0, $item->jumlah_pesan - $item->sudah_diterima);
                        return $item;
                    })
                    ->filter(function ($item) {
                        return $item->sisa > 0;
                    })
                    ->values();

                return $po;
            })
            ->filter(function ($po) {
                return $po->items->count() > 0;
            })
            ->values();

        // Pakai view mutasistok
        $kartuStok = DB::table('mutasistok')
            ->select(
                'idkartu_stok',
                'tanggal as created_at',
                'barang',
                'jenis_transaksi',
                'masuk',
                'stok_akhir as stock'
            )
            ->orderBy('idkartu_stok', 'desc')
            ->limit(10)
            ->get();

        return view('penerimaan', compact('pengadaanDiproses', 'kartuStok'));
    }

    public function penerimaanStore(Request $request)
    {
        $request->validate([
            'idpengadaan' => 'required|integer|exists:pengadaan,idpengadaan',
            'idbarang'    => 'required|integer|exists:barang,idbarang',
            'jumlah'      => 'required|integer|min:1',
            'harga'       => 'required|numeric|min:1',
        ]);

        $idpengadaan = (int) $request->idpengadaan;
        $idbarang    = (int) $request->idbarang;
        $jumlah      = (int) $request->jumlah;
        $harga       = (int) $request->harga;
        $subtotal    = $jumlah * $harga;
        $iduser      = session('iduser');

        // Validasi apakah barang memang ada di PO tersebut dan tidak melebihi sisa pesanan
        $detailPO = DB::table('detail_pengadaan')
            ->where('idpengadaan', $idpengadaan)
            ->where('idbarang', $idbarang)
            ->first();

        if (!$detailPO) {
            return back()->with('message', 'Gagal: Barang tersebut tidak terdaftar pada #PO-' . $idpengadaan);
        }

        $sudahDiterima = DB::table('detail_penerimaan as dpr')
            ->join('penerimaan as pr', 'dpr.idpenerimaan', '=', 'pr.idpenerimaan')
            ->where('pr.idpengadaan', $idpengadaan)
            ->where('dpr.barang_idbarang', $idbarang)
            ->sum('dpr.jumlah_terima');

        $sisa = $detailPO->jumlah - $sudahDiterima;
        if ($jumlah > $sisa) {
            return back()->with('message', 'Gagal: Jumlah diterima (' . $jumlah . ') melebihi sisa pesanan PO (' . $sisa . ').');
        }

        try {
            $statusBaru = 'Diproses';

            DB::transaction(function () use ($idpengadaan, $idbarang, $jumlah, $harga, $subtotal, $iduser, &$statusBaru) {
                // 1. Insert ke header penerimaan merujuk ke idpengadaan yang sudah ada
                $idpenerimaan = DB::table('penerimaan')->insertGetId([
                    'status'      => '1',
                    'idpengadaan' => $idpengadaan,
                    'iduser'      => $iduser,
                ]);

                // 2. Insert ke detail_penerimaan (Trigger kartu_stok otomatis jalan)
                DB::table('detail_penerimaan')->insert([
                    'idpenerimaan'        => $idpenerimaan,
                    'barang_idbarang'     => $idbarang,
                    'jumlah_terima'       => $jumlah,
                    'harga_satuan_terima' => $harga,
                    'sub_total_terima'    => $subtotal,
                ]);

                // 3. Cek apakah SEMUA barang pada PO ini sudah diterima 100%
                $totalDipesan = DB::table('detail_pengadaan')
                    ->where('idpengadaan', $idpengadaan)
                    ->sum('jumlah');

                $totalDiterimaSemua = DB::table('detail_penerimaan as dpr')
                    ->join('penerimaan as pr', 'dpr.idpenerimaan', '=', 'pr.idpenerimaan')
                    ->where('pr.idpengadaan', $idpengadaan)
                    ->sum('dpr.jumlah_terima');

                if ($totalDiterimaSemua >= $totalDipesan) {
                    DB::table('pengadaan')
                        ->where('idpengadaan', $idpengadaan)
                        ->update(['status' => 'S']);
                    $statusBaru = 'Selesai';
                }
            });

            return back()->with('message', 'Penerimaan #PO-' . $idpengadaan . ' berhasil disimpan! Status PO saat ini: ' . $statusBaru . '.');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal menyimpan penerimaan: ' . $e->getMessage());
        }
    }

    // --- KASIR PENJUALAN ---
    public function penjualanIndex()
    {
        // Pakai view detailbarang
        $barangList = DB::table('detailbarang')
            ->select(
                'idbarang',
                'nama',
                'harga',
                'harga_jual_estimasi as harga_jual',
                'stok as stok_saat_ini'
            )
            ->where('status', 'Aktif')
            ->get();

        // Pakai view penjualanheader & detailpenjualan
        $riwayatPenjualan = DB::table('penjualanheader as ph')
            ->join('detailpenjualan as dp', 'ph.idpenjualan', '=', 'dp.idpenjualan')
            ->select(
                'ph.idpenjualan',
                'ph.tanggal_terjual as created_at',
                'dp.nama as barang',
                'dp.jumlah',
                'ph.total_nilai'
            )
            ->orderBy('ph.idpenjualan', 'desc')
            ->limit(5)
            ->get();

        return view('penjualan', compact('barangList', 'riwayatPenjualan'));
    }

    public function penjualanStore(Request $request)
    {
        $request->validate([
            'idbarang' => 'required|integer',
            'jumlah'   => 'required|integer|min:1',
        ]);

        try {
            $iduser     = (int) session('iduser');
            $ppn_persen = 11.0;

            DB::statement('CALL sp_transaksi_penjualan(?, ?, ?, ?)', [
                $iduser,
                (int) $request->idbarang,
                (int) $request->jumlah,
                $ppn_persen
            ]);

            return back()->with('message', 'Transaksi Penjualan Berhasil! Stored Procedure dipanggil dan Stok otomatis terpotong via Trigger.');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal Transaksi: ' . $e->getMessage());
        }
    }

    // --- RETUR BARANG KE VENDOR ---
    public function returIndex()
    {
        // Ambil riwayat retur dari View detailretur
        $riwayatRetur = DB::table('detailretur')
            ->orderBy('idretur', 'desc')
            ->get();

        // Ambil daftar penerimaan dari View detailpenerimaan & penerimaanheader untuk dropdown form
        $listPenerimaan = DB::table('detailpenerimaan as dp')
            ->join('penerimaanheader as ph', 'dp.idpenerimaan', '=', 'ph.idpenerimaan')
            ->select(
                'dp.iddetail_penerimaan',
                'dp.idpenerimaan',
                'ph.tanggal_terima',
                'ph.nama_vendor',
                'dp.nama_barang',
                'dp.jumlah_terima'
            )
            ->orderBy('dp.iddetail_penerimaan', 'desc')
            ->get();

        return view('retur', compact('riwayatRetur', 'listPenerimaan'));
    }

    public function returStore(Request $request)
    {
        $request->validate([
            'iddetail_penerimaan' => 'required|integer|exists:detail_penerimaan,iddetail_penerimaan',
            'jumlah'              => 'required|integer|min:1',
            'alasan'              => 'nullable|string|max:200',
        ]);

        $iduser = session('iduser');

        // 1. Cek detail penerimaan & sisa stok saat ini sebelum insert (karena trigger retur tidak punya cek stok)
        $detailTerima = DB::table('detail_penerimaan')
            ->where('iddetail_penerimaan', $request->iddetail_penerimaan)
            ->first();

        if ($request->jumlah > $detailTerima->jumlah_terima) {
            return back()->with('message', 'Gagal Retur: Jumlah retur melebihi jumlah barang yang diterima (' . $detailTerima->jumlah_terima . ').');
        }

        $stokTerakhir = DB::table('kartu_stok')
            ->where('idbarang', $detailTerima->barang_idbarang)
            ->orderBy('idkartu_stok', 'desc')
            ->value('stock') ?? 0;

        if ($request->jumlah > $stokTerakhir) {
            return back()->with('message', 'Gagal Retur: Stok saat ini tidak mencukupi (Sisa stok: ' . $stokTerakhir . ').');
        }

        try {
            DB::transaction(function () use ($request, $detailTerima, $iduser) {
                // 2. Insert Header Retur
                $idretur = DB::table('retur')->insertGetId([
                    'idpenerimaan' => $detailTerima->idpenerimaan,
                    'iduser'       => $iduser,
                ]);

                // 3. Insert Detail Retur (Trigger trigger_afterinsertdetailretur otomatis jalan & potong stok 'R')
                DB::table('detail_retur')->insert([
                    'jumlah'              => $request->jumlah,
                    'alasan'              => $request->alasan,
                    'idretur'             => $idretur,
                    'iddetail_penerimaan' => $request->iddetail_penerimaan,
                ]);
            });

            return back()->with('message', 'Retur barang berhasil dicatat! Stok otomatis berkurang via Trigger.');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal menyimpan retur: ' . $e->getMessage());
        }
    }

    // --- KARTU STOK (MUTASI STOK) ---
   // --- KARTU STOK (MUTASI STOK) ---
    public function kartuStokIndex()
    {
        $mutasiStok = DB::table('mutasistok')
            ->orderBy('idkartu_stok', 'desc')
            ->get();

        return view('kartustok', compact('mutasiStok'));
    }
}

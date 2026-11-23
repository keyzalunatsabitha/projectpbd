<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        // Langsung membaca dari VIEW `transaksipengadaan` milikmu
        $listPengadaan = DB::table('transaksipengadaan')
            ->orderByDesc('idpengadaan')
            ->get();

        return view('pengadaan.index', compact('listPengadaan'));
    }

    public function create()
    {
        // Ambil vendor aktif (status = '1' atau 1)
        $vendors = DB::table('vendor')
            ->where('status', '1')
            ->orWhere('status', 1)
            ->get();

        // Ambil barang aktif beserta satuannya
        $barangs = DB::table('barang as b')
            ->leftJoin('satuan as s', 'b.idsatuan', '=', 's.idsatuan')
            ->select('b.idbarang', 'b.nama', 'b.harga', 's.nama_satuan')
            ->where('b.status', 1)
            ->get();

        return view('pengadaan.create', compact('vendors', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_idvendor'      => 'required|integer',
            'items'                => 'required|array|min:1',
            'items.*.idbarang'     => 'required|integer',
            'items.*.jumlah'       => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += ($item['harga_satuan'] * $item['jumlah']);
            }

            // PPN 10% (sesuaikan jika 11%)
            $ppn = round($subtotal * 0.10);
            $total = $subtotal + $ppn;

            // Ambil iduser dari session login
            $idUser = session('iduser')
                ?? DB::table('user')->where('username', session('username'))->value('iduser')
                ?? 1;

            // 1. Insert ke tabel `pengadaan` dengan status 'D' (Diproses) sesuai VIEW kamu
            $idPengadaan = DB::table('pengadaan')->insertGetId([
                'timestamp'       => now(),
                'user_iduser'     => $idUser,
                'status'          => 'D',
                'vendor_idvendor' => $request->vendor_idvendor,
                'subtotal_nilai'  => $subtotal,
                'ppn'             => $ppn,
                'total_nilai'     => $total,
            ]);

            // 2. Insert ke tabel `detail_pengadaan`
            foreach ($request->items as $item) {
                $subItem = $item['harga_satuan'] * $item['jumlah'];
                DB::table('detail_pengadaan')->insert([
                    'harga_satuan' => $item['harga_satuan'],
                    'jumlah'       => $item['jumlah'],
                    'sub_total'    => $subItem,
                    'idbarang'     => $item['idbarang'],
                    'idpengadaan'  => $idPengadaan,
                ]);
            }
        });

        return redirect()->route('pengadaan.index')->with('success', 'PO Pengadaan berhasil dibuat!');
    }

    public function show($id)
    {
        // Header dari VIEW `transaksipengadaan`
        $pengadaan = DB::table('transaksipengadaan')
            ->where('idpengadaan', $id)
            ->first();

        abort_if(!$pengadaan, 404);

        // Detail item dari VIEW `detailpengadaan`
        $details = DB::table('detailpengadaan')
            ->where('idpengadaan', $id)
            ->get();

        return view('pengadaan.show', compact('pengadaan', 'details'));
    }

    public function cancel($id)
    {
        // Ubah status menjadi 'C' (Dibatalkan) sesuai CASE di VIEW `transaksipengadaan`
        DB::table('pengadaan')
            ->where('idpengadaan', $id)
            ->where('status', 'D')
            ->update(['status' => 'C']);

        return redirect()->route('pengadaan.index')->with('success', 'Pengadaan #PO-' . $id . ' dibatalkan.');
    }
}

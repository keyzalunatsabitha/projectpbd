<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function katalog()
    {
        $stokBarang = DB::table('detailbarang')
            ->select(
                'idbarang',
                'nama as nama_barang',
                'nama_satuan',
                'harga as harga_modal',
                'harga_jual_estimasi as harga_jual_rekomendasi',
                'stok as stok_saat_ini'
            )
            ->get();

        return view('katalog', compact('stokBarang'));
    }

    public function users()
    {
        $users = DB::table('userrole')->get();
        return view('users', compact('users'));
    }

    public function index()
    {
        $barangs = DB::table('detailbarang')->get();
    $satuans = DB::table('satuan')->where('status', 1)->get();
        return view('barang.index', compact('barangs', 'satuans'));
    }

    public function create()
    {
        // Ambil hanya satuan yang aktif (status = 1)
        $satuans = DB::table('satuan')->where('status', 1)->get();
        return view('barang.create', compact('satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis'    => 'required|max:1',
            'nama'     => 'required|max:45',
            'idsatuan' => 'required|exists:satuan,idsatuan',
            'status'   => 'required|in:0,1',
            'harga'    => 'required|integer|min:0',
        ]);

        DB::table('barang')->insert([
            'jenis'    => $request->jenis,
            'nama'     => $request->nama,
            'idsatuan' => $request->idsatuan,
            'status'   => $request->status,
            'harga'    => $request->harga,
        ]);

        return redirect()->route('master.barang.index')->with('message', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang  = DB::table('barang')->where('idbarang', $id)->first();
        $satuans = DB::table('satuan')->get();
        return view('barang.edit', compact('barang', 'satuans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis'    => 'required|max:1',
            'nama'     => 'required|max:45',
            'idsatuan' => 'required|exists:satuan,idsatuan',
            'status'   => 'required|in:0,1',
            'harga'    => 'required|integer|min:0',
        ]);

        DB::table('barang')->where('idbarang', $id)->update([
            'jenis'    => $request->jenis,
            'nama'     => $request->nama,
            'idsatuan' => $request->idsatuan,
            'status'   => $request->status,
            'harga'    => $request->harga,
        ]);

        return redirect()->route('master.barang.index')->with('message', 'Barang berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            DB::table('barang')->where('idbarang', $id)->delete();
            return redirect()->route('master.barang.index')->with('message', 'Barang berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal hapus! Barang sudah ada di riwayat transaksi.');
        }
    }
}

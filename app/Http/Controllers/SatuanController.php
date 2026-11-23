<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = DB::table('satuan')->get();
        return view('satuan.index', compact('satuans'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|max:45',
            'status'      => 'required|in:0,1',
        ]);

        DB::table('satuan')->insert([
            'nama_satuan' => $request->nama_satuan,
            'status'      => $request->status,
        ]);

        return redirect()->route('master.satuan.index')->with('message', 'Satuan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $satuan = DB::table('satuan')->where('idsatuan', $id)->first();
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satuan' => 'required|max:45',
            'status'      => 'required|in:0,1',
        ]);

        DB::table('satuan')->where('idsatuan', $id)->update([
            'nama_satuan' => $request->nama_satuan,
            'status'      => $request->status,
        ]);

        return redirect()->route('master.satuan.index')->with('message', 'Satuan berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            DB::table('satuan')->where('idsatuan', $id)->delete();
            return redirect()->route('master.satuan.index')->with('message', 'Satuan berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal hapus! Satuan masih dipakai oleh Barang.');
        }
    }
}

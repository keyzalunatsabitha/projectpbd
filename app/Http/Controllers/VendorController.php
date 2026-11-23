<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = DB::table('vendor')->get();
        return view('vendor.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|max:100',
            'badan_hukum' => 'required|max:1',
            'status'      => 'required|max:1',
        ]);

        DB::table('vendor')->insert([
            'nama_vendor' => $request->nama_vendor,
            'badan_hukum' => $request->badan_hukum,
            'status'      => $request->status,
        ]);

        return redirect()->route('master.vendor.index')->with('message', 'Vendor berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $vendor = DB::table('vendor')->where('idvendor', $id)->first();
        return view('vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_vendor' => 'required|max:100',
            'badan_hukum' => 'required|max:1',
            'status'      => 'required|max:1',
        ]);

        DB::table('vendor')->where('idvendor', $id)->update([
            'nama_vendor' => $request->nama_vendor,
            'badan_hukum' => $request->badan_hukum,
            'status'      => $request->status,
        ]);

        return redirect()->route('master.vendor.index')->with('message', 'Vendor berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            DB::table('vendor')->where('idvendor', $id)->delete();
            return redirect()->route('master.vendor.index')->with('message', 'Vendor berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal hapus! Vendor memiliki riwayat pengadaan.');
        }
    }
}

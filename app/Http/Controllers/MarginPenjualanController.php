<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarginPenjualanController extends Controller
{
    public function index()
    {
        $margins = DB::table('margin_penjualan as m')
            ->leftJoin('user as u', 'm.iduser', '=', 'u.iduser')
            ->select('m.*', 'u.username as pengatur')
            ->orderBy('m.persen', 'asc')
            ->get();

        return view('margin.index', compact('margins'));
    }

    public function create()
    {
        return view('margin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'persen' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        $iduser = session('iduser', 1);

        DB::transaction(function () use ($request, $iduser) {
            // Jika margin baru diset aktif (1), nonaktifkan margin lain
            if ($request->status == 1) {
                DB::table('margin_penjualan')->update(['status' => 0]);
            }

            DB::table('margin_penjualan')->insert([
                'persen'     => $request->persen,
                'status'     => $request->status,
                'iduser'     => $iduser,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return redirect()->route('master.margin.index')->with('message', 'Margin penjualan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $margin = DB::table('margin_penjualan')->where('idmargin_penjualan', $id)->first();
        return view('margin.edit', compact('margin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'persen' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        $iduser = session('iduser', 1);

        DB::transaction(function () use ($request, $id, $iduser) {
            if ($request->status == 1) {
                DB::table('margin_penjualan')->update(['status' => 0]);
            }

            DB::table('margin_penjualan')->where('idmargin_penjualan', $id)->update([
                'persen'     => $request->persen,
                'status'     => $request->status,
                'iduser'     => $iduser,
                'updated_at' => now(),
            ]);
        });

        return redirect()->route('master.margin.index')->with('message', 'Margin penjualan berhasil diupdate!');
    }

    public function destroy($id)
    {
        DB::table('margin_penjualan')->where('idmargin_penjualan', $id)->delete();
        return redirect()->route('master.margin.index')->with('message', 'Margin penjualan berhasil dihapus!');
    }

    public function aktifkan($id)
{
    $iduser = session('iduser', 1);

    DB::transaction(function () use ($id, $iduser) {
        // Matikan semua margin terlebih dahulu
        DB::table('margin_penjualan')->update(['status' => 0]);

        // Aktifkan margin yang dipilih
        DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->update([
                'status'     => 1,
                'iduser'     => $iduser,
                'updated_at' => now(),
            ]);
    });

    return redirect()->route('master.margin.index')->with('message', 'Margin penjualan berhasil diaktifkan!');
}
}

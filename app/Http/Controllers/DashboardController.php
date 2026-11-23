<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $listMargin = DB::table('margin_penjualan as m')
            ->leftJoin('user as u', 'm.iduser', '=', 'u.iduser')
            ->select('m.idmargin_penjualan', 'm.persen', 'm.status', 'u.username as pengatur')
            ->orderBy('m.persen', 'asc')
            ->get();

        $marginAktif = $listMargin->firstWhere('status', 1);

        // Diganti dari barangsatuan ke detailbarang
        $listBarang = DB::table('detailbarang')
            ->select(
                'idbarang',
                'nama as nama_barang',
                'jenis',
                'nama_satuan as satuan',
                'harga'
            )
            ->get();

        return view('dashboard', compact('listMargin', 'marginAktif', 'listBarang'));
    }

    public function updateMargin(Request $request)
    {
        $idmargin = (int) $request->idmargin_penjualan;
        $iduser   = session('iduser', 1);

        DB::transaction(function () use ($idmargin, $iduser) {
            DB::table('margin_penjualan')->update(['status' => 0]);

            DB::table('margin_penjualan')
                ->where('idmargin_penjualan', $idmargin)
                ->update([
                    'status'     => 1,
                    'iduser'     => $iduser,
                    'updated_at' => now(),
                ]);
        });

        return redirect()->route('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = DB::table('role')->get();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_role' => 'required|max:100']);

        DB::table('role')->insert([
            'nama_role' => $request->nama_role
        ]);

        return redirect()->route('master.role.index')->with('message', 'Role berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $role = DB::table('role')->where('idrole', $id)->first();
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_role' => 'required|max:100']);

        DB::table('role')->where('idrole', $id)->update([
            'nama_role' => $request->nama_role
        ]);

        return redirect()->route('master.role.index')->with('message', 'Role berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            DB::table('role')->where('idrole', $id)->delete();
            return redirect()->route('master.role.index')->with('message', 'Role berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal hapus! Role masih dipakai oleh User.');
        }
    }
}

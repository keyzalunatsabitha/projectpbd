<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
{
    $users = DB::table('userrole')->get();
    $roles = DB::table('role')->get(); // tetap diperlukan untuk dropdown pilih role di form/modal tambah user

    return view('user.index', compact('users', 'roles'));
}
    public function create()
    {
        $roles = DB::table('role')->get();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:45|unique:user,username',
            'password' => 'required|min:4|max:100',
            'idrole'   => 'required|exists:role,idrole',
        ]);

        DB::table('user')->insert([
            'username' => trim($request->username),
            'password' => Hash::make($request->password),
            'idrole'   => $request->idrole,
        ]);

        return redirect()->route('master.user.index')->with('message', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user  = DB::table('user')->where('iduser', $id)->first();
        $roles = DB::table('role')->get();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|max:45|unique:user,username,' . $id . ',iduser',
            'password' => 'nullable|min:4|max:100',
            'idrole'   => 'required|exists:role,idrole',
        ]);

        $data = [
            'username' => trim($request->username),
            'idrole'   => $request->idrole,
        ];

        // Password hanya diupdate jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('user')->where('iduser', $id)->update($data);

        return redirect()->route('master.user.index')->with('message', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            DB::table('user')->where('iduser', $id)->delete();
            return redirect()->route('master.user.index')->with('message', 'User berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('message', 'Gagal hapus! User sudah tercatat di transaksi.');
        }
    }
}

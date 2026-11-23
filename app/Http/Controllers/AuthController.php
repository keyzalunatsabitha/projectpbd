<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('username')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('user as u')
            ->join('role as r', 'u.idrole', '=', 'r.idrole')
            ->select('u.iduser', 'u.username', 'u.password', 'r.nama_role')
            ->where('u.username', trim($request->username))
            ->first();

        $valid = false;
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $valid = true;
            } elseif (hash_equals($user->password, $request->password)) {
                $valid = true;
            }
        }

        if ($valid) {
            $request->session()->regenerate();
            session([
                'iduser'   => $user->iduser,
                'username' => $user->username,
                'role'     => $user->nama_role,
            ]);

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('pesan', 'Username atau password salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('pesan', 'Anda telah berhasil logout.');
    }
}

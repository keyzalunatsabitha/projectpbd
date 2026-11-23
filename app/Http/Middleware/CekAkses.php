<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAkses
{
    public function handle(Request $request, Closure $next, ...$rolesDiizinkan): Response
    {
        // 1. Cek apakah user sudah login via Session
        if (!session()->has('iduser') || !session()->has('username')) {
            return redirect()->route('login')->with('pesan', 'Anda harus login terlebih dahulu!');
        }

        $username = strtolower(trim(session('username', '')));
        $role     = strtolower(trim(session('role', '')));

        // 2. Daftar Super User & Super Role
        $superUsers = ['admin_dubai', 'manajerdimas', 'owneraluna'];
        $superRoles = ['administrator', 'admin', 'manager', 'manajer', 'owner'];

        if (in_array($username, $superUsers) || in_array($role, $superRoles)) {
            return $next($request);
        }

        // 3. Cek Role Khusus (misal: gudangfira, gudang)
        if (!empty($rolesDiizinkan)) {
            $allowedLower = array_map('strtolower', $rolesDiizinkan);
            if (in_array($username, $allowedLower) || in_array($role, $allowedLower)) {
                return $next($request);
            }
        }

        // 4. Jika ditolak, arahkan tombol kembali sesuai role
$targetRoute = route('dashboard');
        if ($username === 'gudangfira' || $role === 'gudang') {
            $targetRoute = route('penerimaan.index');
        } elseif ($username === 'kasirnala' || $role === 'kasir') {
            $targetRoute = route('penjualan.index');
        }

        return response()->view('errors.akses_ditolak', [
            'username'    => session('username'),
            'targetRoute' => $targetRoute
        ], 403);
    }
}

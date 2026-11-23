<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarginPenjualanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengadaanController;

// 0. Halaman Utama ('/') -> Langsung arahkan ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes[cite: 3]
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// 1. Halaman Umum (Bisa diakses Admin, Manajer, Owner, Gudang, dan Kasir)
Route::middleware(['cek.akses:gudang,kasir'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/katalog', [BarangController::class, 'katalog'])->name('katalog');
    Route::get('/kartu-stok', [TransaksiController::class, 'kartuStokIndex'])->name('kartustok.index'); // <-- Tambahan
});

// 2. Halaman Khusus Gudang (Plus Admin, Manajer, Owner)
Route::middleware(['cek.akses:gudang'])->group(function () {
    Route::get('/penerimaan', [TransaksiController::class, 'penerimaanIndex'])->name('penerimaan.index');
    Route::post('/penerimaan', [TransaksiController::class, 'penerimaanStore'])->name('penerimaan.store');

    // <-- Tambahan Rute Retur
    Route::get('/retur', [TransaksiController::class, 'returIndex'])->name('retur.index');
    Route::post('/retur', [TransaksiController::class, 'returStore'])->name('retur.store');

    // <-- Tambahan Rute Pengadaan
    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
    Route::get('/pengadaan/create', [PengadaanController::class, 'create'])->name('pengadaan.create');
    Route::post('/pengadaan', [PengadaanController::class, 'store'])->name('pengadaan.store');
    Route::get('/pengadaan/{id}', [PengadaanController::class, 'show'])->name('pengadaan.show');
    Route::patch('/pengadaan/{id}/batal', [PengadaanController::class, 'cancel'])->name('pengadaan.cancel');
});

// 3. Halaman Khusus Kasir (Plus Admin, Manajer, Owner)[cite: 6]
Route::middleware(['cek.akses:kasir'])->group(function () {
    Route::get('/penjualan', [TransaksiController::class, 'penjualanIndex'])->name('penjualan.index');
    Route::post('/penjualan', [TransaksiController::class, 'penjualanStore'])->name('penjualan.store');
});

// 4. Halaman Khusus Super Role (Hanya Admin, Manajer, Owner — Gudang & Kasir ditolak)[cite: 6]
Route::middleware(['cek.akses'])->group(function () {
    Route::post('/margin/update', [DashboardController::class, 'updateMargin'])->name('margin.update');

    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('role', RoleController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('satuan', SatuanController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('vendor', VendorController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('user', UserController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('barang', BarangController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('margin', MarginPenjualanController::class)->only(['index', 'store', 'update', 'destroy']);

        Route::patch('margin/{id}/aktifkan', [MarginPenjualanController::class, 'aktifkan'])->name('margin.aktifkan');
    });
});

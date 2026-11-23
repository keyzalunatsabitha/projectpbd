@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --org-bg-cream: #F7F5EB;
        --org-surface-sand: #EBE7D9;
        --org-charcoal: #1C1C1E;
        --org-muted-gray: #6E6D68;
        --org-pastel-pink: #F4B8E4;
        --org-butter-yellow: #F7DC6F;
        --org-sage-green: #9CB370;
        --org-pastel-blue: #B5C7EB;
        --org-border-subtle: rgba(28, 28, 30, 0.08);
    }

    .org-page-wrapper {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        background-color: var(--org-bg-cream);
        color: var(--org-charcoal);
        padding: 1.75rem 1.5rem;
        border-radius: 24px;
        min-height: calc(100vh - 2rem);
    }

    /* Typography */
    .org-page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--org-charcoal);
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .org-page-subtitle {
        font-size: 0.9rem;
        color: var(--org-muted-gray);
        margin-bottom: 0;
    }

    .org-stat-number {
        font-size: 1.85rem;
        font-weight: 800;
        color: var(--org-charcoal);
        line-height: 1.1;
        letter-spacing: -0.03em;
    }

    .org-stat-label {
        font-size: 0.825rem;
        font-weight: 500;
        color: var(--org-muted-gray);
    }

    /* Cards & Containers */
    .org-card {
        background-color: var(--org-bg-cream);
        border: 1px solid var(--org-border-subtle);
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: none !important;
    }

    .org-card-pastel-sage {
        background-color: rgba(156, 179, 112, 0.22);
        border: 1px solid rgba(156, 179, 112, 0.35);
        border-radius: 24px;
        padding: 1.35rem;
    }

    .org-card-pastel-yellow {
        background-color: rgba(247, 220, 111, 0.28);
        border: 1px solid rgba(247, 220, 111, 0.45);
        border-radius: 24px;
        padding: 1.35rem;
    }

    .org-card-pastel-blue {
        background-color: rgba(181, 199, 235, 0.28);
        border: 1px solid rgba(181, 199, 235, 0.45);
        border-radius: 24px;
        padding: 1.35rem;
    }

    /* Icon Circles */
    .org-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .org-icon-circle-sage {
        background-color: var(--org-sage-green);
        color: var(--org-charcoal);
    }

    .org-icon-circle-yellow {
        background-color: var(--org-butter-yellow);
        color: var(--org-charcoal);
    }

    .org-icon-circle-blue {
        background-color: var(--org-pastel-blue);
        color: var(--org-charcoal);
    }

    /* Alert */
    .org-alert {
        background-color: rgba(181, 199, 235, 0.32);
        border: 1px solid rgba(28, 28, 30, 0.1);
        color: var(--org-charcoal);
        border-radius: 24px;
        padding: 0.9rem 1.25rem;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Form Controls */
    .org-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--org-charcoal);
        margin-bottom: 0.45rem;
    }

    .org-input,
    .org-select {
        background-color: var(--org-surface-sand) !important;
        border: 1px solid transparent !important;
        border-radius: 9999px !important;
        padding: 0.65rem 1.15rem !important;
        font-size: 0.9rem !important;
        color: var(--org-charcoal) !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease, background-color 0.2s ease;
    }

    .org-input:focus,
    .org-select:focus {
        border-color: var(--org-charcoal) !important;
        background-color: var(--org-bg-cream) !important;
        outline: none !important;
    }

    /* Buttons */
    .org-btn-primary {
        background-color: var(--org-charcoal);
        color: var(--org-bg-cream);
        border: 1px solid var(--org-charcoal);
        border-radius: 9999px;
        padding: 0.65rem 1.35rem;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        transition: opacity 0.2s ease, transform 0.15s ease;
    }

    .org-btn-primary:hover {
        background-color: #2f2f32;
        color: var(--org-bg-cream);
        opacity: 0.95;
    }

    .org-btn-pill-sm {
        border-radius: 9999px;
        padding: 0.35rem 0.9rem;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        transition: all 0.15s ease;
    }

    .org-btn-yellow {
        background-color: var(--org-butter-yellow);
        color: var(--org-charcoal);
    }

    .org-btn-yellow:hover {
        filter: brightness(0.95);
        color: var(--org-charcoal);
    }

    .org-btn-pink {
        background-color: var(--org-pastel-pink);
        color: var(--org-charcoal);
    }

    .org-btn-pink:hover {
        filter: brightness(0.95);
        color: var(--org-charcoal);
    }

    /* Badges */
    .org-badge {
        border-radius: 9999px;
        padding: 0.35rem 0.85rem;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .org-badge-blue {
        background-color: var(--org-pastel-blue);
        color: var(--org-charcoal);
    }

    .org-badge-id {
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
        font-weight: 600;
    }

    .org-badge-inactive {
        background-color: var(--org-surface-sand);
        color: var(--org-muted-gray);
    }

    /* User Avatar Initial */
    .org-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    /* Table */
    .org-table-wrapper {
        border-radius: 24px;
        border: 1px solid var(--org-border-subtle);
        overflow: hidden;
        background-color: var(--org-bg-cream);
    }

    .org-table {
        margin-bottom: 0;
        color: var(--org-charcoal);
    }

    .org-table thead th {
        background-color: var(--org-surface-sand);
        color: var(--org-muted-gray);
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid var(--org-border-subtle);
        padding: 0.95rem 1.15rem;
    }

    .org-table tbody td {
        padding: 1rem 1.15rem;
        border-bottom: 1px solid var(--org-border-subtle);
        vertical-align: middle;
        background-color: transparent;
    }

    .org-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Modal */
    .org-modal-content {
        background-color: var(--org-bg-cream);
        border: 1px solid var(--org-border-subtle);
        border-radius: 24px !important;
        padding: 0.5rem;
        box-shadow: none !important;
    }

    .org-modal-header,
    .org-modal-footer {
        border-color: var(--org-border-subtle);
    }

    /* SVG Lock */
    .org-svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
@php
    $totalUsers = $users->count();
    $totalRoles = $roles->count();
    $latestUser = $users->last();
@endphp

<div class="org-page-wrapper">
    <!-- Bagian 1: Page Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="org-page-title">Manajemen User</h1>
            <p class="org-page-subtitle">Kelola akun pengguna aplikasi serta pembagian hak akses role secara terpusat.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="#form-tambah-user" class="org-btn-primary text-decoration-none">
                <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>User Baru</span>
            </a>
        </div>
    </div>

    @if(session('message'))
        <div class="org-alert d-flex align-items-center gap-2 mb-4" role="alert">
            <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Bagian 2: Ringkasan Metrik -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="org-card-pastel-blue h-100 d-flex align-items-center justify-content-between">
                <div>
                    <div class="org-stat-number">{{ $totalUsers }}</div>
                    <div class="org-stat-label mt-1">Total Akun Terdaftar</div>
                </div>
                <div class="org-icon-circle org-icon-circle-blue">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="org-card-pastel-sage h-100 d-flex align-items-center justify-content-between">
                <div>
                    <div class="org-stat-number">{{ $totalRoles }}</div>
                    <div class="org-stat-label mt-1">Kategori Role Tersedia</div>
                </div>
                <div class="org-icon-circle org-icon-circle-sage">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="org-card-pastel-yellow h-100 d-flex align-items-center justify-content-between">
                <div>
                    <div class="org-stat-number" style="font-size: 1.35rem;">{{ $latestUser->username ?? '-' }}</div>
                    <div class="org-stat-label mt-1">User Terbaru</div>
                </div>
                <div class="org-icon-circle org-icon-circle-yellow">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian 3: Konten Utama (Form Tambah & Tabel Daftar User) -->
    <div class="row g-4">
        <div class="col-lg-4" id="form-tambah-user">
            <div class="org-card h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="org-icon-circle">
                        <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Tambah User</h6>
                        <small style="color: var(--org-muted-gray);">Buat kredensial pengguna baru</small>
                    </div>
                </div>

                <form action="{{ route('master.user.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label org-label">Username</label>
                        <input type="text" name="username" class="form-control org-input" placeholder="Masukkan username" maxlength="45" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label org-label">Password</label>
                        <input type="password" name="password" class="form-control org-input" placeholder="••••••••" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label org-label">Role</label>
                        <select name="idrole" class="form-select org-select" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $r)
                                <option value="{{ $r->idrole }}">{{ $r->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="org-btn-primary w-100">
                        <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        <span>Simpan User</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="org-table-wrapper">
                <div class="d-flex align-items-center justify-content-between px-4 py-3" style="border-bottom: 1px solid var(--org-border-subtle);">
                    <div>
                        <h6 class="fw-bold mb-0">Daftar User</h6>
                        <small style="color: var(--org-muted-gray);">Seluruh akun aktif yang dapat mengakses sistem</small>
                    </div>
                    <span class="org-badge org-badge-id">{{ $totalUsers }} Akun</span>
                </div>

                <div class="table-responsive">
                    <table class="table org-table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th class="text-end" style="min-width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $u)
                                <tr>
                                    <td>
                                        <span class="org-badge org-badge-id">#{{ $u->iduser }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="org-avatar">{{ substr($u->username, 0, 2) }}</span>
                                            <span class="fw-semibold">{{ $u->username }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="org-badge org-badge-blue">{{ $u->nama_role }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap justify-content-end gap-1">
                                            <button type="button" class="org-btn-pill-sm org-btn-yellow" data-bs-toggle="modal" data-bs-target="#editUser{{ $u->iduser }}">Edit</button>
                                            <form action="{{ route('master.user.destroy', $u->iduser) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="org-btn-pill-sm org-btn-pink" onclick="return confirm('Hapus user ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editUser{{ $u->iduser }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form action="{{ route('master.user.update', $u->iduser) }}" method="POST" class="modal-content org-modal-content">
                                            @csrf @method('PUT')
                                            <div class="modal-header org-modal-header px-4 pt-3 pb-2">
                                                <h5 class="modal-title fw-bold">Edit User #{{ $u->iduser }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body px-4 py-3">
                                                <div class="mb-3">
                                                    <label class="form-label org-label">Username</label>
                                                    <input type="text" name="username" class="form-control org-input" value="{{ $u->username }}" maxlength="45" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label org-label">
                                                        Password Baru <small style="color: var(--org-muted-gray); font-weight: 400;">(Kosongkan jika tidak diubah)</small>
                                                    </label>
                                                    <input type="password" name="password" class="form-control org-input" placeholder="••••••••">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label org-label">Role</label>
                                                    <select name="idrole" class="form-select org-select" required>
                                                        @foreach($roles as $r)
                                                            <option value="{{ $r->idrole }}" {{ ($u->idrole ?? '') == $r->idrole ? 'selected' : '' }}>
                                                                {{ $r->nama_role }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer org-modal-footer px-4 pb-3 pt-2">
                                                <button type="button" class="org-btn-pill-sm org-badge-inactive px-3 py-2" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="org-btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5" style="color: var(--org-muted-gray);">
                                        Data user kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

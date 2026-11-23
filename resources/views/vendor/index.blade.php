@extends('layouts.app')

@section('content')
@push('styles')
<style>
    .org-page {
        background-color: var(--org-bg, #F7F5EB);
        color: var(--org-dark, #1C1C1E);
        padding: 28px;
        border-radius: 24px;
    }

    .org-back-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1.5px dashed rgba(28, 28, 30, 0.4);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--org-dark, #1C1C1E);
        text-decoration: none;
        flex-shrink: 0;
        transition: background-color 0.2s ease;
    }

    .org-back-btn:hover {
        background-color: var(--org-surface, #EBE7D9);
        color: var(--org-dark, #1C1C1E);
    }

    .org-pill-dark {
        background-color: var(--org-dark, #1C1C1E);
        color: var(--org-bg, #F7F5EB);
        border-radius: 9999px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .org-alert-info {
        background-color: var(--org-blue, #B5C7EB);
        color: var(--org-dark, #1C1C1E);
        border: none;
        border-radius: 24px;
        padding: 16px 22px;
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .org-form-card {
        background-color: var(--org-surface, #EBE7D9);
        border: 1px solid rgba(28, 28, 30, 0.08);
        border-radius: 24px;
        padding: 24px;
    }

    .org-icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .org-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--org-dark, #1C1C1E);
        margin-bottom: 6px;
        margin-left: 8px;
    }

    .org-input {
        background-color: var(--org-bg, #F7F5EB) !important;
        border: 1.5px solid rgba(28, 28, 30, 0.14) !important;
        color: var(--org-dark, #1C1C1E) !important;
        border-radius: 9999px !important;
        padding: 10px 18px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        box-shadow: none !important;
    }

    .org-input:focus {
        border-color: var(--org-dark, #1C1C1E) !important;
        background-color: #FFFFFF !important;
    }

    .org-btn-primary {
        background-color: var(--org-dark, #1C1C1E);
        color: var(--org-bg, #F7F5EB);
        border: none;
        border-radius: 9999px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 700;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: opacity 0.2s ease;
    }

    .org-btn-primary:hover {
        opacity: 0.9;
        color: var(--org-bg, #F7F5EB);
    }

    .org-item-card {
        background-color: rgba(235, 231, 217, 0.65);
        border: 1px solid rgba(28, 28, 30, 0.08);
        border-radius: 24px;
        padding: 18px 20px;
        transition: background-color 0.2s ease;
    }

    .org-item-card:hover {
        background-color: var(--org-surface, #EBE7D9);
    }

    .org-btn-circle-action {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.15s ease, opacity 0.15s ease;
    }

    .org-btn-circle-action:hover {
        transform: scale(1.06);
        opacity: 0.9;
    }

    .org-modal-content {
        background-color: var(--org-bg, #F7F5EB);
        color: var(--org-dark, #1C1C1E);
        border: 1px solid rgba(28, 28, 30, 0.1);
        border-radius: 24px;
        padding: 8px;
    }
</style>
@endpush

<div class="org-page">
    {{-- Bagian 1: Page Header --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ url()->previous() }}" title="Kembali" class="org-back-btn">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h4 class="fw-bold mb-0" style="font-size: 1.5rem; letter-spacing: -0.02em; color: var(--org-dark, #1C1C1E);">
                    Master Vendor
                </h4>
                <div style="font-size: 13px; color: var(--org-muted, #6E6D68);">
                    Kelola daftar pemasok, status badan hukum, dan mitra pengadaan
                </div>
            </div>
        </div>

        <span class="org-pill-dark">
            <span style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--org-blue, #B5C7EB); display: inline-block;"></span>
            <span>{{ count($vendors) }} Total Vendor</span>
        </span>
    </div>

    {{-- Alert Session Message --}}
    @if(session('message'))
        <div class="org-alert-info mb-4" role="alert">
            <div class="org-icon-circle" style="background-color: var(--org-dark, #1C1C1E); color: var(--org-blue, #B5C7EB); width: 36px; height: 36px;">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <div class="row g-4 align-items-start">
        {{-- Kolom Kiri: Form Tambah Vendor --}}
        <div class="col-lg-4">
            <div class="org-form-card">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="org-icon-circle" style="background-color: var(--org-blue, #B5C7EB); color: var(--org-dark, #1C1C1E);">
                        <svg width="20" height="20" style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="font-size: 16px;">Tambah Vendor</h6>
                        <div style="font-size: 12px; color: var(--org-muted, #6E6D68);">Daftarkan mitra pemasok baru</div>
                    </div>
                </div>

                <form action="{{ route('master.vendor.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label org-label">Nama Vendor</label>
                        <input type="text" name="nama_vendor" class="form-control org-input" placeholder="Nama perusahaan / pemasok" maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label org-label">Badan Hukum</label>
                        <select name="badan_hukum" class="form-select org-input" required>
                            <option value="Y">Ya (PT / CV)</option>
                            <option value="N">Tidak (Perorangan)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label org-label">Status</label>
                        <select name="status" class="form-select org-input" required>
                            <option value="A">Aktif</option>
                            <option value="N">Nonaktif</option>
                        </select>
                    </div>
                    <button type="submit" class="org-btn-primary">
                        <span>Simpan Vendor</span>
                        <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- Kolom Kanan: Daftar Vendor --}}
        <div class="col-lg-8">
            <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                <div>
                    <h6 class="fw-bold mb-0" style="font-size: 16px;">Daftar Vendor</h6>
                    <div style="font-size: 12px; color: var(--org-muted, #6E6D68);">Seluruh vendor terdaftar beserta legalitas & status kemitraan</div>
                </div>
            </div>

            <div class="d-flex flex-column gap-3">
                @php
                    $pastelColors = ['#B5C7EB', '#F4B8E4', '#9CB370', '#F7DC6F'];
                @endphp

                @forelse($vendors as $v)
                    @php
                        $avatarBg = $pastelColors[$loop->index % count($pastelColors)];
                    @endphp

                    <div class="org-item-card d-flex flex-wrap align-items-center justify-content-between gap-3">
                        {{-- Kiri: Ikon Bulat Pastel + Identitas Vendor --}}
                        <div class="d-flex align-items-center gap-3">
                            <div class="org-icon-circle" style="background-color: {{ $avatarBg }}; color: var(--org-dark, #1C1C1E);">
                                <svg width="20" height="20" style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                    <span style="background-color: var(--org-dark, #1C1C1E); color: var(--org-bg, #F7F5EB); font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                        #{{ $v->idvendor }}
                                    </span>
                                    <span style="background-color: var(--org-bg, #F7F5EB); color: var(--org-dark, #1C1C1E); font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 9999px;">
                                        Badan Hukum: {{ $v->badan_hukum == 'Y' ? 'Ya' : 'Tidak' }}
                                    </span>
                                    <span style="background-color: {{ $v->status == 'A' ? 'var(--org-green, #9CB370)' : 'var(--org-bg, #F7F5EB)' }}; color: var(--org-dark, #1C1C1E); font-size: 11px; font-weight: 700; padding: 2px 12px; border-radius: 9999px; border: 1px solid rgba(28,28,30,0.08);">
                                        {{ $v->status == 'A' ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                                <div class="fw-bold" style="font-size: 16px; color: var(--org-dark, #1C1C1E);">
                                    {{ $v->nama_vendor }}
                                </div>
                            </div>
                        </div>

                        {{-- Kanan: Tombol Aksi Bulat --}}
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="org-btn-circle-action" title="Edit Vendor"
                                    style="background-color: var(--org-yellow, #F7DC6F); color: var(--org-dark, #1C1C1E);"
                                    data-bs-toggle="modal" data-bs-target="#editVendor{{ $v->idvendor }}">
                                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                            <form action="{{ route('master.vendor.destroy', $v->idvendor) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="org-btn-circle-action" title="Hapus Vendor"
                                        style="background-color: var(--org-pink, #F4B8E4); color: var(--org-dark, #1C1C1E);"
                                        onclick="return confirm('Hapus vendor ini?')">
                                    <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editVendor{{ $v->idvendor }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="{{ route('master.vendor.update', $v->idvendor) }}" method="POST" class="modal-content org-modal-content">
                                @csrf @method('PUT')
                                <div class="modal-header border-0 pb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="org-icon-circle" style="background-color: var(--org-yellow, #F7DC6F); color: var(--org-dark, #1C1C1E); width: 40px; height: 40px;">
                                            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h5 class="modal-title fw-bold mb-0" style="font-size: 17px;">Edit Vendor</h5>
                                            <div style="font-size: 12px; color: var(--org-muted, #6E6D68);">ID #{{ $v->idvendor }}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body pt-2">
                                    <div class="mb-3">
                                        <label class="form-label org-label">Nama Vendor</label>
                                        <input type="text" name="nama_vendor" class="form-control org-input" value="{{ $v->nama_vendor }}" maxlength="100" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label org-label">Badan Hukum</label>
                                        <select name="badan_hukum" class="form-select org-input" required>
                                            <option value="Y" {{ $v->badan_hukum == 'Y' ? 'selected' : '' }}>Ya (PT / CV)</option>
                                            <option value="N" {{ $v->badan_hukum == 'N' ? 'selected' : '' }}>Tidak (Perorangan)</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label org-label">Status</label>
                                        <select name="status" class="form-select org-input" required>
                                            <option value="A" {{ $v->status == 'A' ? 'selected' : '' }}>Aktif</option>
                                            <option value="N" {{ $v->status == 'N' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pt-2">
                                    <button type="submit" class="org-btn-primary">
                                        <span>Simpan Perubahan</span>
                                        <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5" style="background-color: rgba(235, 231, 217, 0.6); border-radius: 24px;">
                        <div class="org-icon-circle mx-auto mb-3" style="background-color: var(--org-blue, #B5C7EB); color: var(--org-dark, #1C1C1E); width: 52px; height: 52px;">
                            <svg width="20" height="20" style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="fw-bold" style="font-size: 15px;">Data vendor kosong</div>
                        <div style="font-size: 13px; color: var(--org-muted, #6E6D68);">Tambahkan data vendor pertama melalui formulir di samping.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

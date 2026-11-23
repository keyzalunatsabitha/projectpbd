@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --org-bg: #F7F5EB;
        --org-surface: #EBE7D9;
        --org-dark: #1C1C1E;
        --org-muted: #6E6D68;
        --org-pink: #F4B8E4;
        --org-yellow: #F7DC6F;
        --org-green: #9CB370;
        --org-blue: #B5C7EB;
    }

    .org-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--org-bg);
        color: var(--org-dark);
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
        color: var(--org-dark);
        text-decoration: none;
        flex-shrink: 0;
        transition: background-color 0.2s ease;
    }

    .org-back-btn:hover {
        background-color: var(--org-surface);
        color: var(--org-dark);
    }

    .org-pill-dark {
        background-color: var(--org-dark);
        color: var(--org-bg);
        border-radius: 9999px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .org-alert-info {
        background-color: var(--org-blue);
        color: var(--org-dark);
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
        background-color: var(--org-surface);
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
        color: var(--org-dark);
        margin-bottom: 6px;
        margin-left: 8px;
    }

    .org-input {
        background-color: var(--org-bg) !important;
        border: 1.5px solid rgba(28, 28, 30, 0.14) !important;
        color: var(--org-dark) !important;
        border-radius: 9999px !important;
        padding: 10px 18px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        box-shadow: none !important;
    }

    .org-input:focus {
        border-color: var(--org-dark) !important;
        background-color: #FFFFFF !important;
    }

    .org-btn-primary {
        background-color: var(--org-dark);
        color: var(--org-bg);
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
        color: var(--org-bg);
    }

    .org-item-card {
        background-color: rgba(235, 231, 217, 0.65);
        border: 1px solid rgba(28, 28, 30, 0.08);
        border-radius: 24px;
        padding: 18px 20px;
        transition: background-color 0.2s ease;
    }

    .org-item-card:hover {
        background-color: var(--org-surface);
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
        background-color: var(--org-bg);
        color: var(--org-dark);
        border: 1px solid rgba(28, 28, 30, 0.1);
        border-radius: 24px;
        padding: 8px;
    }
</style>

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
                <h4 class="fw-bold mb-0" style="font-size: 1.5rem; letter-spacing: -0.02em; color: var(--org-dark);">
                    Barang
                </h4>
                <div style="font-size: 13px; color: var(--org-muted);">
                    Kelola katalog produk, satuan, harga modal, dan status aktif
                </div>
            </div>
        </div>

        <span class="org-pill-dark">
            <span style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--org-green); display: inline-block;"></span>
            <span>{{ count($barangs) }} Total Barang</span>
        </span>
    </div>

    {{-- Alert Session Message --}}
    @if(session('message'))
        <div class="org-alert-info mb-4" role="alert">
            <div class="org-icon-circle" style="background-color: var(--org-dark); color: var(--org-blue); width: 36px; height: 36px;">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <div class="row g-4 align-items-start">
        {{-- Kolom Kiri: Form Tambah Barang --}}
        <div class="col-lg-4">
            <div class="org-form-card">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="org-icon-circle" style="background-color: var(--org-green); color: var(--org-dark);">
                        <svg width="20" height="20" style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="font-size: 16px;">Tambah Barang</h6>
                        <div style="font-size: 12px; color: var(--org-muted);">Daftarkan item baru ke sistem</div>
                    </div>
                </div>

                <form action="{{ route('master.barang.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label org-label">Jenis (1 Huruf)</label>
                        <input type="text" name="jenis" class="form-control org-input" maxlength="1" placeholder="Contoh: M / B" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label org-label">Nama Barang</label>
                        <input type="text" name="nama" class="form-control org-input" maxlength="45" placeholder="Nama produk" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label org-label">Satuan</label>
                        <select name="idsatuan" class="form-select org-input" required>
                            <option value="">-- Pilih Satuan --</option>
                            @foreach($satuans as $s)
                                <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label org-label">Harga Modal</label>
                        <input type="number" name="harga" class="form-control org-input" min="0" placeholder="0" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label org-label">Status</label>
                        <select name="status" class="form-select org-input" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                    <button type="submit" class="org-btn-primary">
                        <span>Simpan Barang</span>
                        <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- Kolom Kanan: Daftar Barang --}}
        <div class="col-lg-8">
            <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                <div>
                    <h6 class="fw-bold mb-0" style="font-size: 16px;">Daftar Barang</h6>
                    <div style="font-size: 12px; color: var(--org-muted);">Seluruh item terdaftar beserta estimasi harga jual & stok</div>
                </div>
            </div>

            <div class="d-flex flex-column gap-3">
                @php
                    $pastelColors = ['#F4B8E4', '#B5C7EB', '#9CB370', '#F7DC6F'];
                @endphp

                @forelse($barangs as $b)
                    @php
                        $avatarBg = $pastelColors[$loop->index % count($pastelColors)];
                    @endphp

                    <div class="org-item-card">
                        <div class="row align-items-center g-3">
                            {{-- Kiri: Ikon Bulat Pastel + Identitas Barang --}}
                            <div class="col-md-5 d-flex align-items-center gap-3">
                                <div class="org-icon-circle" style="background-color: {{ $avatarBg }}; color: var(--org-dark);">
                                    <svg width="20" height="20" style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="text-truncate">
                                    <div class="d-flex flex-wrap align-items-center gap-1 mb-1">
                                        <span style="background-color: var(--org-dark); color: var(--org-bg); font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                            #{{ $b->idbarang }}
                                        </span>
                                        <span style="background-color: var(--org-bg); color: var(--org-dark); font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                            Jenis: {{ $b->jenis }}
                                        </span>
                                        <span style="background-color: var(--org-bg); color: var(--org-muted); font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 9999px;">
                                            {{ $b->nama_satuan }}
                                        </span>
                                    </div>
                                    <div class="fw-bold text-truncate" style="font-size: 15px; color: var(--org-dark);">
                                        {{ $b->nama }}
                                    </div>
                                    <div class="mt-1 d-flex align-items-center gap-2">
                                        <span style="background-color: {{ $b->status_kode == 1 ? 'var(--org-green)' : 'var(--org-surface)' }}; color: var(--org-dark); font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px; border: 1px solid rgba(28,28,30,0.08);">
                                            {{ $b->status }}
                                        </span>
                                        <span style="font-size: 12px; font-weight: 700; color: var(--org-muted);">
                                            Stok: {{ $b->stok }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Tengah: Harga Modal & Harga Jual Estimasi --}}
                            <div class="col-md-4">
                                <div class="d-flex flex-column gap-1" style="background-color: var(--org-bg); border-radius: 18px; padding: 10px 14px;">
                                    <div class="d-flex justify-content-between align-items-center" style="font-size: 12px;">
                                        <span style="color: var(--org-muted); font-weight: 600;">Modal</span>
                                        <span style="font-weight: 700; color: var(--org-dark);">Rp {{ number_format($b->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center" style="font-size: 12px;">
                                        <span style="color: var(--org-muted); font-weight: 600;">Jual Est.</span>
                                        <span style="font-weight: 800; color: var(--org-dark);">Rp {{ number_format($b->harga_jual_estimasi, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Kanan: Tombol Aksi Bulat --}}
                            <div class="col-md-3 d-flex align-items-center justify-content-md-end gap-2">
                                <button type="button" class="org-btn-circle-action" title="Edit Barang"
                                        style="background-color: var(--org-yellow); color: var(--org-dark);"
                                        data-bs-toggle="modal" data-bs-target="#editBarang{{ $b->idbarang }}">
                                    <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                <form action="{{ route('master.barang.destroy', $b->idbarang) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="org-btn-circle-action" title="Hapus Barang"
                                            style="background-color: var(--org-pink); color: var(--org-dark);"
                                            onclick="return confirm('Hapus barang ini?')">
                                        <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editBarang{{ $b->idbarang }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="{{ route('master.barang.update', $b->idbarang) }}" method="POST" class="modal-content org-modal-content">
                                @csrf @method('PUT')
                                <div class="modal-header border-0 pb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="org-icon-circle" style="background-color: var(--org-yellow); color: var(--org-dark); width: 40px; height: 40px;">
                                            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h5 class="modal-title fw-bold mb-0" style="font-size: 17px;">Edit Barang</h5>
                                            <div style="font-size: 12px; color: var(--org-muted);">ID #{{ $b->idbarang }}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body pt-2">
                                    <div class="mb-3">
                                        <label class="form-label org-label">Jenis (1 Huruf)</label>
                                        <input type="text" name="jenis" class="form-control org-input" value="{{ $b->kode_jenis }}" maxlength="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label org-label">Nama Barang</label>
                                        <input type="text" name="nama" class="form-control org-input" value="{{ $b->nama }}" maxlength="45" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label org-label">Satuan</label>
                                        <select name="idsatuan" class="form-select org-input" required>
                                            @foreach($satuans as $s)
                                                <option value="{{ $s->idsatuan }}" {{ $b->idsatuan == $s->idsatuan ? 'selected' : '' }}>
                                                    {{ $s->nama_satuan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label org-label">Harga Modal</label>
                                        <input type="number" name="harga" class="form-control org-input" value="{{ $b->harga }}" min="0" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label org-label">Status</label>
                                        <select name="status" class="form-select org-input" required>
                                            <option value="1" {{ $b->status_kode == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ $b->status_kode == 0 ? 'selected' : '' }}>Nonaktif</option>
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
                        <div class="org-icon-circle mx-auto mb-3" style="background-color: var(--org-pink); color: var(--org-dark); width: 52px; height: 52px;">
                            <svg width="20" height="20" style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <div class="fw-bold" style="font-size: 15px;">Data barang kosong</div>
                        <div style="font-size: 13px; color: var(--org-muted);">Tambahkan data barang pertama melalui formulir di samping.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

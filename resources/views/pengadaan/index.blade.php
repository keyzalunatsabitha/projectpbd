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

    .org-card-pastel-yellow {
        background-color: rgba(247, 220, 111, 0.28);
        border: 1px solid rgba(247, 220, 111, 0.45);
        border-radius: 24px;
        padding: 1.35rem;
    }

    .org-card-pastel-sage {
        background-color: rgba(156, 179, 112, 0.22);
        border: 1px solid rgba(156, 179, 112, 0.35);
        border-radius: 24px;
        padding: 1.35rem;
    }

    .org-card-pastel-blue {
        background-color: rgba(181, 199, 235, 0.28);
        border: 1px solid rgba(181, 199, 235, 0.45);
        border-radius: 24px;
        padding: 1.35rem;
    }

    .org-icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .org-pastel-0 { background-color: var(--org-butter-yellow); }
    .org-pastel-1 { background-color: var(--org-pastel-blue); }
    .org-pastel-2 { background-color: var(--org-sage-green); }
    .org-pastel-3 { background-color: var(--org-pastel-pink); }

    .org-alert {
        background-color: rgba(181, 199, 235, 0.32);
        border: 1px solid rgba(28, 28, 30, 0.1);
        color: var(--org-charcoal);
        border-radius: 24px;
        padding: 0.9rem 1.25rem;
        font-size: 0.9rem;
        font-weight: 500;
    }

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
        text-decoration: none;
        transition: opacity 0.2s ease;
    }

    .org-btn-primary:hover {
        background-color: #2f2f32;
        color: var(--org-bg-cream);
    }

    .org-btn-circle-sand {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        flex-shrink: 0;
        transition: filter 0.15s ease;
    }

    .org-btn-circle-sand:hover {
        filter: brightness(0.94);
        color: var(--org-charcoal);
    }

    .org-list-item {
        background-color: var(--org-bg-cream);
        border: 1px solid var(--org-border-subtle);
        border-radius: 24px;
        padding: 1.2rem 1.4rem;
        transition: background-color 0.15s ease;
    }

    .org-list-item:hover {
        background-color: rgba(235, 231, 217, 0.35);
    }

    .org-badge {
        border-radius: 9999px;
        padding: 0.3rem 0.85rem;
        font-size: 0.76rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .org-badge-id {
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
    }

    .org-badge-diproses {
        background-color: var(--org-butter-yellow);
        color: var(--org-charcoal);
    }

    .org-badge-selesai {
        background-color: var(--org-sage-green);
        color: var(--org-charcoal);
    }

    .org-badge-batal {
        background-color: var(--org-pastel-pink);
        color: var(--org-charcoal);
    }

    .org-empty-box {
        background-color: var(--org-surface-sand);
        border-radius: 24px;
        padding: 3rem 1.5rem;
        text-align: center;
    }

    .org-svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
@php
    $totalPO = $listPengadaan->count();
    $poDiproses = $listPengadaan->where('status_pengadaan', 'Diproses')->count();
    $poSelesai = $listPengadaan->where('status_pengadaan', 'Selesai')->count();
@endphp

<div class="org-page-wrapper">
    <!-- Bagian 1: Page Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="org-page-title">Transaksi Pengadaan</h1>
            <p class="org-page-subtitle">Daftar Purchase Order (PO) pemesanan barang ke vendor supplier.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('pengadaan.create') }}" class="org-btn-primary">
                <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Buat Pengadaan</span>
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
                    <div class="org-stat-number">{{ $totalPO }}</div>
                    <div class="org-stat-label mt-1">Total Purchase Order</div>
                </div>
                <div class="org-icon-circle org-pastel-1">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="org-card-pastel-yellow h-100 d-flex align-items-center justify-content-between">
                <div>
                    <div class="org-stat-number">{{ $poDiproses }}</div>
                    <div class="org-stat-label mt-1">Sedang Diproses</div>
                </div>
                <div class="org-icon-circle org-pastel-0">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="org-card-pastel-sage h-100 d-flex align-items-center justify-content-between">
                <div>
                    <div class="org-stat-number">{{ $poSelesai }}</div>
                    <div class="org-stat-label mt-1">Pengadaan Selesai</div>
                </div>
                <div class="org-icon-circle org-pastel-2">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian 3: Daftar Transaksi Pengadaan -->
    <div class="d-flex flex-column gap-2">
        @forelse($listPengadaan as $p)
            @php
                $statusText  = $p->status_pengadaan ?? 'Diproses';
                $statusClass = $statusText === 'Selesai' ? 'org-badge-selesai' : ($statusText === 'Dibatalkan' ? 'org-badge-batal' : 'org-badge-diproses');
            @endphp
            <div class="org-list-item d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="org-icon-circle org-pastel-{{ $loop->index % 4 }}">
                        <svg class="org-svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="org-badge org-badge-id">#PO-{{ $p->idpengadaan }}</span>
                            <span class="org-badge {{ $statusClass }}">{{ $statusText }}</span>
                        </div>
                        <div class="fw-bold" style="font-size: 1.02rem;">
                            {{ $p->nama_vendor ?? '-' }}
                            @if(!empty($p->badan_hukum))
                                <span class="small fw-normal" style="color: var(--org-muted-gray);">({{ $p->badan_hukum }})</span>
                            @endif
                        </div>
                        <div class="small" style="color: var(--org-muted-gray); font-size: 0.78rem;">
                            {{ \Carbon\Carbon::parse($p->tanggal_pengadaan)->format('d M Y, H:i') }} &bull; Pembuat PO: {{ $p->pembuat_PO ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 ms-auto">
                    <div class="text-end">
                        <div class="small" style="color: var(--org-muted-gray); font-size: 0.75rem;">Total (+PPN)</div>
                        <div style="font-size: 1.15rem; font-weight: 800;">
                            Rp {{ number_format($p->total_nilai ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                    <a href="{{ route('pengadaan.show', $p->idpengadaan) }}" class="org-btn-circle-sand" title="Detail PO">
                        <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="org-empty-box">
                <div class="fw-bold mb-1">Belum ada transaksi pengadaan</div>
                <div class="small mb-3" style="color: var(--org-muted-gray);">Buat PO pertama untuk memesan barang ke vendor.</div>
                <a href="{{ route('pengadaan.create') }}" class="org-btn-primary">Buat Sekarang</a>
            </div>
        @endforelse
    </div>
</div>
@endsection

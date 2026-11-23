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
        margin-bottom: 0.2rem;
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

    .org-btn-utility {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1.5px dashed rgba(28, 28, 30, 0.4);
        background-color: transparent;
        color: var(--org-charcoal);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        flex-shrink: 0;
        transition: background-color 0.15s ease;
    }

    .org-btn-utility:hover {
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
    }

    .org-btn-pill-pink {
        background-color: var(--org-pastel-pink);
        color: var(--org-charcoal);
        border: 1px solid transparent;
        border-radius: 9999px;
        padding: 0.55rem 1.25rem;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: filter 0.15s ease;
    }

    .org-btn-pill-pink:hover {
        filter: brightness(0.95);
        color: var(--org-charcoal);
    }

    .org-highlight-yellow {
        background-color: rgba(247, 220, 111, 0.35);
        border: 1px solid rgba(247, 220, 111, 0.55);
        border-radius: 24px;
        padding: 1.65rem;
    }

    .org-card {
        background-color: var(--org-bg-cream);
        border: 1px solid var(--org-border-subtle);
        border-radius: 24px;
        padding: 1.25rem 1.5rem;
    }

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

    .org-badge {
        border-radius: 9999px;
        padding: 0.35rem 0.9rem;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .org-badge-yellow {
        background-color: var(--org-butter-yellow);
        color: var(--org-charcoal);
    }

    .org-badge-sage {
        background-color: var(--org-sage-green);
        color: var(--org-charcoal);
    }

    .org-badge-pink {
        background-color: var(--org-pastel-pink);
        color: var(--org-charcoal);
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
    $statusText = $pengadaan->status_pengadaan ?? 'Diproses';
    $badgeClass = $statusText === 'Selesai' ? 'org-badge-sage' : ($statusText === 'Dibatalkan' ? 'org-badge-pink' : 'org-badge-yellow');
@endphp

<div class="org-page-wrapper">
    <!-- Bagian 1: Page Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('pengadaan.index') }}" class="org-btn-utility" title="Kembali ke Daftar Pengadaan">
                <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <h1 class="org-page-title mb-0">Detail #PO-{{ $pengadaan->idpengadaan }}</h1>
                    <span class="org-badge {{ $badgeClass }}">{{ $pengadaan->status_pengadaan }}</span>
                </div>
                <p class="org-page-subtitle">
                    Dibuat pada {{ \Carbon\Carbon::parse($pengadaan->tanggal_pengadaan)->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        @if(($pengadaan->status_pengadaan ?? '') === 'Diproses')
            <form action="{{ route('pengadaan.cancel', $pengadaan->idpengadaan) }}" method="POST" onsubmit="return confirm('Batalkan PO ini?')">
                @csrf
                @method('PATCH')
                <button type="submit" class="org-btn-pill-pink">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <span>Batalkan PO</span>
                </button>
            </form>
        @endif
    </div>

    <!-- Bagian 2: Kartu Highlight Vendor & Total -->
    <div class="org-highlight-yellow mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <div class="small fw-semibold mb-1" style="color: var(--org-muted-gray);">
                Vendor ({{ $pengadaan->badan_hukum ?? '-' }})
            </div>
            <h4 class="fw-bold mb-1" style="color: var(--org-charcoal);">{{ $pengadaan->nama_vendor ?? '-' }}</h4>
            <div class="small" style="color: var(--org-charcoal);">
                Pembuat PO: <strong>{{ $pengadaan->pembuat_PO ?? '-' }}</strong>
            </div>
        </div>
        <div class="text-md-end">
            <div class="small" style="color: var(--org-muted-gray);">Subtotal: Rp {{ number_format($pengadaan->subtotal_nilai ?? 0, 0, ',', '.') }}</div>
            <div class="small mb-1" style="color: var(--org-muted-gray);">PPN: Rp {{ number_format($pengadaan->ppn ?? 0, 0, ',', '.') }}</div>
            <div class="org-stat-number">Rp {{ number_format($pengadaan->total_nilai ?? 0, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Bagian 3: Rincian Barang -->
    <div class="d-flex align-items-center justify-content-between mb-3 px-1">
        <h6 class="fw-bold mb-0">Rincian Barang</h6>
        <span class="org-badge" style="background-color: var(--org-surface-sand); color: var(--org-charcoal);">
            {{ count($details) }} Item
        </span>
    </div>

    <div class="d-flex flex-column gap-2">
        @foreach($details as $d)
            <div class="org-card d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="org-icon-circle">
                        <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                    <div>
                        <div class="fw-bold">{{ $d->nama_barang ?? '-' }}</div>
                        <div class="small" style="color: var(--org-muted-gray);">
                            {{ $d->jumlah }} unit &times; Rp {{ number_format($d->harga_satuan ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="fw-bold" style="font-size: 1.05rem;">
                    Rp {{ number_format($d->sub_total ?? 0, 0, ',', '.') }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

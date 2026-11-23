@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-cream: #F7F5EB;
        --surface-sand: #EBE7D9;
        --ink-charcoal: #1C1C1E;
        --ink-muted: #6E6D68;
        --pastel-pink: #F4B8E4;
        --pastel-yellow: #F7DC6F;
        --pastel-sage: #9CB370;
        --pastel-blue: #B5C7EB;
    }

    body, .content-wrapper, main {
        background-color: var(--bg-cream) !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        color: var(--ink-charcoal);
    }

    .organic-wrapper {
        max-width: 960px;
        margin: 0 auto;
        padding: 0.5rem 0.25rem 2.5rem;
    }

    /* Highlight Banner Card (Pastel Pink) */
    .welcome-banner {
        background-color: var(--pastel-pink);
        border-radius: 28px;
        padding: 1.75rem 2rem;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        right: -25px;
        bottom: -45px;
        width: 160px;
        height: 160px;
        background-color: rgba(28, 28, 30, 0.06);
        border-radius: 50%;
        pointer-events: none;
    }

    .role-pill-dark {
        background-color: var(--ink-charcoal);
        color: var(--bg-cream);
        border-radius: 9999px;
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* Metric Ring / Counter Card */
    .stat-pill-box {
        background-color: var(--surface-sand);
        border-radius: 24px;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        color: var(--ink-charcoal);
    }

    /* Item List Card (Pengganti Tabel Kaku) */
    .organic-list-item {
        background-color: #FCFBF6;
        border: 1px solid rgba(28, 28, 30, 0.06);
        border-radius: 24px;
        padding: 1rem 1.35rem;
        transition: transform 0.15s ease, background-color 0.15s ease;
    }

    .organic-list-item:hover {
        background-color: #FFFFFF;
        transform: translateY(-1px);
    }

    .item-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--ink-charcoal);
    }

    .pastel-cycle-0 { background-color: var(--pastel-yellow); }
    .pastel-cycle-1 { background-color: var(--pastel-sage); }
    .pastel-cycle-2 { background-color: var(--pastel-blue); }
    .pastel-cycle-3 { background-color: var(--pastel-pink); }

    .satuan-badge {
        background-color: var(--surface-sand);
        color: var(--ink-charcoal);
        border-radius: 9999px;
        padding: 0.25rem 0.75rem;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .id-chip {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--ink-muted);
        background-color: var(--bg-cream);
        border: 1px dashed rgba(28, 28, 30, 0.25);
        border-radius: 9999px;
        padding: 0.15rem 0.6rem;
    }

    .empty-state-box {
        background-color: var(--surface-sand);
        border-radius: 28px;
        padding: 3rem 1.5rem;
        text-align: center;
    }
</style>

<div class="organic-wrapper">
    {{-- Header / Highlight Card --}}
    <div class="row g-3 mb-4 align-items-stretch">
        <div class="col-md-8">
            <div class="welcome-banner h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="small fw-semibold d-block mb-1" style="color: rgba(28, 28, 30, 0.65);">
                        Workspace Overview
                    </span>
                    <h3 class="fw-bold mb-3" style="color: #1C1C1E; letter-spacing: -0.02em;">
                        halo, {{ session('username') }}!
                    </h3>
                </div>
                <div>
                    <span class="role-pill-dark">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        Role: {{ session('role') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-pill-box h-100">
                <div>
                    <div class="stat-number">{{ count($listBarang) }}</div>
                    <div class="small mt-1 fw-medium" style="color: var(--ink-muted);">total item katalog</div>
                </div>
                <div class="item-avatar pastel-cycle-0" style="width: 52px; height: 52px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1C1C1E" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Section Title & Filter Pill --}}
    <div class="d-flex align-items-center justify-content-between mb-3 px-1">
        <h5 class="fw-bold mb-0" style="letter-spacing: -0.01em;">Daftar Barang &amp; Satuan</h5>
        <span class="role-pill-dark" style="font-size: 0.75rem; padding: 0.35rem 0.9rem;">
            All Items
        </span>
    </div>

    {{-- List Data Barang (Menggantikan Tabel Kaku dengan Kartu Baris Organik) --}}
    <div class="d-flex flex-column gap-2">
        @forelse($listBarang as $b)
            @php $b = (array) $b; @endphp
            <div class="organic-list-item d-flex flex-wrap align-items-center justify-content-between gap-3">
                {{-- Kiri: Ikon Bulat Pastel + ID & Nama Barang --}}
                <div class="d-flex align-items-center gap-3">
                    <div class="item-avatar pastel-cycle-{{ $loop->index % 4 }}">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1C1C1E" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="id-chip">#{{ $b['idbarang'] ?? '-' }}</span>
                            <span class="satuan-badge">{{ $b['satuan'] ?? $b['nama_satuan'] ?? '-' }}</span>
                        </div>
                        <div class="fw-bold" style="font-size: 1.02rem; color: var(--ink-charcoal);">
                            {{ $b['nama barang'] ?? $b['nama_barang'] ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- Kanan: Harga Modal --}}
                <div class="text-end ms-auto">
                    <div class="small" style="color: var(--ink-muted); font-size: 0.75rem;">Harga Modal</div>
                    <div class="fw-extrabold" style="font-size: 1.15rem; font-weight: 800; color: var(--ink-charcoal);">
                        Rp {{ number_format($b['harga'] ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state-box">
                <div class="item-avatar mx-auto mb-3" style="background-color: var(--bg-cream); border: 1.5px dashed rgba(28,28,30,0.35);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1C1C1E" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                </div>
                <div class="fw-bold mb-1">Data barang kosong</div>
                <div class="small" style="color: var(--ink-muted);">Belum ada item yang terdaftar di katalog saat ini.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

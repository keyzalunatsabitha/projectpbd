@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .organic-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #F7F5EB;
        color: #1C1C1E;
        padding: 28px;
        border-radius: 24px;
    }
    .organic-back-btn {
        width: 44px;
        height: 44px;
        border-radius: 9999px;
        border: 1.5px dashed rgba(28, 28, 30, 0.4);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #1C1C1E;
        text-decoration: none;
        transition: background-color 0.2s;
        flex-shrink: 0;
    }
    .organic-back-btn:hover {
        background-color: #EBE7D9;
        color: #1C1C1E;
    }
    .organic-pill-dark {
        background-color: #1C1C1E;
        color: #F7F5EB;
        border-radius: 9999px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .organic-metric-card {
        border-radius: 24px;
        padding: 20px 22px;
    }
    .organic-icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .organic-item-card {
        background-color: rgba(235, 231, 217, 0.65);
        border: 1px solid rgba(28, 28, 30, 0.06);
        border-radius: 24px;
        padding: 18px 22px;
        transition: background-color 0.2s;
    }
    .organic-item-card:hover {
        background-color: #EBE7D9;
    }
    .organic-qty-pill {
        background-color: #F7F5EB;
        border-radius: 18px;
        padding: 6px 14px;
        text-align: center;
        min-width: 68px;
    }
</style>

<div class="organic-page">
    {{-- Header Minimalis --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ url()->previous() }}" title="Kembali" class="organic-back-btn">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <div style="font-size: 11px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: #6E6D68;">
                    Riwayat Transaksi
                </div>
                <h4 class="fw-bolder mb-0" style="font-size: 26px; letter-spacing: -0.02em; color: #1C1C1E;">
                    Kartu Stok (Mutasi Barang)
                </h4>
            </div>
        </div>

    </div>

    {{-- Ringkasan Metrik Utama --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="organic-metric-card d-flex align-items-center justify-content-between" style="background-color: #9CB370;">
                <div>
                    <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: rgba(28,28,30,0.75);">
                        Total Barang Masuk
                    </div>
                    <div style="font-size: 28px; font-weight: 800; color: #1C1C1E; line-height: 1.2; margin-top: 4px;">
                        +{{ $mutasiStok->sum('masuk') }}
                    </div>
                </div>
                <div class="organic-icon-circle" style="background-color: #1C1C1E; color: #9CB370;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="organic-metric-card d-flex align-items-center justify-content-between" style="background-color: #B5C7EB;">
                <div>
                    <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: rgba(28,28,30,0.75);">
                        Total Barang Keluar
                    </div>
                    <div style="font-size: 28px; font-weight: 800; color: #1C1C1E; line-height: 1.2; margin-top: 4px;">
                        -{{ $mutasiStok->sum('keluar') }}
                    </div>
                </div>
                <div class="organic-icon-circle" style="background-color: #1C1C1E; color: #B5C7EB;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="organic-metric-card d-flex align-items-center justify-content-between" style="background-color: #F4B8E4;">
                <div>
                    <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: rgba(28,28,30,0.75);">
                        Total Transaksi
                    </div>
                    <div style="font-size: 28px; font-weight: 800; color: #1C1C1E; line-height: 1.2; margin-top: 4px;">
                        {{ count($mutasiStok) }}
                    </div>
                </div>
                <div class="organic-icon-circle" style="background-color: #1C1C1E; color: #F4B8E4;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Mutasi Stok (dari View mutasistok) --}}
    <div class="d-flex flex-column gap-3">
        @forelse($mutasiStok as $m)
            @php
                if ($m->jenis_transaksi == 'Pengadaan (+)') {
                    $badgeBg = '#9CB370';
                } elseif ($m->jenis_transaksi == 'Penjualan (-)') {
                    $badgeBg = '#B5C7EB';
                } else {
                    $badgeBg = '#F7DC6F';
                }
            @endphp

            <div class="organic-item-card">
                <div class="row align-items-center g-3">
                    {{-- Kiri: Ikon + Info Barang --}}
                    <div class="col-lg-5 d-flex align-items-center gap-3">
                        <div class="organic-icon-circle" style="background-color: {{ $badgeBg }}; color: #1C1C1E;">
                            @if($m->jenis_transaksi == 'Pengadaan (+)')
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            @elseif($m->jenis_transaksi == 'Penjualan (-)')
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            @else
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            @endif
                        </div>

                        <div class="text-truncate">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                <span style="background-color: #1C1C1E; color: #F7F5EB; font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                    #{{ $m->idkartu_stok }}
                                </span>
                                <span style="background-color: #F7F5EB; color: #6E6D68; font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 9999px;">
                                    Ref #{{ $m->idtransaksi }}
                                </span>
                                <span style="font-size: 11px; color: #6E6D68; font-weight: 600;">
                                    • {{ $m->tanggal }}
                                </span>
                            </div>
                            <div class="fw-bold text-truncate" style="font-size: 16px; color: #1C1C1E;">
                                {{ $m->barang }}
                            </div>
                        </div>
                    </div>

                    {{-- Tengah: Jenis Transaksi --}}
                    <div class="col-lg-3 text-lg-center">
                        <span style="background-color: {{ $badgeBg }}; color: #1C1C1E; font-size: 12px; font-weight: 700; padding: 6px 16px; border-radius: 9999px; display: inline-block;">
                            {{ $m->jenis_transaksi }}
                        </span>
                    </div>

                    {{-- Kanan: Masuk, Keluar & Stok Akhir --}}
                    <div class="col-lg-4 d-flex align-items-center justify-content-between justify-content-lg-end gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="organic-qty-pill">
                                <div style="font-size: 10px; font-weight: 700; color: #6E6D68;">Masuk</div>
                                <div style="font-size: 14px; font-weight: 800; color: {{ $m->masuk > 0 ? '#1C1C1E' : '#9E9D98' }};">
                                    {{ $m->masuk > 0 ? '+' . $m->masuk : '-' }}
                                </div>
                            </div>

                            <div class="organic-qty-pill">
                                <div style="font-size: 10px; font-weight: 700; color: #6E6D68;">Keluar</div>
                                <div style="font-size: 14px; font-weight: 800; color: {{ $m->keluar > 0 ? '#1C1C1E' : '#9E9D98' }};">
                                    {{ $m->keluar > 0 ? '-' . $m->keluar : '-' }}
                                </div>
                            </div>
                        </div>

                        <div style="background-color: #1C1C1E; color: #F7F5EB; border-radius: 9999px; padding: 8px 18px; text-align: right;">
                            <div style="font-size: 9px; text-transform: uppercase; letter-spacing: 0.06em; color: rgba(247,245,235,0.7);">
                                Stok Akhir
                            </div>
                            <div style="font-size: 15px; font-weight: 800; line-height: 1.1;">
                                {{ $m->stok_akhir }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5" style="background-color: rgba(235, 231, 217, 0.6); border-radius: 24px;">
                <div class="organic-icon-circle mx-auto mb-3" style="background-color: #B5C7EB; color: #1C1C1E; width: 56px; height: 56px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="fw-bold" style="font-size: 16px;">Belum ada mutasi stok tercatat.</div>
                <div style="font-size: 13px; color: #6E6D68;">Riwayat pengadaan, penjualan, dan retur barang akan muncul di sini.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

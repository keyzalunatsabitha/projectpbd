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
    .organic-banner {
        background-color: #F7DC6F;
        border-radius: 24px;
        padding: 22px 24px;
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
    .organic-track {
        width: 100%;
        height: 10px;
        background-color: #EBE7D9;
        border-radius: 9999px;
        overflow: hidden;
    }
    .organic-track-fill {
        height: 100%;
        background-color: #1C1C1E;
        border-radius: 9999px;
    }
    .organic-price-box {
        background-color: #F7F5EB;
        border-radius: 20px;
        padding: 10px 16px;
        text-align: right;
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
                    Inventaris & Harga
                </div>
                <h4 class="fw-bolder mb-0" style="font-size: 26px; letter-spacing: -0.02em; color: #1C1C1E;">
                    Katalog Barang
                </h4>
            </div>
        </div>

        <span class="organic-pill-dark">
            Total Item: {{ count($stokBarang) }}
        </span>
    </div>

    {{-- Daftar Kartu Barang --}}
    <div class="d-flex flex-column gap-3">
        @php
            $pastelAccents = ['#F4B8E4', '#B5C7EB', '#9CB370', '#F7DC6F'];
        @endphp

        @forelse($stokBarang as $sb)
            @php
                $accentColor = $pastelAccents[$loop->index % count($pastelAccents)];
                $stokPersen = min(100, max(8, ($sb->stok_saat_ini / 50) * 100));
            @endphp

            <div class="organic-item-card">
                <div class="row align-items-center g-3">
                    {{-- Kiri: Ikon Pastel + Nama & Satuan --}}
                    <div class="col-lg-5 d-flex align-items-center gap-3">
                        <div class="organic-icon-circle" style="background-color: {{ $accentColor }}; color: #1C1C1E;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="text-truncate">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span style="background-color: #1C1C1E; color: #F7F5EB; font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                    #{{ $sb->idbarang }}
                                </span>
                                <span style="background-color: #F7F5EB; color: #6E6D68; font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 9999px;">
                                    {{ $sb->nama_satuan ?? '-' }}
                                </span>
                            </div>
                            <div class="fw-bold text-truncate" style="font-size: 16px; color: #1C1C1E;">
                                {{ $sb->nama_barang }}
                            </div>
                        </div>
                    </div>

                    {{-- Tengah: Indikator Stok Kapsul --}}
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center justify-content-between mb-1" style="font-size: 12px;">
                            <span style="color: #6E6D68; font-weight: 600;">Stok Tersedia</span>
                            <span style="background-color: {{ $sb->stok_saat_ini > 0 ? '#9CB370' : '#F4B8E4' }}; color: #1C1C1E; font-weight: 700; padding: 2px 12px; border-radius: 9999px;">
                                {{ $sb->stok_saat_ini }}
                            </span>
                        </div>
                        <div class="organic-track">
                            <div class="organic-track-fill" style="width: {{ $stokPersen }}%;"></div>
                        </div>
                    </div>

                    {{-- Kanan: Harga Modal & Harga Jual --}}
                    <div class="col-lg-4 d-flex align-items-center justify-content-between justify-content-lg-end gap-3">
                        <div class="text-lg-end">
                            <div style="font-size: 11px; font-weight: 600; color: #6E6D68;">Harga Modal</div>
                            <div style="font-size: 14px; font-weight: 700; color: rgba(28, 28, 30, 0.85);">
                                Rp {{ number_format($sb->harga_modal, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="organic-price-box">
                            <div style="font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #6E6D68;">
                                Harga Jual
                            </div>
                            <div style="font-size: 16px; font-weight: 800; color: #1C1C1E;">
                                Rp {{ number_format($sb->harga_jual_rekomendasi, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5" style="background-color: rgba(235, 231, 217, 0.6); border-radius: 24px;">
                <div class="organic-icon-circle mx-auto mb-3" style="background-color: #F4B8E4; color: #1C1C1E; width: 56px; height: 56px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <div class="fw-bold" style="font-size: 16px;">Data barang kosong</div>
                <div style="font-size: 13px; color: #6E6D68;">Belum ada barang yang tercatat di katalog.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

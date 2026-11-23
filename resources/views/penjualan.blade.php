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
    .organic-form-card {
        background-color: #EBE7D9;
        border-radius: 24px;
        padding: 24px;
    }
    .organic-input {
        background-color: #F7F5EB !important;
        border: 1.5px solid rgba(28, 28, 30, 0.14) !important;
        color: #1C1C1E !important;
        border-radius: 9999px !important;
        padding: 11px 18px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        box-shadow: none !important;
    }
    .organic-input:focus {
        border-color: #1C1C1E !important;
        background-color: #FFFFFF !important;
    }
    .organic-btn-submit {
        background-color: #1C1C1E;
        color: #F7F5EB;
        border: none;
        border-radius: 9999px;
        padding: 13px 24px;
        font-size: 14px;
        font-weight: 700;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: opacity 0.2s;
    }
    .organic-btn-submit:hover {
        opacity: 0.9;
        color: #F7F5EB;
    }
    .organic-icon-circle {
        width: 46px;
        height: 46px;
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
        padding: 16px 20px;
        transition: background-color 0.2s;
    }
    .organic-item-card:hover {
        background-color: #EBE7D9;
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
                    Point of Sale
                </div>
                <h4 class="fw-bolder mb-0" style="font-size: 26px; letter-spacing: -0.02em; color: #1C1C1E;">
                    Kasir Penjualan
                </h4>
            </div>
        </div>

        <span class="organic-pill-dark">
            <span style="width: 8px; height: 8px; border-radius: 50%; background-color: #B5C7EB; display: inline-block;"></span>
            <span>{{ count($riwayatPenjualan) }} Transaksi</span>
        </span>
    </div>

    @if(session('message'))
        <div class="d-flex align-items-center gap-3 mb-4" style="background-color: #B5C7EB; color: #1C1C1E; border-radius: 24px; padding: 16px 22px;">
            <div class="organic-icon-circle" style="background-color: #1C1C1E; color: #B5C7EB; width: 38px; height: 38px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="fw-bold" style="font-size: 14px;">{{ session('message') }}</span>
        </div>
    @endif

    <div class="row g-4 align-items-start">
        {{-- Input Kasir --}}
        <div class="col-lg-5">
            <div class="organic-form-card">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="organic-icon-circle" style="background-color: #B5C7EB; color: #1C1C1E;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <h6 class="fw-extrabold mb-0" style="font-size: 17px;">Input Kasir</h6>
                        <div style="font-size: 12px; color: #6E6D68;">Proses penjualan & PPN 11%</div>
                    </div>
                </div>

                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                            Pilih Barang
                        </label>
                        <select name="idbarang" class="form-select organic-input" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangList as $b)
                                <option value="{{ $b->idbarang }}">
                                    {{ $b->nama }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }} (Stok: {{ $b->stok_saat_ini }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                            Jumlah Beli
                        </label>
                        <input type="number" name="jumlah" class="form-control organic-input" required min="1" placeholder="Masukkan jumlah beli">
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-4" style="background-color: #F7F5EB; border-radius: 16px; padding: 10px 14px; font-size: 12px; color: #6E6D68;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background-color: #9CB370; flex-shrink: 0;"></span>
                        <span>Total nilai otomatis sudah termasuk PPN 11%.</span>
                    </div>

                    <button type="submit" class="organic-btn-submit">
                        <span>Jual</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- Riwayat Penjualan Terbaru --}}
        <div class="col-lg-7">
            <div class="mb-3 px-1">
                <h6 class="fw-extrabold mb-0" style="font-size: 17px;">Riwayat Penjualan Terbaru</h6>
                <div style="font-size: 12px; color: #6E6D68;">Daftar transaksi selesai (+PPN 11%)</div>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($riwayatPenjualan as $rp)
                    <div class="organic-item-card d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="organic-icon-circle" style="background-color: #B5C7EB; color: #1C1C1E;">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span style="background-color: #1C1C1E; color: #F7F5EB; font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                        #{{ $rp->idpenjualan }}
                                    </span>
                                    <span style="background-color: #F7DC6F; color: #1C1C1E; font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                        {{ $rp->jumlah }} pcs
                                    </span>
                                </div>
                                <div class="fw-bold" style="font-size: 15px;">{{ $rp->barang }}</div>
                            </div>
                        </div>

                        <div style="background-color: #F7F5EB; border-radius: 20px; padding: 10px 16px; text-align: right;">
                            <div style="font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #6E6D68;">
                                Total (+PPN 11%)
                            </div>
                            <div style="font-size: 16px; font-weight: 800; color: #1C1C1E;">
                                Rp {{ number_format($rp->total_nilai, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5" style="background-color: rgba(235, 231, 217, 0.6); border-radius: 24px;">
                        <div class="fw-bold" style="font-size: 15px;">Belum ada transaksi</div>
                        <div style="font-size: 13px; color: #6E6D68;">Catat penjualan pertama melalui kasir di samping.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

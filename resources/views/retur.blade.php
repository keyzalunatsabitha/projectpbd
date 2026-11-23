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
    .organic-textarea {
        background-color: #F7F5EB !important;
        border: 1.5px solid rgba(28, 28, 30, 0.14) !important;
        color: #1C1C1E !important;
        border-radius: 20px !important;
        padding: 12px 18px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        box-shadow: none !important;
    }
    .organic-input:focus, .organic-textarea:focus {
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
        padding: 18px 22px;
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
                    Pengembalian
                </div>
                <h4 class="fw-bolder mb-0" style="font-size: 26px; letter-spacing: -0.02em; color: #1C1C1E;">
                    Retur Barang ke Vendor
                </h4>
            </div>
        </div>

        <span class="organic-pill-dark">
            <span style="width: 8px; height: 8px; border-radius: 50%; background-color: #F4B8E4; display: inline-block;"></span>
            <span>{{ count($riwayatRetur) }} Riwayat Retur</span>
        </span>
    </div>

    {{-- Alert Session Message --}}
    @if(session('message'))
        <div class="alert alert-dismissible fade show d-flex align-items-center justify-content-between border-0 mb-4" role="alert"
             style="background-color: #F7DC6F; color: #1C1C1E; border-radius: 24px; padding: 16px 22px;">
            <div class="d-flex align-items-center gap-3">
                <div class="organic-icon-circle" style="background-color: #1C1C1E; color: #F7DC6F; width: 38px; height: 38px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="fw-bold" style="font-size: 14px;">{{ session('message') }}</span>
            </div>
            <button type="button" class="btn-close position-static shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 align-items-start">
        {{-- Form Input Retur --}}
        <div class="col-lg-4">
            <div class="organic-form-card">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="organic-icon-circle" style="background-color: #F4B8E4; color: #1C1C1E;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                    </div>
                    <div>
                        <h6 class="fw-extrabold mb-0" style="font-size: 17px;">Form Retur Barang</h6>
                        <div style="font-size: 12px; color: #6E6D68;">Catat pengembalian item ke vendor</div>
                    </div>
                </div>

                <form action="{{ route('retur.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                            Pilih Item Penerimaan
                        </label>
                        <select name="iddetail_penerimaan" class="form-select organic-input" required>
                            <option value="">-- Pilih Barang Diterima --</option>
                            @foreach($listPenerimaan as $item)
                                <option value="{{ $item->iddetail_penerimaan }}">
                                    #{{ $item->idpenerimaan }} - {{ $item->nama_barang }} (Terima: {{ $item->jumlah_terima }} | {{ $item->nama_vendor }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                            Jumlah Retur
                        </label>
                        <input type="number" name="jumlah" class="form-control organic-input" min="1" placeholder="Masukkan jumlah" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                            Alasan Retur
                        </label>
                        <textarea name="alasan" class="form-control organic-textarea" rows="3" maxlength="200" placeholder="Contoh: Kemasan rusak / cacat produksi"></textarea>
                    </div>

                    <button type="submit" class="organic-btn-submit">
                        <span>Simpan Retur</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- Daftar Riwayat Retur (dari View detailretur) --}}
        <div class="col-lg-8">
            <div class="mb-3 px-1">
                <h6 class="fw-extrabold mb-0" style="font-size: 17px;">Riwayat Retur Barang</h6>
                <div style="font-size: 12px; color: #6E6D68;">Daftar barang yang telah dikembalikan ke vendor</div>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($riwayatRetur as $r)
                    <div class="organic-item-card">
                        <div class="row align-items-center g-3">
                            <div class="col-md-5 d-flex align-items-center gap-3">
                                <div class="organic-icon-circle" style="background-color: #F4B8E4; color: #1C1C1E;">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                                    </svg>
                                </div>
                                <div class="text-truncate">
                                    <div class="d-flex flex-wrap align-items-center gap-1 mb-1">
                                        <span style="background-color: #1C1C1E; color: #F7F5EB; font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                            #{{ $r->idretur }}
                                        </span>
                                        <span style="background-color: #F7F5EB; color: #6E6D68; font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 9999px;">
                                            No. Terima #{{ $r->idpenerimaan }}
                                        </span>
                                    </div>
                                    <div class="fw-bold text-truncate" style="font-size: 15px;">{{ $r->nama }}</div>
                                    <div style="font-size: 11px; color: #6E6D68;">{{ $r->tanggal_retur }}</div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div style="font-size: 11px; font-weight: 700; color: #6E6D68;">Alasan Retur</div>
                                <div style="font-size: 13px; color: #1C1C1E;">{{ $r->alasan ?? '-' }}</div>
                                <span style="background-color: #F7F5EB; color: #6E6D68; font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 9999px; display: inline-block; margin-top: 4px;">
                                    Petugas: {{ $r->petugas_retur }}
                                </span>
                            </div>

                            <div class="col-md-2 text-md-end">
                                <span style="background-color: #F4B8E4; color: #1C1C1E; font-size: 14px; font-weight: 800; padding: 6px 16px; border-radius: 9999px; display: inline-block;">
                                    -{{ $r->jumlah }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5" style="background-color: rgba(235, 231, 217, 0.6); border-radius: 24px;">
                        <div class="fw-bold" style="font-size: 15px;">Belum ada data retur barang.</div>
                        <div style="font-size: 13px; color: #6E6D68;">Gunakan form di samping untuk mencatat retur baru.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

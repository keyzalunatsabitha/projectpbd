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

    .org-back-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1.5px dashed rgba(28, 28, 30, 0.4);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--org-charcoal);
        text-decoration: none;
        transition: background-color 0.2s;
        flex-shrink: 0;
    }
    .org-back-btn:hover {
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
    }

    .org-pill-dark {
        background-color: var(--org-charcoal);
        color: var(--org-bg-cream);
        border-radius: 9999px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .org-form-card {
        background-color: var(--org-surface-sand);
        border: 1px solid var(--org-border-subtle);
        border-radius: 24px;
        padding: 24px;
    }

    .org-input {
        background-color: var(--org-bg-cream) !important;
        border: 1.5px solid rgba(28, 28, 30, 0.14) !important;
        color: var(--org-charcoal) !important;
        border-radius: 9999px !important;
        padding: 11px 18px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        box-shadow: none !important;
    }
    .org-input:focus {
        border-color: var(--org-charcoal) !important;
        background-color: #FFFFFF !important;
    }

    .org-btn-submit {
        background-color: var(--org-charcoal);
        color: var(--org-bg-cream);
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
    .org-btn-submit:hover {
        opacity: 0.9;
        color: var(--org-bg-cream);
    }
    .org-btn-submit:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    .org-icon-circle {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .org-item-card {
        background-color: rgba(235, 231, 217, 0.65);
        border: 1px solid rgba(28, 28, 30, 0.06);
        border-radius: 24px;
        padding: 16px 20px;
        transition: background-color 0.2s;
    }
    .org-item-card:hover {
        background-color: var(--org-surface-sand);
    }

    .org-svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
<div class="org-page-wrapper">
    {{-- Header Minimalis --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('pengadaan.index') }}" title="Kembali ke Pengadaan" class="org-back-btn">
                <svg class="org-svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <div style="font-size: 11px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--org-muted-gray);">
                    Pengadaan & Gudang
                </div>
                <h1 class="fw-bold mb-0" style="font-size: 1.5rem; letter-spacing: -0.02em; color: var(--org-charcoal);">
                    Penerimaan Stok
                </h1>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="org-pill-dark">
                <span style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--org-butter-yellow); display: inline-block;"></span>
                <span>{{ count($pengadaanDiproses) }} PO Diproses</span>
            </span>
            <span class="org-pill-dark">
                <span style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--org-sage-green); display: inline-block;"></span>
                <span>{{ count($kartuStok) }} Log Stok Masuk</span>
            </span>
        </div>
    </div>

    @if(session('message'))
        <div class="d-flex align-items-center gap-3 mb-4" style="background-color: var(--org-sage-green); color: var(--org-charcoal); border-radius: 24px; padding: 16px 22px;">
            <div class="org-icon-circle" style="background-color: var(--org-charcoal); color: var(--org-sage-green); width: 38px; height: 38px;">
                <svg class="org-svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <span class="fw-bold" style="font-size: 14px;">{{ session('message') }}</span>
        </div>
    @endif

    <div class="row g-4 align-items-start">
        {{-- Form Stok Masuk --}}
        <div class="col-lg-5">
            <div class="org-form-card">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="org-icon-circle" style="background-color: var(--org-sage-green); color: var(--org-charcoal);">
                        <svg class="org-svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="font-size: 17px;">Form Penerimaan PO</h6>
                        <div style="font-size: 12px; color: var(--org-muted-gray);">Terima barang berdasarkan Purchase Order aktif</div>
                    </div>
                </div>

                @if($pengadaanDiproses->isEmpty())
                    <div class="text-center p-4" style="background-color: var(--org-bg-cream); border-radius: 24px;">
                        <div class="fw-bold mb-1" style="font-size: 14px;">Tidak ada PO yang menunggu penerimaan</div>
                        <div class="mb-3" style="font-size: 12px; color: var(--org-muted-gray);">Semua PO sudah selesai atau belum ada PO baru.</div>
                        <a href="{{ route('pengadaan.create') }}" class="org-btn-submit text-decoration-none">
                            + Buat Pengadaan Baru
                        </a>
                    </div>
                @else
                    <form action="{{ route('penerimaan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                                1. Pilih Pengadaan (PO Diproses)
                            </label>
                            <select name="idpengadaan" id="select-pengadaan" class="form-select org-input" required>
                                <option value="">-- Pilih #PO --</option>
                                @foreach($pengadaanDiproses as $po)
                                    <option value="{{ $po->idpengadaan }}" data-items='@json($po->items)'>
                                        #PO-{{ $po->idpengadaan }} &bull; {{ $po->nama_vendor }} ({{ \Carbon\Carbon::parse($po->tanggal_pengadaan)->format('d M Y') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                                2. Pilih Barang dalam PO
                            </label>
                            <select name="idbarang" id="select-barang" class="form-select org-input" required disabled>
                                <option value="">-- Pilih PO terlebih dahulu --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                                3. Jumlah Diterima <span id="label-sisa" class="fw-normal" style="color: var(--org-muted-gray); text-transform: none;"></span>
                            </label>
                            <input type="number" name="jumlah" id="input-jumlah" class="form-control org-input" required min="1" placeholder="Masukkan jumlah diterima" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em;">
                                4. Harga Satuan Beli (Sesuai PO)
                            </label>
                            <input type="number" name="harga" id="input-harga" class="form-control org-input" required min="1" placeholder="Otomatis terisi dari PO" readonly>
                        </div>

                        <button type="submit" id="btn-submit-terima" class="org-btn-submit" disabled>
                            <span>Simpan Penerimaan</span>
                            <svg class="org-svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Log Kartu Stok --}}
        <div class="col-lg-7">
            <div class="mb-3 px-1">
                <h6 class="fw-bold mb-0" style="font-size: 17px;">Log Kartu Stok</h6>
                <div style="font-size: 12px; color: var(--org-muted-gray);">Riwayat mutasi kuantitas stok terkini</div>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($kartuStok as $ks)
                    <div class="org-item-card d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="org-icon-circle" style="background-color: var(--org-sage-green); color: var(--org-charcoal);">
                                <svg class="org-svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <span style="background-color: var(--org-bg-cream); color: var(--org-charcoal); font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 9999px;">
                                    {{ $ks->jenis_transaksi }}
                                </span>
                                <div class="fw-bold mt-1" style="font-size: 15px;">{{ $ks->barang }}</div>
                                <small style="font-size: 11px; color: var(--org-muted-gray);">{{ $ks->created_at }}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span style="background-color: var(--org-sage-green); color: var(--org-charcoal); font-size: 14px; font-weight: 800; padding: 6px 14px; border-radius: 9999px;">
                                +{{ $ks->masuk }}
                            </span>
                            <div style="background-color: var(--org-charcoal); color: var(--org-bg-cream); border-radius: 9999px; padding: 6px 16px; text-align: right;">
                                <div style="font-size: 9px; text-transform: uppercase; letter-spacing: 0.05em; color: rgba(247,245,235,0.7);">
                                    Stok Akhir
                                </div>
                                <div style="font-size: 14px; font-weight: 800; line-height: 1.1;">{{ $ks->stock }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5" style="background-color: rgba(235, 231, 217, 0.6); border-radius: 24px;">
                        <div class="fw-bold" style="font-size: 15px;">Belum ada riwayat stok</div>
                        <div style="font-size: 13px; color: var(--org-muted-gray);">Input penerimaan barang melalui form di samping.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectPO = document.getElementById('select-pengadaan');
    const selectBarang = document.getElementById('select-barang');
    const inputJumlah = document.getElementById('input-jumlah');
    const inputHarga = document.getElementById('input-harga');
    const labelSisa = document.getElementById('label-sisa');
    const btnSubmit = document.getElementById('btn-submit-terima');

    if (!selectPO) return;

    selectPO.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        selectBarang.innerHTML = '<option value="">-- Pilih Barang --</option>';
        inputJumlah.value = '';
        inputHarga.value = '';
        labelSisa.textContent = '';
        inputJumlah.disabled = true;
        btnSubmit.disabled = true;

        if (!this.value) {
            selectBarang.disabled = true;
            return;
        }

        const items = JSON.parse(selectedOption.getAttribute('data-items') || '[]');
        items.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item.idbarang;
            opt.textContent = `${item.nama_barang} (Sisa: ${item.sisa} ${item.nama_satuan ?? 'unit'})`;
            opt.setAttribute('data-sisa', item.sisa);
            opt.setAttribute('data-harga', item.harga_satuan);
            selectBarang.appendChild(opt);
        });

        selectBarang.disabled = false;
    });

    selectBarang.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        if (!this.value) {
            inputJumlah.value = '';
            inputHarga.value = '';
            labelSisa.textContent = '';
            inputJumlah.disabled = true;
            btnSubmit.disabled = true;
            return;
        }

        const sisa = parseInt(selectedOption.getAttribute('data-sisa')) || 1;
        const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;

        inputJumlah.max = sisa;
        inputJumlah.value = sisa;
        inputHarga.value = harga;
        labelSisa.textContent = `(Maksimal ${sisa})`;

        inputJumlah.disabled = false;
        btnSubmit.disabled = false;
    });
});
</script>
@endsection

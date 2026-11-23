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

    .org-card {
        background-color: var(--org-bg-cream);
        border: 1px solid var(--org-border-subtle);
        border-radius: 24px;
        padding: 1.5rem;
    }

    .org-input,
    .org-select {
        background-color: var(--org-surface-sand) !important;
        border: 1px solid transparent !important;
        border-radius: 9999px !important;
        padding: 0.65rem 1.15rem !important;
        font-size: 0.9rem !important;
        color: var(--org-charcoal) !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease, background-color 0.2s ease;
    }

    .org-input:focus,
    .org-select:focus {
        border-color: var(--org-charcoal) !important;
        background-color: var(--org-bg-cream) !important;
        outline: none !important;
    }

    .org-item-row-box {
        background-color: rgba(235, 231, 217, 0.55);
        border: 1px solid var(--org-border-subtle);
        border-radius: 24px;
        padding: 0.85rem;
    }

    .org-item-row-box .org-input,
    .org-item-row-box .org-select {
        background-color: var(--org-bg-cream) !important;
    }

    .org-btn-primary {
        background-color: var(--org-charcoal);
        color: var(--org-bg-cream);
        border: 1px solid var(--org-charcoal);
        border-radius: 9999px;
        padding: 0.7rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        transition: opacity 0.2s ease;
    }

    .org-btn-primary:hover {
        background-color: #2f2f32;
        color: var(--org-bg-cream);
    }

    .org-btn-sand {
        background-color: var(--org-surface-sand);
        color: var(--org-charcoal);
        border: 1px solid transparent;
        border-radius: 9999px;
        padding: 0.5rem 1.15rem;
        font-size: 0.825rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .org-btn-sand:hover {
        filter: brightness(0.95);
        color: var(--org-charcoal);
    }

    .org-btn-remove {
        background-color: var(--org-pastel-pink);
        color: var(--org-charcoal);
        border: none;
        border-radius: 9999px;
        padding: 0.45rem 0.95rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .org-btn-remove:disabled {
        background-color: var(--org-surface-sand);
        color: var(--org-muted-gray);
        opacity: 0.6;
    }

    .org-summary-pink {
        background-color: rgba(244, 184, 228, 0.35);
        border: 1px solid rgba(244, 184, 228, 0.55);
        border-radius: 24px;
        padding: 1.5rem;
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
    <!-- Bagian 1: Page Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('pengadaan.index') }}" class="org-btn-utility" title="Kembali">
                <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <div>
                <h1 class="org-page-title">Buat Pengadaan Baru</h1>
                <p class="org-page-subtitle">Pilih vendor dan tambahkan daftar barang yang dipesan</p>
            </div>
        </div>
    </div>

    <form action="{{ route('pengadaan.store') }}" method="POST">
        @csrf

        <!-- Bagian 2: Pilih Vendor -->
        <div class="org-card mb-3">
            <label class="form-label fw-bold small text-uppercase mb-2" style="color: var(--org-muted-gray); letter-spacing: 0.04em;">
                1. Informasi Vendor
            </label>
            <select name="vendor_idvendor" class="form-select org-select" required>
                <option value="">-- Pilih Vendor Supplier --</option>
                @foreach($vendors as $v)
                    <option value="{{ $v->idvendor }}">{{ $v->nama_vendor }} ({{ $v->badan_hukum ?? 'Umum' }})</option>
                @endforeach
            </select>
        </div>

        <!-- Bagian 3: Daftar Item Barang -->
        <div class="org-card mb-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <label class="form-label fw-bold small text-uppercase mb-0" style="color: var(--org-muted-gray); letter-spacing: 0.04em;">
                    2. Item Barang
                </label>
                <button type="button" id="add-item-btn" class="org-btn-sand">
                    <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Baris</span>
                </button>
            </div>

            <div id="items-container" class="d-flex flex-column gap-2">
                <div class="row g-2 align-items-center item-row org-item-row-box mx-0">
                    <div class="col-md-5">
                        <select name="items[0][idbarang]" class="form-select org-select barang-select" required>
                            <option value="" data-harga="0">-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->idbarang }}" data-harga="{{ $b->harga }}">
                                    {{ $b->nama }} ({{ $b->nama_satuan ?? 'unit' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="items[0][harga_satuan]" class="form-control org-input harga-input" placeholder="Harga Satuan" min="0" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="items[0][jumlah]" class="form-control org-input jumlah-input" placeholder="Qty" value="1" min="1" required>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="button" class="org-btn-remove remove-row-btn" disabled>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 4: Ringkasan Total & Submit -->
        <div class="org-summary-pink d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <div class="small fw-semibold mb-1" style="color: var(--org-muted-gray);">
                    Subtotal: <span id="display-subtotal" style="color: var(--org-charcoal);">Rp 0</span> &bull;
                    PPN (10%): <span id="display-ppn" style="color: var(--org-charcoal);">Rp 0</span>
                </div>
                <div style="font-size: 1.75rem; font-weight: 800; line-height: 1.1; letter-spacing: -0.03em;" id="display-total">
                    Rp 0
                </div>
            </div>
            <button type="submit" class="org-btn-primary">
                <svg class="org-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                <span>Simpan Pengadaan</span>
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let rowIndex = 1;
    const container = document.getElementById('items-container');
    const addBtn = document.getElementById('add-item-btn');

    function formatRupiah(angka) {
        return 'Rp ' + Math.round(angka).toLocaleString('id-ID');
    }

    function recalculate() {
        let subtotal = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
            const qty = parseInt(row.querySelector('.jumlah-input').value) || 0;
            subtotal += (harga * qty);
        });
        const ppn = subtotal * 0.10;
        const total = subtotal + ppn;

        document.getElementById('display-subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('display-ppn').textContent = formatRupiah(ppn);
        document.getElementById('display-total').textContent = formatRupiah(total);
    }

    container.addEventListener('change', function (e) {
        if (e.target.classList.contains('barang-select')) {
            const selected = e.target.options[e.target.selectedIndex];
            const hargaDefault = selected.getAttribute('data-harga') || 0;
            const row = e.target.closest('.item-row');
            row.querySelector('.harga-input').value = hargaDefault;
            recalculate();
        }
    });

    container.addEventListener('input', function (e) {
        if (e.target.classList.contains('harga-input') || e.target.classList.contains('jumlah-input')) {
            recalculate();
        }
    });

    addBtn.addEventListener('click', function () {
        const firstRow = container.querySelector('.item-row');
        const newRow = firstRow.cloneNode(true);

        newRow.querySelector('.barang-select').name = `items[${rowIndex}][idbarang]`;
        newRow.querySelector('.barang-select').value = '';
        newRow.querySelector('.harga-input').name = `items[${rowIndex}][harga_satuan]`;
        newRow.querySelector('.harga-input').value = '';
        newRow.querySelector('.jumlah-input').name = `items[${rowIndex}][jumlah]`;
        newRow.querySelector('.jumlah-input').value = 1;

        const removeBtn = newRow.querySelector('.remove-row-btn');
        removeBtn.disabled = false;
        removeBtn.addEventListener('click', function () {
            newRow.remove();
            recalculate();
        });

        container.appendChild(newRow);
        rowIndex++;
    });
});
</script>
@endsection

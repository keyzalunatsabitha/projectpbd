@php
    $roleAktif = strtolower(trim(session('role', '')));
    $isSuper   = in_array($roleAktif, [
        'administrator sistem', 'administrator', 'admin',
        'manajer toko', 'manager', 'manajer',
        'owner'
    ]);
    $isGudang  = $isSuper || in_array($roleAktif, ['staf gudang', 'gudang']);
    $isKasir   = $isSuper || in_array($roleAktif, ['kasir']);
@endphp

<aside id="sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <span class="sidebar-brand-icon">
            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
        </span>
        <span>DUBAICHEWYCOOKIE</span>
    </a>

    <div class="flex-grow-1 pb-4 overflow-auto">
        <div class="sidebar-heading">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('katalog') }}" class="sidebar-link {{ request()->routeIs('katalog') ? 'active' : '' }}">
            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span>Katalog Barang</span>
        </a>
        <a href="{{ route('kartustok.index') }}" class="sidebar-link {{ request()->routeIs('kartustok.*') ? 'active' : '' }}">
            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            <span>Kartu Stok</span>
        </a>

        <div class="sidebar-heading">Transaksi</div>
        @if($isGudang)
        <a href="{{ route('pengadaan.index') }}" class="sidebar-link {{ request()->routeIs('pengadaan.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Pengadaan Barang</span>
            </a>
            <a href="{{ route('penerimaan.index') }}" class="sidebar-link {{ request()->routeIs('penerimaan.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                <span>Penerimaan Stok</span>
            </a>
            <a href="{{ route('retur.index') }}" class="sidebar-link {{ request()->routeIs('retur.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
                <span>Retur Barang</span>
            </a>
        @endif

        @if($isKasir)
            <a href="{{ route('penjualan.index') }}" class="sidebar-link {{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Kasir Penjualan</span>
            </a>
        @endif

        @if($isSuper)
            <div class="sidebar-heading">Data Master</div>
            <a href="{{ route('master.barang.index') }}" class="sidebar-link {{ request()->routeIs('master.barang.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Barang</span>
            </a>
            <a href="{{ route('master.satuan.index') }}" class="sidebar-link {{ request()->routeIs('master.satuan.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                <span>Satuan</span>
            </a>
            <a href="{{ route('master.vendor.index') }}" class="sidebar-link {{ request()->routeIs('master.vendor.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Vendor</span>
            </a>
            <a href="{{ route('master.margin.index') }}" class="sidebar-link {{ request()->routeIs('master.margin.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                </svg>
                <span>Margin Penjualan</span>
            </a>

            <div class="sidebar-heading">Pengaturan Akses</div>
            <a href="{{ route('master.user.index') }}" class="sidebar-link {{ request()->routeIs('master.user.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Manajemen User</span>
            </a>
            <a href="{{ route('master.role.index') }}" class="sidebar-link {{ request()->routeIs('master.role.*') ? 'active' : '' }}">
                <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>Manajemen Role</span>
            </a>
        @endif
    </div>

    <!-- Footer Sidebar -->
    <div class="sidebar-footer-card">
        <div style="font-size: 11px; color: rgba(247, 245, 235, 0.55);">Login sebagai:</div>
        <div class="fw-bold text-truncate" style="font-size: 14px; color: #F7F5EB;">{{ session('username') }}</div>
        <span style="background-color: #9CB370; color: #1C1C1E; font-size: 11px; font-weight: 700; padding: 3px 12px; border-radius: 9999px; display: inline-block; margin-top: 6px;">
            {{ session('role') }}
        </span>
    </div>
</aside>

<header class="topbar d-flex justify-content-between align-items-center">
    <button type="button" class="org-toggle-btn" id="btnToggleSidebar" title="Buka/Tutup Sidebar">
        <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="d-flex align-items-center gap-2">
        <span class="org-user-pill d-none d-sm-inline-flex">
            <span style="width: 8px; height: 8px; border-radius: 50%; background-color: #9CB370; display: inline-block;"></span>
            <span>Halo, <strong>{{ session('username') }}</strong> ({{ session('role') }})</span>
        </span>
        <a href="{{ route('logout') }}" class="org-logout-pill">
            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span>Logout</span>
        </a>
    </div>
</header>

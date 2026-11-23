<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUBAICHEWYCOOKIE STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --org-bg: #F7F5EB;
            --org-surface: #EBE7D9;
            --org-dark: #1C1C1E;
            --org-muted: #6E6D68;
            --org-pink: #F4B8E4;
            --org-yellow: #F7DC6F;
            --org-green: #9CB370;
            --org-blue: #B5C7EB;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            background-color: var(--org-bg);
            color: var(--org-dark);
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
            transition: all 0.3s ease;
            background-color: var(--org-bg);
        }

        /* Sidebar Organic Dark Charcoal */
        #sidebar {
            width: 268px;
            min-width: 268px;
            background-color: var(--org-dark);
            color: var(--org-bg);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border-top-right-radius: 28px;
            border-bottom-right-radius: 28px;
            padding: 8px 14px;
        }

        #wrapper.toggled #sidebar {
            margin-left: -268px;
        }

        .sidebar-brand {
            padding: 1.25rem 0.75rem;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: 0.03em;
            border-bottom: 1px solid rgba(247, 245, 235, 0.1);
            color: var(--org-bg);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
        }

        .sidebar-brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 9999px;
            background-color: var(--org-yellow);
            color: var(--org-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-heading {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(247, 245, 235, 0.45);
            padding: 1rem 0.85rem 0.4rem;
            font-weight: 700;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0.62rem 1rem;
            margin-bottom: 3px;
            color: rgba(247, 245, 235, 0.75);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            border-radius: 9999px;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(247, 245, 235, 0.08);
            color: var(--org-bg);
        }

        .sidebar-link.active {
            background-color: var(--org-pink);
            color: var(--org-dark);
            font-weight: 700;
        }

        .sidebar-footer-card {
            background-color: rgba(247, 245, 235, 0.07);
            border-radius: 24px;
            padding: 14px 16px;
            margin-bottom: 8px;
        }

        #page-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background-color: var(--org-bg);
        }

        /* Topbar Organic Minimalist */
        .topbar {
            background-color: var(--org-bg);
            border-bottom: 1px solid rgba(28, 28, 30, 0.08);
            padding: 0.85rem 1.75rem;
        }

        .org-toggle-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1.5px dashed rgba(28, 28, 30, 0.4);
            background-color: transparent;
            color: var(--org-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .org-toggle-btn:hover {
            background-color: var(--org-surface);
            color: var(--org-dark);
        }

        .org-user-pill {
            background-color: var(--org-surface);
            color: var(--org-dark);
            border-radius: 9999px;
            padding: 6px 16px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .org-logout-pill {
            background-color: var(--org-dark);
            color: var(--org-bg);
            border-radius: 9999px;
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: opacity 0.2s ease;
        }

        .org-logout-pill:hover {
            opacity: 0.9;
            color: var(--org-bg);
        }
    </style>
</head>
<body>

<div id="wrapper">
    <!-- Panggil Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- Konten Utama -->
    <div id="page-content">
        <!-- Panggil Navbar Atas -->
        @include('layouts.partials.navbar')

        <!-- Isi Halaman Dinamis -->
        <main class="container-fluid p-4">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const wrapper = document.getElementById('wrapper');
    const toggleBtn = document.getElementById('btnToggleSidebar');

    if (localStorage.getItem('sidebarToggled') === 'true') {
        wrapper.classList.add('toggled');
    }

    toggleBtn.addEventListener('click', function () {
        wrapper.classList.toggle('toggled');
        localStorage.setItem('sidebarToggled', wrapper.classList.contains('toggled'));
    });
</script>
@stack('scripts')
</body>
</html>

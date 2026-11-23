<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek role pengguna jika diperlukan pembatasan menu
$isAdmin = isset($_SESSION['role']) && (
    $_SESSION['role'] === 'Admin' || 
    $_SESSION['role'] === 'Apoteker Penanggung Jawab'
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUBAICHEWYCOOKIE Store</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font General Sans (via CDN Fontshare) -->
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@500,600,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #090820;
            --card-bg: #121033;
            --card-border: #211c52;
            --purple-primary: #7030EF;
            --magenta-accent: #DB1FFF;
            --text-light: #FFFFFF;
            --text-muted: #8e8bb3;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: 'General Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Top Bar Navigation */
        .app-navbar {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--card-border);
            padding: 14px 0;
        }
        .navbar-brand {
            color: var(--text-light);
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }
        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--text-light) !important;
            background-color: rgba(112, 48, 239, 0.2);
        }

        /* Card System */
        .card-custom {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            overflow: hidden;
        }
        .card-custom-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--card-border);
            font-weight: 600;
            font-size: 1rem;
        }

        /* Table Styling */
        .table-custom {
            color: var(--text-light);
            margin-bottom: 0;
        }
        .table-custom th {
            background-color: rgba(255, 255, 255, 0.03) !important;
            color: var(--text-muted) !important;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--card-border) !important;
            padding: 14px 20px;
        }
        .table-custom td {
            padding: 14px 20px;
            border-bottom: 1px solid var(--card-border);
            vertical-align: middle;
            color: var(--text-light);
            background-color: transparent !important;
        }
        .table-custom tr:hover td {
            background-color: rgba(112, 48, 239, 0.08) !important;
        }

        /* UI Elements & Buttons */
        .btn-purple {
            background-color: var(--purple-primary);
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: background 0.2s;
        }
        .btn-purple:hover {
            background-color: #5d25cd;
            color: #ffffff;
        }

        .badge-custom {
            background-color: rgba(219, 31, 255, 0.15);
            color: var(--magenta-accent);
            border: 1px solid rgba(219, 31, 255, 0.3);
            font-weight: 600;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 0.8rem;
        }

        .form-control, .form-select {
            background-color: #0b0a26;
            border: 1px solid var(--card-border);
            color: var(--text-light);
            border-radius: 10px;
            padding: 10px 14px;
        }
        .form-control:focus, .form-select:focus {
            background-color: #0b0a26;
            border-color: var(--purple-primary);
            color: var(--text-light);
            box-shadow: 0 0 0 3px rgba(112, 48, 239, 0.25);
        }
        .form-label {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg app-navbar mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">DUBAICHEWYCOOKIE</a>
        <button class="navbar-toggler border-0 navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <div class="navbar-nav ms-auto gap-1">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">Dashboard</a>
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'barang.php' ? 'active' : '' ?>" href="barang.php">Katalog</a>
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'penjualan.php' ? 'active' : '' ?>" href="penjualan.php">Kasir</a>
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'penerimaan.php' ? 'active' : '' ?>" href="penerimaan.php">Penerimaan Stok</a>
                
                <?php if ($isAdmin): ?>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'user.php' ? 'active' : '' ?>" href="user.php">Data User</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['username'])): ?>
                    <a class="nav-link text-danger ms-2" href="logout.php">Keluar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

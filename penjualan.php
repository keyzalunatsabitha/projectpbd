<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'dbconnect.php';

// Menyamakan nama variabel koneksi
$conn = isset($dbconn) ? $dbconn : (isset($pdo) ? $pdo : null);

if (!$conn) {
    die("Koneksi database belum terhubung. Cek file dbconnect.php kamu!");
}

$message = "";

// Proses Transaksi Memanggil STORED PROCEDURE sp_transaksi_penjualan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idbarang = $_POST['idbarang'] ?? null;
    $jumlah   = $_POST['jumlah'] ?? 0;
    
    if ($idbarang && $jumlah > 0) {
        try {
            // Panggil Stored Procedure
            $stmt = $conn->prepare("CALL sp_transaksi_penjualan(3, ?, ?, 11.0)");
            $stmt->execute([$idbarang, $jumlah]);
            $message = "Transaksi Penjualan Berhasil! Stored Procedure dipanggil dan Stok otomatis terpotong via Trigger.";
        } catch (Exception $e) {
            $message = "Gagal Transaksi: " . $e->getMessage();
        }
    }
}

// Fetch list barang & stok realtime
$barangList = [];
try {
    $barangList = $conn->query("SELECT b.idbarang, b.nama, b.harga, func_hitunghargajual(b.idbarang) AS harga_jual, COALESCE(sr.`stok saat ini`, 0) AS stok_saat_ini 
    FROM barang b 
    LEFT JOIN stokrealtime sr ON b.idbarang = sr.idbarang 
    WHERE b.status = 1")->fetchAll();
} catch (Exception $e) {
    try {
        $barangList = $conn->query("SELECT idbarang, nama, harga, harga AS harga_jual, 0 AS stok_saat_ini FROM barang")->fetchAll();
    } catch (Exception $ex) {}
}

// Fetch riwayat penjualan
$riwayatPenjualan = [];
try {
    $riwayatPenjualan = $conn->query("SELECT p.idpenjualan, p.created_at, b.nama AS barang, dp.jumlah, p.total_nilai 
                                      FROM penjualan p 
                                      JOIN detail_penjualan dp ON p.idpenjualan = dp.penjualan_idpenjualan 
                                      JOIN barang b ON dp.idbarang = b.idbarang 
                                      ORDER BY p.idpenjualan DESC LIMIT 5")->fetchAll();
} catch (Exception $e) {}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan - DUBAICHEWYCOOKIE</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font General Sans (via Fontshare) -->
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

        /* UI Elements & Form */
        .btn-purple {
            background-color: var(--purple-primary);
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg app-navbar mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">DUBAICHEWYCOOKIE</a>
        <button class="navbar-toggler border-0 navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <div class="navbar-nav ms-auto gap-1">
                <a class="nav-link" href="index.php">Dashboard</a>
                <a class="nav-link" href="barang.php">Katalog</a>
                <a class="nav-link active" href="penjualan.php">Kasir</a>
                <a class="nav-link" href="penerimaan.php">Penerimaan Stok</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <!-- Header Title -->
    <div class="mb-4">
        <h3 class="fw-bold m-0">Kasir Penjualan</h3>
        <p class="text-muted m-0 small">Input transaksi penjualan via Stored Procedure</p>
    </div>

    <!-- Alert Notifikasi -->
    <?php if ($message): ?>
        <div class="alert card-custom p-3 mb-4 text-white border-0" style="background-color: var(--purple-primary);">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Form Transaksi (SP & Trigger) -->
        <div class="col-md-5">
            <div class="card-custom">
                <div class="card-custom-header d-flex justify-content-between align-items-center">
                    <span>Input Kasir</span>
                    <span class="badge-custom">SP Active</span>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Pilih Barang</label>
                            <select name="idbarang" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barangList as $b): ?>
                                    <option value="<?= $b['idbarang'] ?>">
                                        <?= htmlspecialchars($b['nama']) ?> - Rp <?= number_format($b['harga_jual'], 0, ',', '.') ?> (Stok: <?= $b['stok_saat_ini'] ?? 0 ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Beli</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah..." required min="1">
                        </div>
                        <button type="submit" class="btn btn-purple w-100 mt-2">Proses Penjualan (Call SP)</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Penjualan -->
        <div class="col-md-7">
            <div class="card-custom">
                <div class="card-custom-header d-flex justify-content-between align-items-center">
                    <span>Riwayat Penjualan Terbaru</span>
                    <span class="badge-custom">Live Data</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th class="pe-4">Total (+PPN 11%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($riwayatPenjualan)): ?>
                                <?php foreach ($riwayatPenjualan as $rp): ?>
                                <tr>
                                    <td class="ps-4 fw-bold" style="color: var(--purple-primary);">#<?= $rp['idpenjualan'] ?></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($rp['barang']) ?></td>
                                    <td><span class="badge bg-secondary rounded-pill px-3"><?= $rp['jumlah'] ?> pcs</span></td>
                                    <td class="pe-4 fw-bold" style="color: var(--magenta-accent);">Rp <?= number_format($rp['total_nilai'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi penjualan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

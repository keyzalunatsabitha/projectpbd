<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'dbconnect.php';

// Koneksi PDO
$conn = isset($dbconn) ? $dbconn : (isset($pdo) ? $pdo : null);

if (!$conn) {
    die("Koneksi database belum terhubung. Cek file dbconnect.php kamu!");
}

// Ambil Margin Penjualan Aktif dari Database
try {
    $stmtMargin = $conn->query("SELECT * FROM statusmargin WHERE status_margin = 'Aktif' LIMIT 1");
    $marginAktif = $stmtMargin->fetch();
} catch (Exception $e) {
    $marginAktif = null;
}

// Ambil Daftar Barang & Satuan (View: barangsatuan)
try {
    $stmtBarang = $conn->query("SELECT * FROM barangsatuan");
    $listBarang = $stmtBarang->fetchAll();
} catch (Exception $e) {
    $listBarang = [];
}

// Load Header (Top Bar Navbar & Custom CSS Dark Theme)
include 'includes/header.php';
?>

<div class="container mb-5">
    <!-- Section Welcome / Banner Navigasi (Mengadopsi Fitur Temanmu) -->
    <div class="card-custom p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="fw-bold m-0 text-white">
                    Selamat Datang, <?= htmlspecialchars($_SESSION['username'] ?? 'Admin/Kasir'); ?>! 👋
                </h3>
                <p class="text-muted m-0 small mt-1">
                    Anda masuk sebagai <span class="badge-custom"><?= htmlspecialchars($_SESSION['role'] ?? 'Pengguna Sistem'); ?></span> di DUBAICHEWYCOOKIE STORE
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="penjualan.php" class="btn btn-purple btn-sm px-3">Buka Kasir</a>
                <a href="penerimaan.php" class="btn btn-outline-light btn-sm px-3">Input Stok Masuk</a>
            </div>
        </div>
    </div>

    <!-- Metric Card: Status Margin Aktif -->
    <div class="card-custom p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 1px;">Margin Penjualan Aktif</span>
                <h1 class="fw-bold m-0 mt-1" style="color: var(--magenta-accent);">
                    <?= $marginAktif ? htmlspecialchars($marginAktif['persen']) . "%" : "0%"; ?>
                </h1>
            </div>
            <div>
                <span class="badge-custom">
                    Pengatur: <?= $marginAktif ? htmlspecialchars($marginAktif['pengatur']) : "admin_dubai"; ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Tabel Data Master Barang -->
    <div class="card-custom">
        <div class="card-custom-header d-flex justify-content-between align-items-center">
            <span>Daftar Barang & Satuan</span>
            <span class="badge-custom">View: barangsatuan</span>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th class="pe-4">Harga Modal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($listBarang)): ?>
                        <?php foreach ($listBarang as $b): ?>
                        <tr>
                            <td class="ps-4 fw-bold" style="color: var(--purple-primary);">#<?= htmlspecialchars($b['idbarang'] ?? '-') ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($b['nama_barang'] ?? $b['nama'] ?? '-') ?></td>
                            <td><span class="badge-custom"><?= htmlspecialchars($b['nama_satuan'] ?? '-') ?></span></td>
                            <td class="pe-4">Rp <?= number_format($b['harga'] ?? 0, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Data barang kosong</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 
if (file_exists('includes/footer.php')) {
    include 'includes/footer.php'; 
}
?>

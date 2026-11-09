<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'dbconnect.php';

$conn = isset($dbconn) ? $dbconn : (isset($pdo) ? $pdo : null);

if (!$conn) {
    die("Koneksi database belum terhubung. Cek file dbconnect.php kamu!");
}

$stokBarang = [];
try {
    $query = "SELECT b.idbarang, b.nama AS nama_barang, b.jenis, s.nama_satuan, b.harga AS harga_modal,
                     func_hitunghargajual(b.idbarang) AS harga_jual_rekomendasi,
                     COALESCE((SELECT stock FROM kartu_stok ks WHERE ks.idbarang = b.idbarang ORDER BY idkartu_stok DESC LIMIT 1), 0) AS stok_saat_ini
              FROM barang b
              LEFT JOIN satuan s ON b.idsatuan = s.idsatuan";
    $stmtBarang = $conn->query($query);
    $stokBarang = $stmtBarang->fetchAll();
} catch (Exception $e) {
    try {
        $queryFallback = "SELECT b.idbarang, b.nama AS nama_barang, b.jenis, s.nama_satuan, b.harga AS harga_modal,
                                 b.harga AS harga_jual_rekomendasi, 0 AS stok_saat_ini
                          FROM barang b
                          LEFT JOIN satuan s ON b.idsatuan = s.idsatuan";
        $stokBarang = $conn->query($queryFallback)->fetchAll();
    } catch (Exception $ex) {
        $stokBarang = [];
    }
}

include 'includes/header.php';
?>

<div class="container mb-5">
    <div class="mb-4">
        <h3 class="fw-bold m-0">Katalog Barang</h3>
        <p class="text-muted m-0 small">Kalkulasi harga jual otomatis via Stored Function</p>
    </div>

    <div class="card-custom">
        <div class="card-custom-header d-flex justify-content-between align-items-center">
            <span>Daftar Harga & Stok Realtime</span>
            <span class="badge-custom">Stored Function Active</span>
        </div>
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Harga Modal</th>
                        <th>Harga Jual (Rekomendasi)</th>
                        <th class="pe-4">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($stokBarang)): ?>
                        <?php foreach ($stokBarang as $sb): ?>
                        <tr>
                            <td class="ps-4 fw-bold" style="color: var(--purple-primary);">#<?= $sb['idbarang'] ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($sb['nama_barang']) ?></td>
                            <td><span class="badge-custom"><?= htmlspecialchars($sb['nama_satuan'] ?? '-') ?></span></td>
                            <td>Rp <?= number_format($sb['harga_modal'], 0, ',', '.') ?></td>
                            <td class="fw-bold" style="color: var(--magenta-accent);">Rp <?= number_format($sb['harga_jual_rekomendasi'], 0, ',', '.') ?></td>
                            <td class="pe-4"><span class="badge bg-secondary rounded-pill px-3"><?= $sb['stok_saat_ini'] ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">Data barang kosong</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

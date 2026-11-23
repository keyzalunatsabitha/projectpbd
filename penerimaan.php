<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'dbconnect.php';

$conn = isset($dbconn) ? $dbconn : (isset($pdo) ? $pdo : null);

if (!$conn) {
    die("Koneksi database belum terhubung. Cek file dbconnect.php kamu!");
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idbarang = $_POST['idbarang'] ?? null;
    $jumlah   = $_POST['jumlah'] ?? 0;
    $harga    = $_POST['harga'] ?? 0;
    $subtotal = $jumlah * $harga;
    
    if ($idbarang && $jumlah > 0 && $harga > 0) {
        try {
            $conn->beginTransaction();
            
            $stmtP = $conn->prepare("INSERT INTO penerimaan (status, idpengadaan, iduser) VALUES ('1', NULL, 4)");
            $stmtP->execute();
            $idPenerimaan = $conn->lastInsertId();
            
            $stmtD = $conn->prepare("INSERT INTO detail_penerimaan (idpenerimaan, barang_idbarang, jumlah_terima, harga_satuan_terima, sub_total_terima) VALUES (?, ?, ?, ?, ?)");
            $stmtD->execute([$idPenerimaan, $idbarang, $jumlah, $harga, $subtotal]);
            
            $conn->commit();
            $message = "Penerimaan stok berhasil disimpan!";
        } catch (Exception $e) {
            $conn->rollBack();
            $message = "Gagal menyimpan penerimaan: " . $e->getMessage();
        }
    } else {
        $message = "Mohon isi semua form inputan dengan benar!";
    }
}

try {
    $listBarang = $conn->query("SELECT idbarang, nama, harga FROM barang WHERE status = 1")->fetchAll();
} catch (Exception $e) {
    $listBarang = [];
}

try {
    $queryKartuStok = "SELECT ks.idkartu_stok, ks.created_at, b.nama AS barang, ks.jenis_transaksi, ks.masuk, ks.stock 
                       FROM kartu_stok ks 
                       JOIN barang b ON ks.idbarang = b.idbarang 
                       ORDER BY ks.idkartu_stok DESC LIMIT 10";
    $kartuStok = $conn->query($queryKartuStok)->fetchAll();
} catch (Exception $e) {
    $kartuStok = [];
}

include 'includes/header.php';
?>

<div class="container mb-5">
    <div class="mb-4">
        <h3 class="fw-bold m-0">Penerimaan Stok</h3>
        <p class="text-muted m-0 small">Pencatatan barang masuk & pembaruan stok otomatis via Trigger</p>
    </div>

    <?php if ($message): ?>
        <div class="alert card-custom p-3 mb-4 text-white border-0" style="background-color: var(--purple-primary);">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card-custom">
                <div class="card-custom-header">Form Stok Masuk</div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Pilih Barang</label>
                            <select name="idbarang" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($listBarang as $b): ?>
                                    <option value="<?= $b['idbarang'] ?>">
                                        <?= htmlspecialchars($b['nama']) ?> (Modal: Rp <?= number_format($b['harga'], 0, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Diterima (Qty)</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Satuan Beli</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 65000" required min="1000">
                        </div>
                        <button type="submit" class="btn btn-purple w-100 mt-2">Simpan Stok Masuk</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card-custom">
                <div class="card-custom-header d-flex justify-content-between align-items-center">
                    <span>Log Kartu Stok</span>
                    <span class="badge-custom">Trigger Update</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th class="ps-3">Waktu</th>
                                <th>Barang</th>
                                <th>Jenis</th>
                                <th>Masuk</th>
                                <th class="pe-3">Stok Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($kartuStok)): ?>
                                <?php foreach ($kartuStok as $ks): ?>
                                <tr>
                                    <td class="ps-3"><small class="text-muted"><?= $ks['created_at'] ?></small></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($ks['barang']) ?></td>
                                    <td>
                                        <?php if ($ks['jenis_transaksi'] === 'P'): ?>
                                            <span class="badge bg-success">Pengadaan</span>
                                        <?php elseif ($ks['jenis_transaksi'] === 'J'): ?>
                                            <span class="badge bg-danger">Penjualan</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= $ks['jenis_transaksi'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-bold text-success">+<?= $ks['masuk'] ?></td>
                                    <td class="pe-3 fw-bold" style="color: var(--magenta-accent);"><?= $ks['stock'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat stok.</td></tr>
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

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Menghubungkan ke dbconnect.php proyek DUBAICHEWYCOOKIE STORE
require_once 'dbconnect.php';

$conn = isset($dbconn) ? $dbconn : (isset($pdo) ? $pdo : null);

if (!$conn) {
    die("Koneksi database belum terhubung. Cek file dbconnect.php kamu!");
}

// Fetch data pengguna dari VIEW viewuser menggunakan PDO
$users = [];
try {
    $stmtUser = $conn->query("SELECT * FROM viewuser");
    $users = $stmtUser->fetchAll();
} catch (Exception $e) {
    try {
        // Fallback jika viewuser belum dibuat / menggunakan query JOIN langsung
        $queryFallback = "SELECT u.iduser, u.username, r.nama_role 
                          FROM user u 
                          LEFT JOIN role r ON u.idrole = r.idrole";
        $users = $conn->query($queryFallback)->fetchAll();
    } catch (Exception $ex) {
        $users = [];
    }
}

// Load Header komponen proyek (sudah mencakup Navbar & CSS tema DUBAICHEWYCOOKIE)
include 'includes/header.php';
?>

<div class="container mb-5">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-bold m-0">Data Pengguna</h3>
            <p class="text-muted m-0 small">Daftar user & hak akses sistem DUBAICHEWYCOOKIE STORE</p>
        </div>
        <a href="index.php" class="btn btn-outline-light btn-sm rounded-3 px-3">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <!-- Tabel Data User -->
    <div class="card-custom">
        <div class="card-custom-header d-flex justify-content-between align-items-center">
            <span>Daftar User Sistem</span>
            <span class="badge-custom">View: viewuser</span>
        </div>
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID User</th>
                        <th>Username</th>
                        <th class="pe-4">Role / Hak Akses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $row) : ?>
                        <tr>
                            <td class="ps-4 fw-bold" style="color: var(--purple-primary);">
                                #<?= htmlspecialchars($row['iduser'] ?? '-'); ?>
                            </td>
                            <td class="fw-semibold">
                                <?= htmlspecialchars($row['username'] ?? '-'); ?>
                            </td>
                            <td class="pe-4">
                                <span class="badge-custom">
                                    <?= htmlspecialchars($row['nama_role'] ?? 'No Role'); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                Data pengguna kosong atau view `viewuser` tidak ditemukan.
                            </td>
                        </tr>
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
// Load Footer komponen proyek jika tersedia
if (file_exists('includes/footer.php')) {
    include 'includes/footer.php'; 
}
?>

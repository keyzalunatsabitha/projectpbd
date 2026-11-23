<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hubungkan ke file koneksi PDO proyek
require_once 'dbconnect.php';

$conn = isset($dbconn) ? $dbconn : (isset($pdo) ? $pdo : null);

if (!$conn) {
    die("Koneksi database belum terhubung. Cek file dbconnect.php kamu!");
}

// Pastikan request dikirim via metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: halaman_login.php?pesan=akses_ditolak");
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];

try {
    // Prepared Statement PDO: Aman dari SQL Injection
    $stmt = $conn->prepare("
        SELECT u.iduser, u.username, u.password, r.nama_role
        FROM user u 
        JOIN role r ON u.idrole = r.idrole
        WHERE u.username = :username 
        LIMIT 1
    ");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    $valid = false;
    if ($user) {
        // Cek hash password_hash(), atau plaintext password
        if (password_verify($password, $user['password'])) {
            $valid = true;
        } elseif (hash_equals($user['password'], $password)) {
            $valid = true;
        }
    }

    if ($valid) {
        // Regenerasi ID Session untuk proteksi Session Fixation
        session_regenerate_id(true);

        // Simpan data session user
        $_SESSION['iduser']   = $user['iduser'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['nama_role'];

        header("Location: index.php");
        exit();
    } else {
        // Login gagal -> redirect ke halaman_login.php
        header("Location: halaman_login.php?pesan=gagal");
        exit();
    }

} catch (Exception $e) {
    // Handling error jika terjadi kesalahan query database
    header("Location: halaman_login.php?pesan=gagal");
    exit();
}

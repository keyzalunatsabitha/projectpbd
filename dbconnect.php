<?php
$host     = "localhost";
$port     = "3306";
$dbname   = "projectpbd";
$username = "root";
$password = "";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $dbconn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Pada lingkungan produksi/live, hindari menampilkan $e->getMessage() secara mentah
    die("Koneksi database gagal: " . $e->getMessage());
}
?>

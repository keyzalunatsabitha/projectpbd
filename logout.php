<?php
session_start();

// Kosongkan semua data session
$_SESSION = array();

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login yang benar
header("Location: halaman_login.php?pesan=logout");
exit();
?>

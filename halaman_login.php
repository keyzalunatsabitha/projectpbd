<?php
session_start();

// Jika user sudah login, redirect langsung ke index.php
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$pesan = "";
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        $pesan = "Username atau password salah!";
    } else if ($_GET['pesan'] == "logout") {
        $pesan = "Anda telah berhasil logout.";
    } else if ($_GET['pesan'] == "akses_ditolak") {
        $pesan = "Anda harus login terlebih dahulu!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DUBAICHEWYCOOKIE STORE</title>
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 36px 30px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .login-card h3 {
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 6px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .login-card p.subtitle {
            color: var(--text-muted);
            font-size: 0.875rem;
            text-align: center;
            margin-bottom: 24px;
        }

        .form-label {
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .form-control {
            background-color: #0b0a26;
            border: 1px solid var(--card-border);
            color: var(--text-light);
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            background-color: #0b0a26;
            border-color: var(--purple-primary);
            color: var(--text-light);
            box-shadow: 0 0 0 3px rgba(112, 48, 239, 0.25);
        }

        .form-control::placeholder {
            color: rgba(142, 139, 179, 0.5);
        }

        .btn-purple {
            background-color: var(--purple-primary);
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-purple:hover {
            background-color: #5d25cd;
            color: #ffffff;
        }

        .btn-purple:active {
            transform: scale(0.98);
        }

        .alert-custom {
            background-color: rgba(219, 31, 255, 0.15);
            border: 1px solid rgba(219, 31, 255, 0.3);
            color: var(--text-light);
            border-radius: 10px;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3>DUBAICHEWYCOOKIE</h3>
        <p class="subtitle">Masuk ke Sistem Informasi Inventaris & Kasir</p>

        <?php if (!empty($pesan)): ?>
            <div class="alert alert-custom p-3 mb-4 text-center">
                <?= htmlspecialchars($pesan) ?>
            </div>
        <?php endif; ?>

        <!-- Form mengirim data ke proses_login.php (atau login.php) -->
        <form action="proses_login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan username..." autocomplete="off">
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password...">
            </div>

            <button type="submit" class="btn btn-purple w-100 py-2">Masuk ke Sistem</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

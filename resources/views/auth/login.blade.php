<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DUBAICHEWYCOOKIE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --org-bg: #F7F5EB;
            --org-surface: #EBE7D9;
            --org-dark: #1C1C1E;
            --org-muted: #6E6D68;
            --org-pink: #F4B8E4;
            --org-yellow: #F7DC6F;
            --org-green: #9CB370;
            --org-blue: #B5C7EB;
        }

        body.org-login-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--org-bg);
            color: var(--org-dark);
            min-height: 100vh;
            margin: 0;
        }

        .org-login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 16px;
        }

        .org-pill-badge {
            background-color: var(--org-dark);
            color: var(--org-bg);
            border-radius: 9999px;
            padding: 8px 18px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .org-login-card {
            background-color: var(--org-surface);
            border: 1px solid rgba(28, 28, 30, 0.08);
            border-radius: 24px;
            padding: 36px 32px;
        }

        .org-avatar-circle {
            width: 60px;
            height: 60px;
            border-radius: 9999px;
            background-color: var(--org-pink);
            color: var(--org-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .org-alert-warning {
            background-color: var(--org-yellow);
            color: var(--org-dark);
            border: none;
            border-radius: 24px;
            padding: 14px 18px;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .org-alert-icon {
            width: 34px;
            height: 34px;
            border-radius: 9999px;
            background-color: var(--org-dark);
            color: var(--org-yellow);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .org-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--org-dark);
            margin-bottom: 8px;
            margin-left: 8px;
        }

        .org-input-group {
            position: relative;
        }

        .org-input-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: var(--org-muted);
            pointer-events: none;
            display: inline-flex;
            align-items: center;
        }

        .org-input {
            background-color: var(--org-bg) !important;
            border: 1.5px solid rgba(28, 28, 30, 0.12) !important;
            color: var(--org-dark) !important;
            border-radius: 9999px !important;
            padding: 12px 20px 12px 44px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease, background-color 0.2s ease;
        }

        .org-input::placeholder {
            color: var(--org-muted);
            opacity: 0.7;
        }

        .org-input:focus {
            border-color: var(--org-dark) !important;
            background-color: #FFFFFF !important;
        }

        .org-btn-primary {
            background-color: var(--org-dark);
            color: var(--org-bg);
            border: none;
            border-radius: 9999px;
            padding: 13px 24px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.02em;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity 0.2s ease;
        }

        .org-btn-primary:hover {
            opacity: 0.9;
            color: var(--org-bg);
        }

        .org-dot {
            width: 9px;
            height: 9px;
            border-radius: 9999px;
            display: inline-block;
        }
    </style>
</head>
<body class="org-login-body d-flex align-items-center justify-content-center">

    <div class="org-login-wrapper">
        {{-- Floating Top Brand Pill --}}
        <div class="text-center mb-4">
            <span class="org-pill-badge">
                <span class="org-dot" style="background-color: var(--org-pink);"></span>
                <span>Sistem Inventaris &amp; Kasir</span>
            </span>
        </div>

        {{-- Kartu Utama Login --}}
        <div class="org-login-card">
            <div class="text-center mb-4">
                <div class="org-avatar-circle">
                    <svg width="24" height="24" style="width: 24px; height: 24px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h4 class="fw-extrabold mb-1" style="font-size: 22px; letter-spacing: -0.02em; color: var(--org-dark);">
                    DUBAICHEWYCOOKIE
                </h4>
                <p class="mb-0" style="font-size: 13px; color: var(--org-muted);">
                    Masuk ke akun Anda untuk mengelola toko
                </p>
            </div>

            @if(session('pesan'))
                <div class="org-alert-warning" role="alert">
                    <div class="org-alert-icon">
                        <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <span>{{ session('pesan') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label org-label">Username</label>
                    <div class="org-input-group">
                        <span class="org-input-icon">
                            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input type="text" name="username" class="form-control org-input" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label org-label">Password</label>
                    <div class="org-input-group">
                        <span class="org-input-icon">
                            <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input type="password" name="password" class="form-control org-input" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="org-btn-primary">
                    <span>Masuk</span>
                    <svg width="18" height="18" style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        {{-- Aksen Pastel Footer --}}
        <div class="d-flex align-items-center justify-content-center gap-2 mt-4">
            <span class="org-dot" style="background-color: var(--org-pink);"></span>
            <span class="org-dot" style="background-color: var(--org-yellow);"></span>
            <span class="org-dot" style="background-color: var(--org-green);"></span>
            <span class="org-dot" style="background-color: var(--org-blue);"></span>
        </div>
    </div>

</body>
</html>

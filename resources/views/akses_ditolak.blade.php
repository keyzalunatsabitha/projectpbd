<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-cream: #F7F5EB;
            --surface-sand: #EBE7D9;
            --ink-charcoal: #1C1C1E;
            --ink-muted: #6E6D68;
            --pastel-pink: #F4B8E4;
            --pastel-yellow: #F7DC6F;
        }

        body {
            background-color: var(--bg-cream);
            color: var(--ink-charcoal);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        .organic-card {
            background-color: var(--pastel-pink);
            border: none;
            border-radius: 28px;
            max-width: 440px;
            width: 100%;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Aksen organik lembut di latar kartu */
        .organic-card::after {
            content: '';
            position: absolute;
            bottom: -45px;

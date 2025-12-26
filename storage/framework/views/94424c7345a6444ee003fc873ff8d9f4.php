<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GMCI Ambulance Dispatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --primary: #2563eb;
            --bg: #f1f5f9;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
        }

        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
        }

        header {
            background: var(--primary);
            color: white;
            padding: 28px 24px;
        }

        header h1 {
            margin: 0;
            font-size: 26px;
        }

        header p {
            margin-top: 6px;
            font-size: 15px;
            opacity: 0.9;
        }

        main {
            max-width: 1100px;
            margin: auto;
            padding: 32px 24px;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 32px;
            align-items: center;
        }

        .hero h2 {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .hero p {
            color: var(--muted);
            line-height: 1.6;
        }

        .hero a {
            display: inline-block;
            margin-top: 20px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 15px;
        }

        .hero a:hover {
            background: #1e40af;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 48px;
        }

        .card {
            background: var(--card);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 17px;
        }

        .card p {
            margin: 0;
            font-size: 14px;
            color: var(--muted);
        }

        footer {
            margin-top: 60px;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        @media (max-width: 768px) {
            .hero {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>🚑 GMCI Ambulance Dispatch</h1>
    <p>Global Medical Care Indonesia</p>
</header>

<main>

    <!-- HERO -->
    <section class="hero">
        <div>
            <h2>Sistem Dispatch Ambulans Terintegrasi</h2>
            <p>
                GMCI Ambulance Dispatch adalah sistem untuk mengelola armada ambulans,
                driver, dan panggilan darurat secara cepat, akurat, dan terkoordinasi.
                Dirancang untuk mendukung misi kemanusiaan Global Medical Care Indonesia.
            </p>

            <a href="/login">🔐 Login Admin / Dispatcher</a>
        </div>

        <div class="card">
            <h3>📌 Status Sistem</h3>
            <p>Online & Siap Digunakan</p>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="card-grid">
        <div class="card">
            <h3>🚑 Manajemen Ambulans</h3>
            <p>Kelola data ambulans, status, dan kesiapan armada secara real-time.</p>
        </div>

        <div class="card">
            <h3>👨‍✈️ Manajemen Driver</h3>
            <p>Atur driver, jadwal, dan penugasan dengan rapi dan terstruktur.</p>
        </div>

        <div class="card">
            <h3>📞 Dispatch Panggilan</h3>
            <p>Proses panggilan darurat dan distribusi ambulans dengan cepat.</p>
        </div>

        <div class="card">
            <h3>📊 Pelaporan</h3>
            <p>Rekap aktivitas layanan untuk evaluasi dan peningkatan kualitas.</p>
        </div>
    </section>

</main>

<footer>
    © <?php echo e(date('Y')); ?> Global Medical Care Indonesia · Ambulance Dispatch System
</footer>

</body>
</html>
<?php /**PATH /var/www/ambulance-dispatch/resources/views/home.blade.php ENDPATH**/ ?>
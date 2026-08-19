<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUPS Harapan Asri — Jamur Tiram Organik</title>
    <meta name="description" content="KUPS Harapan Asri, Nagari Sijunjung — Produsen jamur tiram organik segar dengan sistem produksi digital.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: #2c2c2c;
            background: #f5f0e8;
            line-height: 1.6;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #f0ebe0;
            border-bottom: 1px solid #d5cab4;
            padding: 0 24px;
        }
        .navbar-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
        }
        .brand-icon {
            width: 34px; height: 34px;
            background: #2d5a3d;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 15px;
        }
        .brand-name { font-weight: 700; font-size: 14px; color: #111; }
        .brand-sub  { font-size: 11px; color: #6b7280; }
        .nav-links  { display: flex; align-items: center; gap: 28px; list-style: none; }
        .nav-links a {
            font-size: 13px; font-weight: 500;
            color: #555; text-decoration: none;
            transition: color .15s;
        }
        .nav-links a:hover { color: #2d5a3d; }
        .nav-btn {
            font-size: 13px; font-weight: 600;
            color: #fff !important; background: #2d5a3d !important;
            padding: 7px 18px; border-radius: 5px;
            text-decoration: none; transition: background .15s;
        }
        .nav-btn:hover { background: #1e3d2a !important; color: #fff !important; }
        .nav-mobile-btn {
            display: none; border: none; background: none;
            cursor: pointer; padding: 6px;
        }
        .nav-mobile {
            display: none;
            background: #f0ebe0;
            border-top: 1px solid #d5cab4;
            padding: 12px 24px;
        }
        .nav-mobile.open { display: block; }
        .nav-mobile a {
            display: block; padding: 10px 0;
            font-size: 14px; color: #333;
            text-decoration: none;
            border-bottom: 1px solid #f3f4f6;
        }

        /* ─── HERO ─── */
        .hero {
            position: relative;
            height: 520px;
            overflow: hidden;
        }
        .hero img {
            width: 100%; height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to right, rgba(0,0,0,.65) 0%, rgba(0,0,0,.25) 100%);
            display: flex; align-items: center;
            padding: 0 48px;
        }
        .hero-text { max-width: 520px; color: #fff; }
        .hero-badge {
            display: inline-block;
            font-size: 11px; font-weight: 600;
            letter-spacing: .08em; text-transform: uppercase;
            color: #a7f3d0; margin-bottom: 14px;
        }
        .hero-title {
            font-size: clamp(26px, 4vw, 42px);
            font-weight: 700; line-height: 1.2;
            margin-bottom: 14px;
        }
        .hero-desc {
            font-size: 14px; color: rgba(255,255,255,.8);
            line-height: 1.65; margin-bottom: 28px;
            max-width: 420px;
        }
        .hero-meta {
            display: flex; gap: 28px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.2);
        }
        .hero-meta-num  { font-size: 22px; font-weight: 700; }
        .hero-meta-label{ font-size: 11px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: .06em; margin-top: 2px; }

        /* ─── LAYOUT UMUM ─── */
        .container { max-width: 1100px; margin: 0 auto; padding: 0 24px; }
        .section   { padding: 64px 24px; }
        .section-sm{ padding: 48px 24px; }
        .section-dark { background: #eae4d8; }

        .section-head { margin-bottom: 36px; }
        .section-tag {
            font-size: 11px; font-weight: 700;
            letter-spacing: .12em; text-transform: uppercase;
            color: #2d5a3d; margin-bottom: 8px;
        }
        .section-title {
            font-size: 26px; font-weight: 700;
            color: #111; line-height: 1.25;
        }
        .section-sub {
            font-size: 14px; color: #6b7280;
            margin-top: 8px; max-width: 520px; line-height: 1.65;
        }
        .divider { border: none; border-top: 1px solid #cfc7b5; margin: 0; }

        /* ─── TENTANG ─── */
        .about-grid {
            display: grid;
            grid-template-columns: 5fr 7fr;
            gap: 64px;
            align-items: flex-start;
        }
        .about-img {
            width: 100%; border-radius: 8px;
            aspect-ratio: 4/5; object-fit: cover;
            position: sticky; top: 100px;
        }
        .about-list { display: flex; flex-direction: column; gap: 16px; margin-top: 32px; }
        .about-item {
            display: flex; gap: 16px; align-items: flex-start;
            padding: 16px; border: 1px solid #cfc7b5;
            border-radius: 6px; background: #faf7f1;
        }
        .about-icon {
            width: 36px; height: 36px;
            background: #ecfdf5; color: #2d5a3d;
            border-radius: 6px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .about-item-title { font-size: 14px; font-weight: 600; color: #111; margin-bottom: 4px; }
        .about-item-desc  { font-size: 13px; color: #6b7280; line-height: 1.6; }
        .stats-row {
            display: flex; gap: 40px;
            margin-top: 36px; padding-top: 24px;
            border-top: 1px solid #cfc7b5;
        }
        .stat-val   { font-size: 32px; font-weight: 700; color: #2d5a3d; line-height: 1; }
        .stat-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: .06em; margin-top: 6px; font-weight: 600; }

        /* ─── ALUR PRODUKSI ─── */
        .steps {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
            margin-top: 36px;
        }
        .step {
            text-align: center;
            padding: 20px 12px;
            border: 1px solid #cfc7b5;
            border-radius: 6px;
            background: #faf7f1;
            position: relative;
        }
        .step::after {
            content: '›';
            position: absolute;
            right: -14px; top: 50%;
            transform: translateY(-50%);
            font-size: 20px; color: #d1d5db;
            font-weight: 300;
        }
        .step:last-child::after { display: none; }
        .step-num {
            display: inline-flex;
            align-items: center; justify-content: center;
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #ecfdf5; color: #2d5a3d;
            font-size: 14px; font-weight: 700;
            margin: 0 auto 10px;
        }
        .step-last .step-num { background: #fef3c7; color: #92400e; }
        .step-label { font-size: 12px; font-weight: 600; color: #111; margin-bottom: 4px; }
        .step-desc  { font-size: 11px; color: #9ca3af; line-height: 1.5; }

        /* ─── KATALOG ─── */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 16px;
            margin-top: 36px;
        }
        .catalog-card {
            border: 1px solid #cfc7b5;
            border-radius: 6px;
            overflow: hidden;
            background: #faf7f1;
            display: flex;
            flex-direction: column;
        }
        .catalog-img {
            aspect-ratio: 4/3;
            overflow: hidden;
            background: #e8e0d2;
            position: relative;
        }
        .catalog-img img {
            width: 100%; height: 100%;
            object-fit: cover;
        }
        .catalog-img-empty {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            color: #d1d5db; gap: 6px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .06em;
        }
        .catalog-badge {
            position: absolute; top: 10px; left: 10px;
            background: #2d5a3d; color: #fff;
            font-size: 10px; font-weight: 700;
            padding: 3px 8px; border-radius: 3px;
            letter-spacing: .06em; text-transform: uppercase;
        }
        .catalog-body { padding: 14px; flex: 1; display: flex; flex-direction: column; }
        .catalog-name {
            font-size: 15px; font-weight: 600;
            color: #111; margin-bottom: 6px;
        }
        .catalog-desc {
            font-size: 12px; color: #6b7280;
            line-height: 1.6; flex: 1; margin-bottom: 12px;
        }
        .catalog-footer {
            display: flex; align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #e8e0d2;
        }
        .catalog-price-label { font-size: 10px; color: #9ca3af; text-transform: uppercase; letter-spacing: .06em; }
        .catalog-price { font-size: 17px; font-weight: 700; color: #111; margin-top: 1px; }
        .catalog-tag {
            font-size: 11px; font-weight: 600;
            color: #2d5a3d; background: #ecfdf5;
            padding: 4px 10px; border-radius: 3px;
        }
        .catalog-empty {
            text-align: center; padding: 64px 24px;
            border: 1px dashed #cfc7b5;
            border-radius: 6px; color: #9ca3af;
        }
        .catalog-empty-title { font-size: 16px; font-weight: 600; color: #374151; margin-bottom: 6px; }

        /* ─── GALERI ─── */
        .gallery-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: 240px 180px;
            gap: 8px;
            margin-top: 36px;
        }
        .gallery-item { overflow: hidden; border-radius: 4px; }
        .gallery-item:first-child { grid-row: 1 / 3; }
        .gallery-item img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
        }

        /* ─── KONTAK ─── */
        .kontak-section-head {
            text-align: center;
            display: flex; flex-direction: column; align-items: center;
            margin-bottom: 40px;
        }
        .kontak-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
            max-width: 800px;
            margin: 0 auto;
            align-items: start;
        }
        .kontak-info-item {
            display: flex; gap: 16px; align-items: flex-start;
            background: #fff; padding: 20px; border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
            border: 1px solid #e8e0d2;
        }
        .kontak-icon {
            width: 40px; height: 40px;
            background: #ecfdf5; color: #2d5a3d;
            border-radius: 8px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .kontak-icon svg { width: 20px; height: 20px; }
        .kontak-info-title { font-size: 14px; font-weight: 700; color: #111; margin-bottom: 4px; }
        .kontak-info-desc  { font-size: 13px; color: #6b7280; line-height: 1.5; }

        /* ─── FOOTER ─── */
        footer {
            background: #141414;
            color: rgba(255,255,255,.6);
            padding: 24px 24px;
        }
        .footer-inner {
            max-width: 1100px; margin: 0 auto;
        }
        .footer-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .footer-brand { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 12px; }
        .footer-brand-logo {
            width: 32px; height: 32px; border-radius: 6px;
            background: #2d5a3d; color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700;
        }
        .footer-brand-name { font-size: 16px; font-weight: 700; color: #fff; letter-spacing: .02em; }
        .footer-desc { font-size: 14px; line-height: 1.6; max-width: 450px; color: rgba(255,255,255,.5); margin: 0 auto; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .nav-links { display: none; }
            .nav-mobile-btn { display: block; }
            .about-grid    { grid-template-columns: 1fr; gap: 32px; }
            .steps         { grid-template-columns: repeat(3, 1fr); gap: 12px; }
            .step::after   { display: none; }
            .gallery-grid  { grid-template-columns: 1fr 1fr; grid-template-rows: auto; }
            .gallery-item:first-child { grid-row: auto; height: 200px; }
            .gallery-item  { height: 160px; }
            .kontak-grid   { grid-template-columns: 1fr; gap: 16px; }
            .footer-top    { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .hero          { height: 420px; }
            .hero-overlay  { padding: 0 24px; }
            .steps         { grid-template-columns: 1fr 1fr; }
            .gallery-grid  { grid-template-columns: 1fr; }
            .gallery-item  { height: 180px; }
            .footer-top    { grid-template-columns: 1fr; }
            .hero-meta     { flex-wrap: wrap; gap: 16px; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<header>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="#" class="brand">
                <div class="brand-icon">K</div>
                <div>
                    <div class="brand-name">KUPS Harapan Asri</div>
                    <div class="brand-sub">Nagari Sijunjung</div>
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="{{ route('public.profile-kups') }}" class="font-bold text-[#2d5a3d]">Profil KUPS</a></li>
                <li><a href="#proses">Proses Produksi</a></li>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#galeri">Galeri</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="{{ route('login') }}" class="nav-btn">Masuk</a></li>
            </ul>
            <button class="nav-mobile-btn" id="hamburger" aria-label="Menu">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>
    <div class="nav-mobile" id="nav-mobile">
        <a href="#tentang">Tentang Kami</a>
        <a href="{{ route('public.profile-kups') }}" style="color:#2d5a3d;font-weight:700">Lihat Profil KUPS</a>
        <a href="#proses">Proses Produksi</a>
        <a href="#produk">Produk</a>
        <a href="#galeri">Galeri</a>
        <a href="#kontak">Kontak</a>
        <a href="{{ route('login') }}" style="color:#2d5a3d;font-weight:600">Masuk ke Sistem</a>
    </div>
</header>

{{-- HERO --}}
<section class="hero">
    <img src="{{ asset('images/hero_jamur_tiram.png') }}" alt="Jamur Tiram Segar KUPS Harapan Asri">
    <div class="hero-overlay">
        <div class="hero-text">
            <div class="hero-badge">Kelompok Usaha Perhutanan Sosial</div>
            <h1 class="hero-title">KUPS Harapan Asri</h1>
            <p class="hero-desc">
                Produsen jamur tiram organik dari Nagari Sijunjung. Dibudidayakan secara alami oleh perempuan petani dengan standar mutu yang terdigitalisasi.
            </p>
        </div>
    </div>
</section>

{{-- TENTANG --}}
<section class="section" id="tentang">
    <div class="container">
        <div class="about-grid">
            <div>
                <img src="{{ asset('images/jamur.jpeg') }}" alt="Hasil Panen Jamur Tiram" class="about-img">
            </div>
            <div>
                <div class="section-head">
                    <div class="section-tag">Tentang Kami</div>
                    <h2 class="section-title">{{ $profile->nama_kups ?? 'Memberdayakan Perempuan melalui Pertanian Organik' }}</h2>
                    <p class="section-sub">
                        {{ $profile->tentang_kami ?? 'KUPS Harapan Asri adalah kelompok usaha perhutanan sosial di bawah naungan LPHN Nagari Sijunjung yang bergerak di bidang budidaya jamur tiram organik. Seluruh anggota adalah perempuan yang terlatih menjalankan proses produksi secara mandiri dan terdata.' }}
                    </p>
                    <div style="margin-bottom: 20px;">
                        <a href="{{ route('public.profile-kups') }}" style="color: #2d5a3d; font-weight: 700; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
                            <span>Lihat Visi, Misi & Detail Legalitas</span>
                            <span>➔</span>
                        </a>
                    </div>
                </div>
                <div class="about-list">
                    <div class="about-item">
                        <div class="about-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="about-item-title">Organik Tanpa Bahan Kimia</div>
                            <div class="about-item-desc">Media tanam dari serbuk kayu murni, bebas pestisida dan pengawet.</div>
                        </div>
                    </div>
                    <div class="about-item">
                        <div class="about-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <div class="about-item-title">Produksi Terdata Secara Digital</div>
                            <div class="about-item-desc">Setiap tahap dari baglog hingga panen dicatat dalam sistem informasi.</div>
                        </div>
                    </div>
                    <div class="about-item">
                        <div class="about-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="about-item-title">Panen Setiap Pagi</div>
                            <div class="about-item-desc">Pemanenan dilakukan pagi hari untuk menjaga kesegaran dan kualitas produk.</div>
                        </div>
                    </div>
                </div>
                <div class="stats-row">
                    <div>
                        <div class="stat-val">{{ $profile->jumlah_anggota ?? 15 }}</div>
                        <div class="stat-label">Anggota Aktif</div>
                    </div>
                    <div>
                        <div class="stat-val">{{ $profile->siklus_panen ?? 5 }}×</div>
                        <div class="stat-label">Siklus Panen</div>
                    </div>
                    <div>
                        <div class="stat-val">{{ $profile->tahun_berdiri ?? 2021 }}</div>
                        <div class="stat-label">Tahun Berdiri</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="divider">

{{-- PROSES PRODUKSI --}}
<section class="section section-dark" id="proses">
    <div class="container">
        <div class="section-head">
            <div class="section-tag">Alur Produksi</div>
            <h2 class="section-title">Tahapan Produksi Jamur Tiram</h2>
            <p class="section-sub">Lima tahap yang terstruktur dan terpantau untuk memastikan kualitas setiap batch produksi.</p>
        </div>
        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <div class="step-label">Pembuatan Baglog</div>
                <div class="step-desc">Media tanam serbuk kayu diformulasikan dan dibentuk dalam kantong khusus</div>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <div class="step-label">Sterilisasi</div>
                <div class="step-desc">Baglog dipanaskan untuk menghilangkan kontaminan dan bakteri</div>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <div class="step-label">Inokulasi</div>
                <div class="step-desc">Bibit jamur ditanam ke dalam baglog yang telah steril</div>
            </div>
            <div class="step step-last">
                <div class="step-num">4</div>
                <div class="step-label">Monitoring</div>
                <div class="step-desc">Suhu dan kelembaban kumbung dipantau harian </div>
            </div>
            <div class="step step-last">
                <div class="step-num">5</div>
                <div class="step-label">Panen</div>
                <div class="step-desc">Hasil dipilah Grade A dan B, lalu dilaporkan ke sistem</div>
            </div>
        </div>
    </div>
</section>

<hr class="divider">

{{-- KATALOG PRODUK --}}
<section class="section" id="produk">
    <div class="container">
        <div class="section-head">
            <div class="section-tag">Produk Kami</div>
            <h2 class="section-title">Katalog Jamur Tiram Segar</h2>
            <p class="section-sub">Tersedia segar setiap hari, langsung dari kumbung KUPS Harapan Asri.</p>
        </div>

        @if($catalogs->count() > 0)
        <div class="catalog-grid">
            @foreach($catalogs as $catalog)
            <div class="catalog-card">
                <div class="catalog-img">
                    @if($catalog->image)
                        <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->name }}">
                    @else
                        <div class="catalog-img-empty">
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Foto Belum Ada
                        </div>
                    @endif
                    {{-- <span class="catalog-badge">Organik</span> --}}
                </div>
                <div class="catalog-body">
                    <h3 class="catalog-name">{{ $catalog->name }}</h3>
                    <p class="catalog-desc">{{ $catalog->description }}</p>
                    <div class="catalog-footer">
                        <div>
                            <div class="catalog-price-label">Harga</div>
                            <div class="catalog-price">Rp{{ number_format($catalog->price, 0, ',', '.') }}</div>
                        </div>
                        {{-- <span class="catalog-tag">Segar ✓</span> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="catalog-empty">
            <div class="catalog-empty-title">Belum Ada Produk</div>
            <p>Katalog produk akan segera ditambahkan.</p>
        </div>
        @endif
    </div>
</section>

<hr class="divider">

{{-- GALERI --}}
<section class="section section-dark" id="galeri">
    <div class="container">
        <div class="section-head">
            <div class="section-tag">Galeri</div>
            <h2 class="section-title">Kumbung Budidaya Kami</h2>
            <p class="section-sub">Suasana lingkungan kumbung jamur tiram KUPS Harapan Asri di Nagari Sijunjung.</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="{{ asset('images/kumbung.jpeg') }}" alt="Kumbung Utama">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/kumbung1.jpeg') }}" alt="Rak Baglog">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/kumbung2.jpeg') }}" alt="Proses Budidaya">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/kumbung3.jpeg') }}" alt="Inkubasi">
            </div>
        </div>
    </div>
</section>

<hr class="divider">

{{-- KONTAK --}}
<section class="section" id="kontak">
    <div class="container">
        <div class="section-head kontak-section-head">
            <div class="section-tag">Kontak</div>
            <h2 class="section-title">Hubungi Kami</h2>
            <p class="section-sub">Untuk pembelian, kemitraan, atau informasi lebih lanjut mengenai KUPS Harapan Asri.</p>
        </div>
        <div class="kontak-grid">
            <div class="kontak-info-item">
                <div class="kontak-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <div class="kontak-info-title">Lokasi</div>
                    <div class="kontak-info-desc">{{ $profile->alamat ?? 'Nagari Sijunjung, Kabupaten Sijunjung, Sumatera Barat' }}</div>
                </div>
            </div>
            <div class="kontak-info-item">
                <div class="kontak-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <div class="kontak-info-title">Naungan</div>
                    <div class="kontak-info-desc">LPHN Nagari Sijunjung — Program Perhutanan Sosial</div>
                </div>
            </div>
            <div class="kontak-info-item">
                <div class="kontak-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <div class="kontak-info-title">Telepon / No. HP</div>
                    <div class="kontak-info-desc">{{ $profile->nomor_telepon ?? '+62 812-3456-7890' }}</div>
                </div>
            </div>
            <div class="kontak-info-item">
                <div class="kontak-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="kontak-info-title">Email</div>
                    <div class="kontak-info-desc">{{ $profile->email ?? 'info@kupsharapanasri.com' }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div>
                <div class="footer-brand">
                    <div class="footer-brand-logo">K</div>
                    <span class="footer-brand-name">KUPS Harapan Asri</span>
                </div>
                <p class="footer-desc">
                    Kelompok Usaha Perhutanan Sosial yang mengembangkan budidaya jamur tiram organik di Nagari Sijunjung, Sumatera Barat.
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Hamburger toggle
    const hamburger = document.getElementById('hamburger');
    const navMobile = document.getElementById('nav-mobile');
    hamburger.addEventListener('click', function() {
        navMobile.classList.toggle('open');
    });
    navMobile.querySelectorAll('a').forEach(function(a) {
        a.addEventListener('click', function() { navMobile.classList.remove('open'); });
    });
</script>
</body>
</html>

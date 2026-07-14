<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUPS Harapan Asri — Jamur Tiram Organik</title>
    <meta name="description" content="Sistem Informasi Produksi Jamur Tiram KUPS Harapan Asri. Temukan jamur berkualitas tinggi.">

    <!-- Google Fonts: Fraunces & Inter (Original Theme Fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            /* Original Theme Colors */
            --moss: #3A5A40;
            --moss-dark: #344E41;
            --moss-light: #588157;
            --clay: #BC6C25;
            --clay-light: #DDA15E;
            --tan: #E6D5B8;
            --paper: #FDFCF9;
            --paper-alt: #F9F6F0;
            --text-main: #1F2937;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--paper);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, .font-heading {
            font-family: 'Fraunces', serif;
        }

        /* Glass Navbar */
        .glass-nav {
            background: rgba(253, 252, 249, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(230, 213, 184, 0.2);
            transition: all 0.3s ease;
        }
        .nav-scrolled {
            background: rgba(253, 252, 249, 0.95);
            border-bottom: 1px solid rgba(230, 213, 184, 0.5);
            box-shadow: 0 4px 30px rgba(58, 90, 64, 0.05);
        }

        /* Ambient Glow Hero */
        .hero-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(180,160,130,0.08) 1px, transparent 0);
            background-size: 28px 28px;
        }
        .hero-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(188,108,37,0.1) 0%, rgba(255,255,255,0) 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            filter: blur(40px);
        }

        /* Modern Buttons adapted to old colors */
        .btn-modern {
            background: linear-gradient(135deg, var(--moss) 0%, var(--moss-light) 100%);
            color: white;
            border-radius: 9999px; /* Pill shape */
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 16px -4px rgba(58, 90, 64, 0.35);
        }
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px -4px rgba(58, 90, 64, 0.45);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--moss);
            border: 1px solid var(--tan);
            border-radius: 9999px;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .btn-outline:hover {
            border-color: var(--moss);
            background-color: var(--paper-alt);
        }

        /* Bento Grid Cards */
        .bento-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            border: 1px solid rgba(230,213,184,0.5);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 12px -4px rgba(58,90,64,0.05);
        }
        .bento-card:hover {
            border-color: rgba(230,213,184,0.8);
            box-shadow: 0 20px 40px -15px rgba(58,90,64,0.08);
            transform: translateY(-4px);
        }

        /* ===== CATALOG REFINEMENTS ===== */
        .catalog-card {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(230,213,184,0.5);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px -4px rgba(58,90,64,0.05);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .catalog-card:hover {
            border-color: var(--moss-light);
            box-shadow: 0 20px 48px -10px rgba(58, 90, 64, 0.12);
            transform: translateY(-4px);
        }

        .img-zoom {
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .catalog-card:hover .img-zoom {
            transform: scale(1.08);
        }

        /* Minimal Badges */
        .chip {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            background: var(--paper-alt);
            border: 1px solid var(--tan);
            color: var(--text-main);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .chip-moss {
            background: rgba(58, 90, 64, 0.1);
            border-color: transparent;
            color: var(--moss);
        }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
    </style>
</head>
<body class="antialiased selection:bg-[#3A5A40] selection:text-white">

<!-- NAVBAR -->
<nav id="navbar" class="fixed w-full top-0 z-50 glass-nav">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="#beranda" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#3A5A40] to-[#588157] flex items-center justify-center text-white font-black font-heading text-xl group-hover:scale-105 transition-transform shadow-md">
                    K
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-black text-gray-900 text-lg font-heading tracking-tight">KUPS Harapan Asri</span>
                    <span class="text-[#BC6C25] text-[9px] font-black uppercase tracking-[0.2em] mt-0.5">Premium Organik</span>
                </div>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#beranda" class="text-sm font-semibold text-gray-600 hover:text-[#3A5A40] transition-colors">Beranda</a>
                <a href="#profil" class="text-sm font-semibold text-gray-600 hover:text-[#3A5A40] transition-colors">Tentang & Keunggulan</a>
                <a href="#katalog" class="text-sm font-semibold text-gray-600 hover:text-[#3A5A40] transition-colors">Produk</a>
                <a href="#galeri" class="text-sm font-semibold text-gray-600 hover:text-[#3A5A40] transition-colors">Galeri</a>
                <a href="{{ route('login') }}" class="btn-modern !py-2 !px-5 !text-sm">
                    Akses Sistem
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button id="mobile-btn" class="md:hidden text-gray-600 p-2 border border-[#E6D5B8]/50 rounded-xl bg-[#F9F6F0]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden bg-white/95 backdrop-blur-lg border-b border-[#E6D5B8]/40 px-6 py-4 space-y-2 absolute w-full shadow-xl">
        <a href="#beranda" class="block py-2 text-gray-800 font-semibold">Beranda</a>
        <a href="#profil" class="block py-2 text-gray-800 font-semibold">Tentang & Keunggulan</a>
        <a href="#katalog" class="block py-2 text-gray-800 font-semibold">Produk</a>
        <a href="#galeri" class="block py-2 text-gray-800 font-semibold">Galeri</a>
        <a href="{{ route('login') }}" class="block w-full text-center btn-modern mt-4">Masuk Sistem</a>
    </div>
</nav>

<!-- HERO SECTION -->
<section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-[#FDFCF9] hero-pattern">
    <div class="hero-glow"></div>
    <!-- Soft gradient blobs -->
    <div class="absolute top-0 right-0 w-[60%] h-[80%] bg-gradient-to-bl from-[#F9F6F0]/90 via-[#F6F1E6]/40 to-transparent pointer-events-none -z-10 rounded-bl-[160px]"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div class="space-y-8 z-10 text-center lg:text-left">
                <div class="inline-flex mx-auto lg:mx-0">
                    <span class="chip chip-moss gap-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#3A5A40] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#3A5A40]"></span>
                        </span>
                        Panen Segar Hari Ini
                    </span>
                </div>

                <h1 class="text-[2.6rem] sm:text-5xl lg:text-[4rem] font-black leading-[1.08] tracking-tight font-heading text-gray-900">
                    Kesegaran Jamur <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#3A5A40] to-[#588157]">Dari Hulu ke Hilir.</span>
                </h1>

                <p class="text-gray-500 text-base md:text-lg font-medium max-w-lg mx-auto lg:mx-0 leading-relaxed">
                    Sistem informasi terpadu KUPS Harapan Asri untuk memastikan standar mutu, transparansi produksi, dan distribusi jamur tiram organik segar langsung dari kumbung kami.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="#katalog" class="btn-modern w-full sm:w-auto">
                        Lihat Produk
                    </a>
                    <a href="#profil" class="btn-outline w-full sm:w-auto">
                        Pelajari KUPS
                    </a>
                </div>

                <div class="pt-8 flex items-center justify-center lg:justify-start gap-8 lg:gap-12 border-t border-[#E6D5B8]/40">
                    <div class="text-left">
                        <p class="text-[2.2rem] font-black font-heading text-gray-900 leading-none">100<span class="text-[#BC6C25]">%</span></p>
                        <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Organik Murni</p>
                    </div>
                    <div class="text-left">
                        <p class="text-[2.2rem] font-black font-heading text-gray-900 leading-none">15<span class="text-[#BC6C25] font-heading text-xl ml-1">org</span></p>
                        <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Anggota Aktif</p>
                    </div>
                </div>
            </div>

            <div class="relative w-full max-w-lg mx-auto lg:max-w-none">
                <!-- Decorative tilted frame -->
                <div class="absolute inset-0 bg-gradient-to-tr from-[#DDA15E]/30 to-[#BC6C25]/10 rounded-[3rem] transform rotate-3 scale-105 -z-10"></div>

                <div class="rounded-[3rem] overflow-hidden border-[5px] border-white shadow-2xl relative">
                    <img src="{{ asset('images/jamur.jpeg') }}" alt="Jamur Tiram Segar" class="w-full aspect-square lg:aspect-[4/3] object-cover">

                    <!-- Floating Stat -->
                    <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-md px-5 py-3 rounded-2xl shadow-lg border border-[#E6D5B8]/30">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Kumbung</p>
                        <p class="text-sm font-black font-heading text-[#3A5A40] flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#BC6C25]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Suhu Optimal
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- COMBINED BENTO GRID (Profil & Keunggulan) -->
<section id="profil" class="py-24 bg-[#F9F6F0]">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="reveal text-center mb-16 max-w-2xl mx-auto">
            <span class="chip mb-4 bg-white shadow-sm border-[#E6D5B8]/50">
                <svg class="w-3 h-3 text-[#BC6C25] mr-1.5 inline-block" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                Profil & Komitmen Kami
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight font-heading leading-[1.1] mb-5">Merawat Alam, <br><span class="text-[#3A5A40]">Memberdayakan Petani</span></h2>
            <p class="text-gray-500 text-base leading-relaxed">Kelompok Usaha Perhutanan Sosial beranggotakan perempuan Nagari Sijunjung yang mendedikasikan diri pada kelestarian hutan dan kemandirian ekonomi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Bento 1: Large Profil -->
            <div class="reveal bento-card md:col-span-2 row-span-2 flex flex-col justify-between">
                <div>
                    <span class="chip chip-moss mb-4">Sejak 2021</span>
                    <h3 class="text-2xl font-black font-heading text-gray-900 mb-3 leading-tight">Pemberdayaan Perempuan melalui Perhutanan Sosial</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Di bawah naungan LPHN Nagari Sijunjung, kami mengelola kumbung budidaya jamur tiram organik. Segala proses mulai dari sterilisasi baglog hingga pemanenan dipantau melalui sistem terpadu guna menjaga mutu produk.</p>
                </div>
                <div class="flex items-center gap-4 pt-6 border-t border-[#E6D5B8]/40">
                    <div class="w-12 h-12 bg-[#F9F6F0] rounded-xl flex items-center justify-center text-[#3A5A40] font-black font-heading text-lg border border-[#E6D5B8]/50 shadow-sm">15</div>
                    <div>
                        <p class="text-sm font-black text-gray-900 font-heading">Srikandi Anggota Aktif</p>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Pekerja Kumbung & Manajemen</p>
                    </div>
                </div>
            </div>

            <!-- Bento 2: Organik -->
            <div class="reveal delay-100 bento-card" style="background: linear-gradient(135deg, #3A5A40 0%, #253B29 100%); border: none;">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mb-6 backdrop-blur-sm border border-white/10">
                    <svg class="w-5 h-5 text-[#E6D5B8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9'/></svg>
                </div>
                <h3 class="text-lg font-black font-heading text-white mb-2">100% Organik</h3>
                <p class="text-white/70 text-[13px] leading-relaxed">Tanpa bahan kimia. Menggunakan media serbuk kayu murni.</p>
            </div>

            <!-- Bento 3: Data Driven -->
            <div class="reveal delay-200 bento-card" style="background: linear-gradient(135deg, #BC6C25 0%, #A35C1D 100%); border: none;">
                <div class="w-10 h-10 bg-black/10 rounded-xl flex items-center justify-center mb-6 backdrop-blur-sm border border-black/10">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'/></svg>
                </div>
                <h3 class="text-lg font-black font-heading text-white mb-2">Terdata Terpadu</h3>
                <p class="text-white/80 text-[13px] leading-relaxed">Seluruh proses dipantau via sistem agar kualitas selalu konsisten.</p>
            </div>

            <!-- Bento 4: Panen Harian -->
            <div class="reveal bento-card md:col-span-3 flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1">
                    <span class="chip mb-3 bg-[#F9F6F0] border-[#E6D5B8]/50">Distribusi</span>
                    <h3 class="text-xl font-black font-heading text-gray-900 mb-2">Kesegaran Panen Pagi Harian</h3>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-2xl">
                        Pemetikan jamur dilakukan di waktu subuh hingga pagi hari. Ini adalah prosedur standar kami untuk memastikan jamur sampai ke tangan Anda dengan tekstur kenyal maksimal tanpa layu.
                    </p>
                </div>
                <div class="w-full md:w-1/3 bg-[#F9F6F0] rounded-2xl p-6 text-center border border-[#E6D5B8]/50">
                    <svg class="w-8 h-8 text-[#3A5A40] mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z'/></svg>
                    <p class="font-bold text-gray-900 text-sm">Segar Langsung dari Kumbung</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- KATALOG PRODUK -->
<section id="katalog" class="py-24 bg-[#FDFCF9]">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="reveal flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <span class="section-label section-label-moss mb-4 inline-flex">
                    Katalog Produk
                </span>
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 font-heading leading-tight mb-2">Pilihan Jamur <span class="text-[#3A5A40]">Terbaik</span></h2>
            </div>
            <p class="text-gray-500 text-sm max-w-sm mb-2">Jamur tiram murni dan segar langsung dari petani lokal, dirawat dengan dedikasi untuk keluarga Anda.</p>
        </div>

        @if($catalogs->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($catalogs as $index => $catalog)
            <div class="reveal catalog-card flex flex-col" style="transition-delay: {{ $index * 100 }}ms;">
                <!-- Product Image -->
                <div class="h-48 bg-[#F9F6F0] relative overflow-hidden mx-3 mt-3 rounded-2xl">
                    @if($catalog->image)
                        <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->name }}" class="w-full h-full object-cover img-zoom">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gradient-to-br from-[#F9F6F0] to-[#E6D5B8]/20">
                            <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Foto Belum Tersedia</span>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-1.5 rounded-full shadow-sm border border-[#E6D5B8]/50">
                        <span class="text-[10px] font-black text-[#3A5A40] uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#3A5A40]"></span> Ready
                        </span>
                    </div>
                </div>

                <!-- Product Detail -->
                <div class="p-5 pt-4 flex-1 flex flex-col">
                    <h3 class="text-lg font-black font-heading text-gray-900 mb-1.5">{{ $catalog->name }}</h3>
                    <p class="text-gray-500 text-[13px] leading-relaxed mb-5 line-clamp-2 flex-1">{{ $catalog->description }}</p>

                    <div class="flex items-center justify-between pt-4 border-t border-[#E6D5B8]/40">
                        <div>
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Harga Produk</p>
                            <p class="font-black font-heading text-gray-900 text-xl leading-none">Rp{{ number_format($catalog->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="reveal bg-[#F9F6F0] rounded-[3rem] p-16 text-center border border-dashed border-[#E6D5B8]">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-5 shadow-soft">
                <svg class="w-8 h-8 text-[#BC6C25]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <h3 class="text-2xl font-black font-heading text-gray-900 mb-2">Katalog Kosong</h3>
            <p class="text-gray-500 text-sm max-w-sm mx-auto">Saat ini belum ada produk jamur segar yang dipublikasikan ke publik.</p>
        </div>
        @endif
    </div>
</section>

<!-- GALERI LOKASI & LINGKUNGAN SEKITAR -->
<section id="galeri" class="py-24 bg-[#F9F6F0]">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="reveal text-center mb-14 max-w-2xl mx-auto">
            <span class="chip mb-4 bg-white shadow-sm border-[#E6D5B8]/50">
                <svg class="w-3 h-3 text-[#3A5A40] mr-1.5 inline-block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>
                Galeri & Lokasi
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight font-heading leading-[1.1] mb-5">
                Mengintip <span class="text-[#3A5A40]">Kumbung Kami</span>
            </h2>
            <p class="text-gray-500 text-base leading-relaxed">Suasana asli tempat kami membudidayakan jamur tiram di lingkungan yang asri dan udara sejuk pegunungan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 auto-rows-[200px]">
            <!-- Gambar 1 (Besar Kiri) -->
            <div class="reveal delay-100 md:col-span-2 md:row-span-2 rounded-[2rem] overflow-hidden relative group shadow-sm border border-[#E6D5B8]/50">
                <img src="https://images.unsplash.com/photo-1628151015968-3a4429e9ef04?q=80&w=1000&auto=format&fit=crop" alt="Lingkungan Asri" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute bottom-6 left-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0">
                    <p class="text-white font-bold font-heading text-xl">Lingkungan Asri</p>
                    <p class="text-white/80 text-xs">Udara segar mendukung pertumbuhan jamur</p>
                </div>
            </div>

            <!-- Gambar 2 -->
            <div class="reveal delay-200 md:col-span-1 md:row-span-1 rounded-[1.5rem] overflow-hidden relative group shadow-sm border border-[#E6D5B8]/50">
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=800&auto=format&fit=crop" alt="Panen Jamur" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors duration-300"></div>
            </div>

            <!-- Gambar 3 -->
            <div class="reveal delay-300 md:col-span-1 md:row-span-1 rounded-[1.5rem] overflow-hidden relative group shadow-sm border border-[#E6D5B8]/50">
                <img src="https://images.unsplash.com/photo-1611077541620-7f28c2e7834f?q=80&w=800&auto=format&fit=crop" alt="Hutan Pinus" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors duration-300"></div>
            </div>

            <!-- Gambar 4 (Lebar) -->
            <div class="reveal delay-100 md:col-span-2 md:row-span-1 rounded-[1.5rem] overflow-hidden relative group shadow-sm border border-[#E6D5B8]/50">
                <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?q=80&w=1000&auto=format&fit=crop" alt="Kumbung Kayu" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute bottom-4 left-5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-bold font-heading">Inkubasi Alami</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER MODERN -->
<footer class="bg-[#152419] pt-20 pb-10 rounded-t-[3rem] relative overflow-hidden mt-12">
    <!-- Ambient glow inside footer -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-[#3A5A40]/30 to-transparent rounded-bl-full pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-[#BC6C25]/10 to-transparent rounded-tr-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8 pb-16 border-b border-[#3A5A40]/40">

            <!-- Brand Column -->
            <div class="md:col-span-5 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#3A5A40] to-[#588157] text-white rounded-2xl flex items-center justify-center text-2xl font-black font-heading shadow-lg border border-[#588157]/50">K</div>
                    <div>
                        <h4 class="font-black font-heading text-white text-2xl leading-tight tracking-tight">KUPS Harapan Asri</h4>
                        <p class="text-[#E6D5B8] text-[11px] font-black uppercase tracking-[0.2em] mt-1">Premium Organik</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                    Sistem informasi pemantauan budidaya jamur tiram modern. Kami mendigitalisasi proses pertanian untuk memastikan mutu organik terbaik dari hulu ke hilir.
                </p>
                <div class="flex items-center gap-4 pt-2">
                    <!-- Social icons (dummy) -->
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-[#3A5A40] hover:border-[#3A5A40] transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-[#3A5A40] hover:border-[#3A5A40] transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Links Column 1 -->
            <div class="md:col-span-2">
                <h5 class="text-white font-bold mb-6 font-heading text-lg">Navigasi</h5>
                <ul class="space-y-4">
                    <li><a href="#beranda" class="text-gray-400 hover:text-[#E6D5B8] text-sm transition-colors">Beranda</a></li>
                    <li><a href="#profil" class="text-gray-400 hover:text-[#E6D5B8] text-sm transition-colors">Profil KUPS</a></li>
                    <li><a href="#katalog" class="text-gray-400 hover:text-[#E6D5B8] text-sm transition-colors">Produk Kami</a></li>
                    <li><a href="#galeri" class="text-gray-400 hover:text-[#E6D5B8] text-sm transition-colors">Galeri Lokasi</a></li>
                </ul>
            </div>

            <!-- Links Column 2 -->
            <div class="md:col-span-2">
                <h5 class="text-white font-bold mb-6 font-heading text-lg">Informasi</h5>
                <ul class="space-y-4">
                    <li><a href="#" class="text-gray-400 hover:text-[#E6D5B8] text-sm transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-[#E6D5B8] text-sm transition-colors">Syarat Ketentuan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-[#E6D5B8] text-sm transition-colors">Panduan Sistem</a></li>
                </ul>
            </div>

            <!-- Action Column -->
            <div class="md:col-span-3">
                <h5 class="text-white font-bold mb-6 font-heading text-lg">Akses Anggota</h5>
                <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                    Masuk ke dalam dashboard untuk mencatat data harian, sterilisasi, inokulasi, dan panen.
                </p>
                
            </div>

        </div>

        <!-- Bottom Footer -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-500 text-xs font-medium">
                &copy; {{ date('Y') }} KUPS Harapan Asri. All rights reserved.
            </p>
            <p class="text-gray-600 text-xs font-medium flex items-center gap-1">
                Dibuat dengan <svg class="w-3.5 h-3.5 text-[#BC6C25]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg> untuk Tata Kelola Hutan Berkelanjutan
            </p>
        </div>
    </div>
</footer>

<script>
    // Glassmorphism Navbar
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if(window.scrollY > 10) navbar.classList.add('nav-scrolled');
        else navbar.classList.remove('nav-scrolled');
    }, { passive: true });

    // Mobile menu toggle
    const btn = document.getElementById('mobile-btn');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => menu.classList.add('hidden'));
    });

    // Scroll Reveal Intersection Observer (Modern alternative to getBoundingClientRect)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUPS Harapan Asri — Sistem Informasi Budidaya Jamur Tiram</title>
    <meta name="description" content="Sistem Informasi Monitoring Produksi Jamur Tiram KUPS Harapan Asri. Temukan produk jamur tiram segar berkualitas tinggi.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600;9..144,700;9..144,800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== BASE ===== */
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: #FDFCF9; color: #1F2937; -webkit-font-smoothing: antialiased; }
        .font-heading { font-family: 'Fraunces', serif; font-optical-sizing: auto; }

        /* ===== COLOR TOKENS ===== */
        .text-moss { color: #3A5A40; }
        .bg-moss { background-color: #3A5A40; }
        .hover-bg-moss:hover { background-color: #344E41; }
        .bg-moss-gradient { background: linear-gradient(135deg, #3A5A40 0%, #588157 100%); }

        .text-clay { color: #BC6C25; }
        .bg-clay { background-color: #BC6C25; }
        .bg-clay-gradient { background: linear-gradient(135deg, #BC6C25 0%, #DDA15E 100%); }

        .border-tan { border-color: #E6D5B8; }
        .bg-tan { background-color: #E6D5B8; }
        .bg-paper { background-color: #F9F6F0; }

        /* ===== GLASS NAVBAR ===== */
        .glass {
            background: rgba(253, 252, 249, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(230, 213, 184, 0.4);
        }
        .navbar-scrolled {
            box-shadow: 0 4px 24px -4px rgba(58, 90, 64, 0.08);
        }

        /* ===== SHADOWS ===== */
        .shadow-soft { box-shadow: 0 8px 32px -8px rgba(58, 90, 64, 0.10), 0 2px 8px -2px rgba(0,0,0,0.04); }
        .shadow-card {
            box-shadow: 0 2px 12px -2px rgba(58,90,64,0.07), 0 0 0 1px rgba(230,213,184,0.5);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .shadow-card:hover {
            box-shadow: 0 20px 48px -10px rgba(58, 90, 64, 0.16), 0 0 0 1px rgba(88,129,87,0.15);
            transform: translateY(-8px);
        }
        .shadow-btn {
            box-shadow: 0 4px 16px -4px rgba(58, 90, 64, 0.35);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .shadow-btn:hover {
            box-shadow: 0 8px 28px -4px rgba(58, 90, 64, 0.45);
            transform: translateY(-2px);
        }

        /* ===== NAV LINK UNDERLINE ===== */
        .nav-link {
            position: relative;
            padding-bottom: 3px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 0; height: 2px;
            background: linear-gradient(90deg, #3A5A40, #588157);
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* ===== HERO PATTERN ===== */
        .hero-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(180,160,130,0.06) 1px, transparent 0);
            background-size: 28px 28px;
        }

        /* ===== BADGE PILL ===== */
        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 9999px;
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(230,213,184,0.5);
            box-shadow: 0 2px 8px -2px rgba(0,0,0,0.06);
            backdrop-filter: blur(8px);
        }

        /* ===== STAT DIVIDER ===== */
        .stat-divider { width: 1px; height: 40px; background: linear-gradient(to bottom, transparent, #E6D5B8, transparent); }

        /* ===== SECTION LABEL ===== */
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 14px 5px 8px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }
        .section-label-moss { background: rgba(58,90,64,0.08); color: #3A5A40; }
        .section-label-clay { background: rgba(188,108,37,0.09); color: #BC6C25; }

        /* ===== FEATURE ICON ===== */
        .feature-icon-wrap {
            width: 64px; height: 64px;
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
            margin-bottom: 28px;
            transition: transform 0.3s ease;
        }
        .group:hover .feature-icon-wrap { transform: scale(1.1) rotate(-3deg); }

        /* ===== CARD PRODUCT BADGE ===== */
        .product-badge {
            position: absolute; top: 12px; right: 12px; z-index: 10;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(8px);
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #3A5A40;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* ===== FLOATING BADGE ===== */
        .float-badge {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(230,213,184,0.4);
            box-shadow: 0 12px 40px -8px rgba(58,90,64,0.14);
        }

        /* ===== ABOUT STATS ===== */
        .about-stat {
            display: flex; flex-direction: column;
            padding: 20px 28px;
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(230,213,184,0.5);
            box-shadow: 0 2px 12px -4px rgba(58,90,64,0.07);
        }

        /* ===== SCROLL REVEAL ===== */
        .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        /* ===== DIVIDER WAVE ===== */
        .divider-line {
            height: 1px;
            background: linear-gradient(to right, transparent, #E6D5B8, transparent);
        }
    </style>
</head>
<body class="antialiased selection:bg-[#3A5A40] selection:text-white">

    <!-- === NAVIGASI === -->
    <nav id="navbar" class="fixed w-full top-0 z-50 transition-all duration-400 glass py-3.5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">

                <!-- Logo -->
                <a href="#beranda" class="flex items-center space-x-3 group">
                    <div class="w-11 h-11 bg-moss-gradient rounded-xl flex items-center justify-center text-white font-black text-2xl font-heading shadow-md transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg group-hover:rotate-3">
                        K
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="font-black text-gray-900 text-[17px] font-heading tracking-tight">KUPS Harapan Asri</span>
                        <span class="text-clay text-[10px] font-black uppercase tracking-[0.22em] mt-1">Premium Organik</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-7">
                    <a href="#beranda" class="nav-link text-gray-600 hover:text-moss text-[13px] font-semibold transition-colors duration-200">Beranda</a>
                    <a href="#keunggulan" class="nav-link text-gray-600 hover:text-moss text-[13px] font-semibold transition-colors duration-200">Keunggulan</a>
                    <a href="#katalog" class="nav-link text-gray-600 hover:text-moss text-[13px] font-semibold transition-colors duration-200">Katalog</a>
                    <a href="#tentang" class="nav-link text-gray-600 hover:text-moss text-[13px] font-semibold transition-colors duration-200">Tentang Kami</a>
                    <a href="{{ route('login') }}" class="ml-2 px-6 py-2.5 bg-moss-gradient text-white text-[11px] font-black uppercase tracking-widest rounded-full shadow-btn">
                        Akses Sistem
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-700 p-2 focus:outline-none bg-paper rounded-xl border border-tan/40 hover:border-moss/40 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden absolute w-full bg-white/96 backdrop-blur-lg border-b border-tan/30 shadow-xl px-6 pt-4 pb-6 space-y-1">
            <a href="#beranda" class="flex items-center gap-3 text-gray-800 font-semibold py-3 px-3 rounded-xl hover:bg-paper hover:text-moss transition-colors">
                <span class="w-1.5 h-1.5 rounded-full bg-moss"></span> Beranda
            </a>
            <a href="#keunggulan" class="flex items-center gap-3 text-gray-800 font-semibold py-3 px-3 rounded-xl hover:bg-paper hover:text-moss transition-colors">
                <span class="w-1.5 h-1.5 rounded-full bg-clay"></span> Keunggulan
            </a>
            <a href="#katalog" class="flex items-center gap-3 text-gray-800 font-semibold py-3 px-3 rounded-xl hover:bg-paper hover:text-moss transition-colors">
                <span class="w-1.5 h-1.5 rounded-full bg-moss"></span> Katalog Produk
            </a>
            <a href="#tentang" class="flex items-center gap-3 text-gray-800 font-semibold py-3 px-3 rounded-xl hover:bg-paper hover:text-moss transition-colors">
                <span class="w-1.5 h-1.5 rounded-full bg-clay"></span> Tentang Kami
            </a>
            <div class="pt-4 mt-2 border-t border-tan/30">
                <a href="{{ route('login') }}" class="w-full flex justify-center items-center gap-2 bg-moss-gradient text-white font-black text-sm uppercase tracking-widest py-3.5 rounded-2xl shadow-btn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Akses Sistem
                </a>
            </div>
        </div>
    </nav>

    <!-- === HERO SECTION === -->
    <section id="beranda" class="relative pt-36 pb-20 lg:pt-52 lg:pb-36 overflow-hidden bg-[#FDFCF9] hero-pattern">
        <!-- Soft gradient blobs -->
        <div class="absolute top-0 right-0 w-[60%] h-[80%] bg-gradient-to-bl from-[#F9F6F0]/90 via-[#F6F1E6]/40 to-transparent pointer-events-none -z-10 rounded-bl-[160px]"></div>
        <div class="absolute bottom-0 left-0 w-[30%] h-[40%] bg-gradient-to-tr from-amber-50/50 to-transparent pointer-events-none -z-10 rounded-tr-[100px]"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <!-- Hero Text -->
                <div class="space-y-8 text-center lg:text-left">

                    <!-- Live status pill -->
                    <div class="badge-pill mx-auto lg:mx-0 w-fit">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-60" style="background:#3A5A40;"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5" style="background:#3A5A40;"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-[0.18em] text-moss">Hasil Panen Terbaik Hari Ini</span>
                    </div>

                    <!-- Headline -->
                    <h1 class="text-[2.6rem] sm:text-5xl lg:text-[3.8rem] font-black leading-[1.08] tracking-tight font-heading text-gray-900">
                        Kesegaran Jamur Tiram
                        <span class="block mt-1 italic text-gray-900">Premium</span>
                        dari Petani Lokal.
                    </h1>

                    <p class="text-gray-500 text-base md:text-[17px] max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        Kami membudidayakan jamur tiram organik dengan pengawasan sistem terpadu. Lebih bersih, lebih sehat, dan langsung dari kumbung kami ke dapur Anda.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3">
                        <a href="#katalog" class="w-full sm:w-auto px-8 py-3.5 bg-moss-gradient text-white text-sm font-bold rounded-full shadow-btn flex items-center justify-center">
                            Lihat Produk
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 bg-white border border-tan hover:border-moss text-gray-800 text-sm font-bold rounded-full transition-all duration-200 hover:shadow-md flex items-center justify-center">
                            Masuk Sistem
                        </a>
                    </div>

                    <!-- Trust Stats -->
                    <div class="pt-8 border-t border-tan/40 flex items-center justify-center lg:justify-start gap-0">
                        <div class="pr-8 text-center lg:text-left">
                            <p class="text-[2.2rem] font-black font-heading text-gray-900 leading-none">100<span class="text-clay">%</span></p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-[0.16em] font-bold mt-2">Organik Murni</p>
                        </div>
                        <div class="stat-divider mx-0"></div>
                        <div class="px-8 text-center lg:text-left">
                            <p class="text-[2.2rem] font-black font-heading text-gray-900 leading-none">A<span class="text-clay">+</span></p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-[0.16em] font-bold mt-2">Kualitas Grade</p>
                        </div>
                        <div class="stat-divider mx-0"></div>
                        <div class="pl-8 text-center lg:text-left">
                            <p class="text-[2.2rem] font-black font-heading text-gray-900 leading-none">15<span class="text-clay font-heading text-2xl ml-0.5">org</span></p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-[0.16em] font-bold mt-2">Anggota Aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative mx-auto w-full max-w-lg lg:max-w-full mt-10 lg:mt-0 pl-0 lg:pl-8">
                    <!-- Decorative tilted frame -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#DDA15E]/35 to-[#BC6C25]/15 rounded-[3rem] transform rotate-3 scale-105"></div>
                    <!-- Main image -->
                    <img src="{{ asset('images/jamur.jpeg') }}" alt="Jamur Tiram Segar KUPS Harapan Asri"
                        class="relative z-10 rounded-[3rem] shadow-2xl w-full object-cover aspect-square lg:aspect-[4/3] border-[5px] border-white">

                    <!-- Floating Status Badge -->
                    <div class="float-badge absolute -bottom-5 -left-5 z-20 px-5 py-3.5 rounded-3xl flex items-center gap-4 animate-bounce" style="animation-duration: 3.5s; animation-timing-function: ease-in-out;">
                        <div class="w-11 h-11 bg-green-50 rounded-full flex items-center justify-center text-xl shrink-0"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9'/></svg></div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.15em]">Status Panen</p>
                            <p class="text-[15px] font-black font-heading text-moss leading-tight">Siap Diolah</p>
                        </div>
                    </div>

                    <!-- Floating Quality Badge -->
                    <div class="float-badge absolute -top-4 -right-4 z-20 px-4 py-3 rounded-2xl flex items-center gap-3">
                        <div class="w-9 h-9 bg-amber-50 rounded-full flex items-center justify-center text-lg shrink-0"><svg class='w-5 h-5' fill='currentColor' viewBox='0 0 20 20'><path d='M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z'/></svg></div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-wider">Sertifikasi</p>
                            <p class="text-[13px] font-black font-heading text-clay leading-tight">Organik</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="divider-line"></div>

    <!-- === KEUNGGULAN SECTION === -->
    <section id="keunggulan" class="py-28 bg-paper relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Section Header -->
            <div class="reveal text-center mb-16 max-w-2xl mx-auto">
                <span class="section-label section-label-clay mb-5">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Kenapa Memilih Kami?
                </span>
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight font-heading leading-[1.1] mt-4">
                    Kualitas dari<br><span class="text-moss">Hulu ke Hilir</span>
                </h2>
                <div class="mt-5 w-12 h-1 bg-moss-gradient rounded-full mx-auto"></div>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10">
                <!-- Card 1 -->
                <div class="reveal reveal-delay-1 bg-white p-10 rounded-[2.5rem] shadow-card border border-transparent">
                    <div class="feature-icon-wrap" style="background:rgba(58,90,64,0.08);"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9'/></svg></div>
                    <h3 class="text-xl font-black text-gray-900 font-heading mb-3">Organik & Sehat</h3>
                    <p class="text-gray-500 text-[14.5px] leading-relaxed">
                        Dibudidayakan tanpa bahan kimia berbahaya. Menggunakan media tanam alami serbuk gergaji kayu murni untuk nutrisi optimal.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="reveal reveal-delay-2 bg-white p-10 rounded-[2.5rem] shadow-card border border-transparent">
                    <div class="feature-icon-wrap" style="background:rgba(188,108,37,0.09);"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'/></svg></div>
                    <h3 class="text-xl font-black text-gray-900 font-heading mb-3">Terdata Sistematis</h3>
                    <p class="text-gray-500 text-[14.5px] leading-relaxed">
                        Seluruh jadwal pembuatan baglog, inkubasi, hingga panen tercatat rapi di dalam sistem kami untuk menjaga konsistensi.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="reveal reveal-delay-3 bg-white p-10 rounded-[2.5rem] shadow-card border border-transparent">
                    <div class="feature-icon-wrap" style="background:rgba(120,53,15,0.08);"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z'/></svg></div>
                    <h3 class="text-xl font-black text-gray-900 font-heading mb-3">Segar Setiap Hari</h3>
                    <p class="text-gray-500 text-[14.5px] leading-relaxed">
                        Proses panen dilakukan di pagi hari untuk memastikan tekstur jamur tiram tetap kenyal dan tidak layu saat didistribusikan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="divider-line"></div>

    <!-- === KATALOG PRODUK === -->
    <section id="katalog" class="py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Section Header -->
            <div class="reveal flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-14">
                <div>
                    <span class="section-label section-label-moss mb-5 inline-flex">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/></svg>
                        Katalog Produk
                    </span>
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight font-heading leading-[1.1] mt-4">
                        Tawaran Terbaik<br><span class="text-moss">Untuk Anda</span>
                    </h2>
                    <div class="mt-4 w-10 h-1 bg-moss-gradient rounded-full"></div>
                </div>
                <p class="text-gray-500 text-[15px] max-w-sm leading-relaxed lg:pb-2">
                    Pilihan jamur tiram dan olahan terbaik langsung dari kelompok usaha perhutanan sosial Harapan Asri.
                </p>
            </div>

            @if($catalogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($catalogs as $catalog)
                        <div class="reveal group bg-white rounded-[2.5rem] overflow-hidden shadow-card border border-transparent flex flex-col">
                            <!-- Image -->
                            <div class="h-64 bg-paper relative mx-4 mt-4 rounded-[2rem] overflow-hidden">
                                @if($catalog->image)
                                    <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->name }}"
                                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                @else
                                    <div class="absolute inset-0 flex flex-col items-center justify-center space-y-3 bg-gradient-to-br from-paper to-tan/20">
                                        <span class="text-5xl opacity-40"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg></span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Foto Belum Tersedia</span>
                                    </div>
                                @endif
                                {{-- <div class="product-badge">● Tersedia</div> --}}
                            </div>

                            <!-- Content -->
                            <div class="p-7 pt-5 flex-1 flex flex-col">
                                <h3 class="text-xl font-black text-gray-900 font-heading mb-2">{{ $catalog->name }}</h3>
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 flex-1">{{ $catalog->description }}</p>

                                <div class="mt-6 pt-5 border-t border-tan/40 flex items-center justify-between">
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Harga Satuan</p>
                                        <p class="font-black text-2xl text-gray-900 tracking-tight font-heading leading-none">
                                            Rp{{ number_format($catalog->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="reveal text-center py-20 bg-paper rounded-[3rem] border border-dashed border-tan max-w-2xl mx-auto">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-5 text-4xl shadow-soft"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg></div>
                    <h3 class="text-gray-900 font-black text-xl font-heading mb-2">Belum Ada Katalog</h3>
                    <p class="text-gray-500 text-sm max-w-xs mx-auto leading-relaxed">Saat ini kami sedang menyiapkan produk jamur segar terbaik untuk ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Section Divider -->
    <div class="divider-line"></div>

    <!-- === TENTANG KAMI === -->
    <section id="tentang" class="py-28 bg-paper relative overflow-hidden">
        <!-- Ambient glow -->
        <div class="absolute -bottom-1/2 -left-1/4 w-full h-full bg-gradient-to-tr from-[#BC6C25]/08 to-transparent rounded-full blur-3xl pointer-events-none" style="opacity:0.5;"></div>
        <div class="absolute top-0 right-0 w-1/3 h-1/2 bg-gradient-to-bl from-green-50/70 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 reveal relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">

                <!-- Left: Text Content -->
                <div class="space-y-8">
                    <div>
                        <span class="section-label section-label-clay mb-5 inline-flex">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                            Profil KUPS
                        </span>
                        <h2 class="text-3xl md:text-5xl font-black text-gray-900 leading-[1.1] font-heading mt-4">
                            Merawat Alam,<br><span class="text-moss">Memberdayakan Petani.</span>
                        </h2>
                        <div class="mt-5 w-12 h-1 bg-clay-gradient rounded-full"></div>
                    </div>

                    <div class="space-y-4 text-gray-500 text-[15px] leading-relaxed">
                        <p>
                            Kelompok Usaha Perhutanan Sosial (KUPS) Harapan Asri adalah kelompok perempuan berbasis komunitas di Nagari Sijunjung, Kabupaten Sijunjung, yang bergerak dalam usaha budidaya jamur tiram. Kelompok ini berfokus pada pemberdayaan perempuan, peningkatan ekonomi rumah tangga, dan mendukung pengelolaan hutan berkelanjutan melalui skema perhutanan sosial. Dengan semangat kewirausahaan komunitas, KUPS Harapan Asri berupaya menciptakan kemandirian ekonomi sekaligus menjaga kelestarian lingkungan.
                        </p>
                        <p>
                            Kelompok ini terbentuk pada 03 Desember 2021, saat ini beranggotakan 15 Orang, diketuai oleh Lita Purnama Sari. KUPS Harapan Asri merupakan unit usaha perhutanan sosial di wilayah kerja yang dikelola LPHN Nagari Sijunjung.
                        </p>
                    </div>

                    <!-- Mini Stat Cards -->
                    <div class="grid grid-cols-3 gap-3 pt-2">
                        <div class="about-stat">
                            <p class="font-black text-2xl font-heading text-gray-900 leading-none">2021</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-bold mt-1.5">Berdiri</p>
                        </div>
                        <div class="about-stat">
                            <p class="font-black text-2xl font-heading text-gray-900 leading-none">15</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-bold mt-1.5">Anggota</p>
                        </div>
                        <div class="about-stat">
                            <p class="font-black text-2xl font-heading text-moss leading-none">LPHN</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-bold mt-1.5">Naungan</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Illustration Card -->
                <div class="relative">
                    <!-- Tilted frame behind -->
                    <div class="absolute inset-0 bg-gradient-to-br from-moss/15 to-clay/10 rounded-[3rem] transform -rotate-3 scale-105"></div>
                    <div class="w-full aspect-square md:aspect-[4/3] rounded-[3rem] overflow-hidden bg-white shadow-soft relative z-10 border border-white">
                        <div class="absolute inset-0 bg-white flex flex-col items-center justify-center text-center p-10">
                            <!-- Icon circle -->
                            <div class="w-24 h-24 bg-gradient-to-br from-moss/10 to-moss/20 rounded-full flex items-center justify-center text-5xl mb-6 shadow-sm"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'/></svg></div>
                            <h3 class="font-heading font-black text-2xl text-gray-900 mb-3">Kumbung Harapan Asri</h3>
                            <p class="text-[14px] text-gray-500 max-w-xs leading-relaxed">Pusat inkubasi baglog berkapasitas besar dengan pengaturan suhu optimal untuk menghasilkan jamur kualitas premium.</p>
                            <!-- Info chips -->
                            <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
                                <span class="px-3 py-1 bg-moss/8 text-moss text-[11px] font-bold rounded-full" style="background:rgba(58,90,64,0.08)"><svg class='w-4 h-4 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'/></svg> Suhu Terkontrol</span>
                                <span class="px-3 py-1 bg-amber-50 text-amber-800 text-[11px] font-bold rounded-full"><svg class='w-4 h-4 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z'/></svg> Kelembapan Optimal</span>
                                <span class="px-3 py-1 bg-moss/8 text-moss text-[11px] font-bold rounded-full" style="background:rgba(58,90,64,0.08)"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9'/></svg> Media Organik</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- === FOOTER === -->
    <footer class="bg-white pt-16 pb-8 border-t border-tan/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Top footer -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 pb-10 border-b border-tan/30">
                <!-- Brand -->
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-moss-gradient text-white rounded-2xl flex items-center justify-center text-2xl font-black font-heading shadow-md">K</div>
                    <div>
                        <h4 class="font-black text-gray-900 text-lg font-heading leading-tight">KUPS Harapan Asri</h4>
                        <p class="text-gray-500 text-xs font-medium mt-0.5">Sistem Informasi Monitoring Budidaya Jamur Tiram Terpadu.</p>
                    </div>
                </div>
                <!-- Navigation links -->
                {{-- <div class="flex items-center gap-6">
                    <a href="#beranda" class="text-gray-500 hover:text-moss text-sm font-medium transition-colors">Beranda</a>
                    <a href="#keunggulan" class="text-gray-500 hover:text-moss text-sm font-medium transition-colors">Keunggulan</a>
                    <a href="#katalog" class="text-gray-500 hover:text-moss text-sm font-medium transition-colors">Katalog</a>
                    <a href="#tentang" class="text-gray-500 hover:text-moss text-sm font-medium transition-colors">Tentang</a>
                </div>
                <!-- Login -->
                <a href="{{ route('login') }}" class="px-6 py-2.5 bg-moss-gradient text-white text-[12px] font-black uppercase tracking-widest rounded-full shadow-btn shrink-0">
                    Akses Sistem
                </a>
            </div> --}}

            {{-- <!-- Bottom footer -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-3 text-[12.5px] text-gray-400 font-medium">
                <p>&copy; {{ date('Y') }} KUPS Harapan Asri. Hak cipta dilindungi.</p>
                <p>Dikembangkan untuk Tata Kelola Pertanian Modern</p>
            </div> --}}
        </div>
    </footer>

    <script>
        // ── Navbar scroll effect ──────────────────────────────────────────
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // ── Mobile Menu ───────────────────────────────────────────────────
        const btn  = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });

        // ── Scroll Reveal Animation ───────────────────────────────────────
        function revealElements() {
            const reveals = document.querySelectorAll('.reveal');
            const windowHeight = window.innerHeight;
            reveals.forEach(el => {
                const top = el.getBoundingClientRect().top;
                if (top < windowHeight - 90) {
                    el.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', revealElements, { passive: true });
        setTimeout(revealElements, 120);

        // ── Active nav link highlight on scroll ──────────────────────────
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('nav a.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 120;
                if (window.scrollY >= sectionTop) current = section.getAttribute('id');
            });
            navLinks.forEach(link => {
                link.classList.remove('text-moss');
                link.classList.add('text-gray-600');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('text-moss');
                    link.classList.remove('text-gray-600');
                }
            });
        }, { passive: true });
    </script>
</body>
</html>


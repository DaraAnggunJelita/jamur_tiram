<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUPS Harapan Asri — Sistem Informasi Budidaya Jamur Tiram</title>
    <meta name="description" content="Sistem Informasi Monitoring Produksi Jamur Tiram KUPS Harapan Asri. Temukan produk jamur tiram segar berkualitas tinggi.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600;9..144,700;9..144,800;9..144,900&family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root{
            /* -- Palet Jamur Tiram: kertas kraft, kayu baglog, lumut, tan cendawan -- */
            --paper:       #F6F1E6;
            --paper-2:     #FBF8F1;
            --ink:         #26201B;
            --ink-2:       #362C24;
            --bark:        #6B4E36;
            --bark-light:  #8E6E4E;
            --moss:        #4F6146;
            --moss-light:  #7C9169;
            --moss-dark:   #37452F;
            --tan:         #C9B896;
            --tan-light:   #E6DAC2;
            --clay:        #A0653D;
        }

        body { font-family: 'Inter', sans-serif; background: var(--paper); }
        h1, h2, h3, h4, .font-heading { font-family: 'Fraunces', serif; font-optical-sizing: auto; }
        .font-mono-data { font-family: 'JetBrains Mono', monospace; }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--paper); }
        ::-webkit-scrollbar-thumb { background: var(--tan); border-radius: 20px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--moss); }

        /* Signature motif: pola insang jamur (gill pattern) — garis radial seperti bilah di bawah tudung jamur */
        .gill-pattern {
            background-image: repeating-conic-gradient(from 0deg, rgba(255,255,255,0.05) 0deg 1.1deg, transparent 1.1deg 7.5deg);
            border-radius: 50%;
        }
        .gill-pattern-dark {
            background-image: repeating-conic-gradient(from 0deg, rgba(38,32,27,0.06) 0deg 1.1deg, transparent 1.1deg 7.5deg);
            border-radius: 50%;
        }

        @keyframes float-1 { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-9px) rotate(1deg); } }
        @keyframes float-2 { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-6px) rotate(-1deg); } }
        @keyframes float-3 { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-8px) rotate(0.6deg); } }
        .animate-float-1 { animation: float-1 5.5s ease-in-out infinite; }
        .animate-float-2 { animation: float-2 4.5s ease-in-out infinite; }
        .animate-float-3 { animation: float-3 6.5s ease-in-out infinite; animation-delay: .8s; }

        /* Nafas pertumbuhan halus pada bingkai foto — mengisyaratkan organisme yang hidup */
        @keyframes cap-breathe {
            0%,100% { border-radius: 2.5rem 2.5rem 2.5rem 2.5rem / 2.5rem 2.5rem 2.5rem 2.5rem; }
            50% { border-radius: 3.5rem 2rem 3.5rem 2rem / 2rem 3.5rem 2rem 3.5rem; }
        }
        .animate-cap-breathe { animation: cap-breathe 10s ease-in-out infinite; }

        .step-line { background: repeating-linear-gradient(to bottom, var(--tan) 0 6px, transparent 6px 12px); }
    </style>
</head>
<body class="text-[var(--ink)] antialiased selection:bg-[var(--moss)] selection:text-white overflow-x-hidden">

    <!-- === NAVIGASI === -->
    <nav class="bg-[var(--paper)]/90 backdrop-blur-lg border-b border-[var(--tan)]/40 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <a href="#beranda" class="flex items-center space-x-3.5 group cursor-pointer">
                    <div class="w-11 h-11 bg-gradient-to-tr from-[var(--moss-dark)] via-[var(--moss)] to-[var(--moss-light)] rounded-xl flex items-center justify-center shadow-lg shadow-[var(--moss)]/20 transform group-hover:rotate-6 transition duration-300">
                        <span class="text-white font-black text-lg tracking-tighter font-heading">K</span>
                    </div>
                    <div>
                        <p class="font-black text-[var(--ink)] text-base leading-tight tracking-tight font-heading">KUPS Harapan Asri</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 bg-[var(--moss)] rounded-full animate-ping"></span>
                            <span class="text-[var(--bark)] text-[10px] font-black leading-none uppercase tracking-widest block">Jamur Tiram Organik</span>
                        </div>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-[var(--ink-2)] hover:text-[var(--moss)] text-sm font-bold transition relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-[var(--moss)] after:transition-all pb-1">Beranda</a>
                    <a href="#katalog" class="text-[var(--ink-2)] hover:text-[var(--moss)] text-sm font-bold transition relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-[var(--moss)] after:transition-all pb-1">Katalog Produk</a>
                    <a href="#tentang" class="text-[var(--ink-2)] hover:text-[var(--moss)] text-sm font-bold transition relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-[var(--moss)] after:transition-all pb-1">Tentang Kami</a>
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-[var(--moss-dark)] to-[var(--moss)] text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-[var(--moss)]/20 hover:shadow-lg hover:shadow-[var(--moss)]/30 hover:scale-[1.02] active:scale-[0.98] transition duration-200">
                        Akses Sistem
                    </a>
                </div>

                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-[var(--ink)] hover:text-[var(--moss)] p-2 focus:outline-hidden rounded-xl hover:bg-[var(--tan-light)] transition duration-150">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-[var(--paper-2)]/98 border-b border-[var(--tan)]/40 backdrop-blur-xl px-6 py-5 space-y-3.5 shadow-xl transition duration-300">
            <a href="#beranda" class="block text-[var(--ink-2)] hover:text-[var(--moss)] font-bold text-sm py-2">Beranda</a>
            <a href="#katalog" class="block text-[var(--ink-2)] hover:text-[var(--moss)] font-bold text-sm py-2">Katalog Produk</a>
            <a href="#tentang" class="block text-[var(--ink-2)] hover:text-[var(--moss)] font-bold text-sm py-2">Tentang Kami</a>
            <a href="{{ route('login') }}" class="w-full flex justify-center bg-[var(--moss)] hover:bg-[var(--moss-dark)] text-white font-bold text-xs py-3 rounded-xl transition duration-150 shadow-sm shadow-[var(--moss)]/20">
                Akses Sistem
            </a>
        </div>
    </nav>

    <!-- === HERO === -->
    <section id="beranda" class="relative bg-gradient-to-br from-[var(--ink)] via-[var(--ink-2)] to-[var(--ink)] text-white min-h-[calc(100vh-5rem)] py-20 lg:py-28 px-6 overflow-hidden">

        <div class="absolute top-[18%] left-[8%] w-[360px] h-[360px] bg-[var(--moss)]/15 rounded-full blur-[110px] pointer-events-none"></div>
        <div class="absolute bottom-[15%] right-[4%] w-[420px] h-[420px] bg-[var(--bark)]/15 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:4rem_4rem] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10">

            <div class="space-y-6 lg:col-span-7 text-center lg:text-left">
                <span class="inline-flex items-center gap-2 bg-[var(--moss)]/15 border border-[var(--moss-light)]/30 text-[var(--moss-light)] text-[11px] font-black px-4 py-2 rounded-full uppercase tracking-wider backdrop-blur-md">
                    <span class="w-2 h-2 bg-[var(--moss-light)] rounded-full animate-ping"></span>
                    Sistem Monitoring KUPS Harapan Asri
                </span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-black leading-[1.08] tracking-tight font-heading">
                    Dari Kumbung ke Meja: <br class="hidden md:inline">Budidaya <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--moss-light)] via-[var(--tan)] to-[var(--moss-light)]">Jamur Tiram</span> Terpantau
                </h1>
                <p class="text-[var(--tan-light)] text-sm md:text-base max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Transformasi digital pembudidayaan jamur tiram organik di kumbung binaan kelompok usaha tani sirkular. Terintegrasi secara transparan, dipantau berkala, dipanen segar setiap hari.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4.5 pt-4">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto bg-[var(--paper)] hover:bg-white text-[var(--ink)] font-black px-8 py-4 rounded-2xl shadow-xl shadow-black/20 hover:scale-[1.02] active:scale-[0.98] transition duration-200 text-sm text-center">
                        Masuk ke Sistem
                    </a>
                    <a href="#katalog" class="w-full sm:w-auto border border-white/15 text-white font-bold px-8 py-4 rounded-2xl bg-white/5 hover:bg-white/10 hover:border-white/25 transition duration-200 text-sm text-center">
                        Lihat Katalog Produk
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-8 max-w-3xl mx-auto lg:mx-0 text-left">
                    <div class="rounded-2xl bg-white/5 border border-white/5 p-4.5 hover:border-[var(--moss-light)]/30 transition duration-200">
                        <p class="text-[9px] uppercase tracking-widest text-[var(--moss-light)] font-black">Produksi</p>
                        <p class="mt-2 text-xs text-[var(--tan-light)] leading-relaxed">Monitoring harian real-time untuk menjamin volume pasokan.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/5 p-4.5 hover:border-[var(--moss-light)]/30 transition duration-200">
                        <p class="text-[9px] uppercase tracking-widest text-[var(--moss-light)] font-black">Mutu Organik</p>
                        <p class="mt-2 text-xs text-[var(--tan-light)] leading-relaxed">Tanpa pestisida dan zat kimia murni untuk menjaga kemurnian.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/5 p-4.5 hover:border-[var(--moss-light)]/30 transition duration-200">
                        <p class="text-[9px] uppercase tracking-widest text-[var(--moss-light)] font-black">Distribusi</p>
                        <p class="mt-2 text-xs text-[var(--tan-light)] leading-relaxed">Manajemen rantai pasok terpusat untuk menjaga kesegaran.</p>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan: foto dengan bingkai organik & pola insang jamur -->
            <div class="lg:col-span-5 relative flex items-center justify-center">

                <!-- Pola insang jamur di belakang foto (signature motif) -->
                <div class="gill-pattern absolute w-[480px] h-[480px] opacity-70 pointer-events-none"></div>

                <div class="animate-cap-breathe relative w-full max-w-[420px] aspect-[4/5] overflow-hidden border border-white/10 shadow-2xl shadow-black/50 z-10 group bg-[var(--ink-2)]">
                    <img src="{{ asset('images/oyster_mushroom_hero.png') }}"
                         alt="Budidaya Jamur Tiram Harapan Asri"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[var(--ink)]/80 via-transparent to-transparent"></div>
                </div>

                <!-- Sensor: Suhu -->
                <div class="absolute -top-6 -left-6 z-20 bg-[var(--ink)]/85 backdrop-blur-md border border-white/10 p-3.5 rounded-2xl flex items-center gap-3.5 shadow-xl animate-float-1 w-[180px]">
                    <div class="w-9 h-9 bg-[var(--clay)]/20 text-[var(--clay)] rounded-xl flex items-center justify-center text-lg shrink-0">
                        🌡️
                    </div>
                    <div class="min-w-0">
                        <span class="text-[9px] text-[var(--tan)] uppercase tracking-wider block font-bold">Suhu Kumbung</span>
                        <span class="font-mono-data text-xs font-bold text-white block mt-0.5">24.8°C <span class="text-[9px] text-[var(--moss-light)] font-black ml-1 uppercase">✓</span></span>
                    </div>
                </div>

                <!-- Sensor: Kelembaban -->
                <div class="absolute top-[40%] -right-8 z-20 bg-[var(--ink)]/85 backdrop-blur-md border border-white/10 p-3.5 rounded-2xl flex items-center gap-3.5 shadow-xl animate-float-2 w-[180px]">
                    <div class="w-9 h-9 bg-[var(--bark-light)]/20 text-[var(--tan)] rounded-xl flex items-center justify-center text-lg shrink-0">
                        💧
                    </div>
                    <div class="min-w-0">
                        <span class="text-[9px] text-[var(--tan)] uppercase tracking-wider block font-bold">Kelembaban</span>
                        <span class="font-mono-data text-xs font-bold text-white block mt-0.5">85% RH <span class="text-[9px] text-[var(--moss-light)] font-black ml-1 uppercase">✓</span></span>
                    </div>
                </div>

                <!-- Sensor: Status -->
                <div class="absolute -bottom-6 -left-4 z-20 bg-[var(--ink)]/85 backdrop-blur-md border border-white/10 p-3.5 rounded-2xl flex items-center gap-3.5 shadow-xl animate-float-3 w-[190px]">
                    <div class="w-9 h-9 bg-[var(--moss)]/20 text-[var(--moss-light)] rounded-xl flex items-center justify-center text-lg shrink-0">
                        ⚙️
                    </div>
                    <div class="min-w-0">
                        <span class="text-[9px] text-[var(--tan)] uppercase tracking-wider block font-bold">Kondisi Sistem</span>
                        <span class="text-xs font-black text-[var(--moss-light)] block mt-0.5 uppercase tracking-wide">Optimal &amp; Stabil</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- === KATALOG PRODUK === -->
    <section id="katalog" class="py-24 bg-[var(--paper)] px-6">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-16 space-y-3">
                <span class="text-[var(--moss-dark)] text-xs font-black uppercase tracking-widest bg-[var(--moss-light)]/15 px-4 py-2 rounded-full border border-[var(--moss-light)]/30">Katalog Digital</span>
                <h2 class="text-3xl md:text-4xl font-black text-[var(--ink)] tracking-tight font-heading">Komoditas Jamur Tiram Unggulan</h2>
                <p class="text-[var(--bark)] text-xs md:text-sm max-w-xl mx-auto leading-relaxed font-normal">Daftar produk jamur tiram putih berkualitas tinggi yang dikelola langsung oleh kelompok tani sirkular Harapan Asri.</p>
            </div>

            @if($catalogs->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($catalogs as $catalog)
                        <div class="bg-[var(--paper-2)] rounded-[2rem] shadow-lg shadow-[var(--ink)]/5 border border-[var(--tan)]/50 overflow-hidden transition-all duration-300 group hover:-translate-y-1.5 hover:shadow-xl hover:shadow-[var(--moss)]/10 hover:border-[var(--moss-light)]/40 flex flex-col justify-between">
                            <div>
                                <div class="h-60 bg-[var(--tan-light)] flex items-center justify-center overflow-hidden relative">
                                    @if($catalog->image)
                                        <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="text-[var(--bark)] flex flex-col items-center space-y-2">
                                            <span class="text-6xl transform group-hover:scale-110 transition duration-300">🍄</span>
                                            <span class="text-[9px] font-black text-[var(--bark-light)] uppercase tracking-widest">Harapan Asri</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-7 space-y-2.5">
                                    <h3 class="text-lg font-extrabold text-[var(--ink)] group-hover:text-[var(--moss-dark)] transition duration-150 font-heading">{{ $catalog->name }}</h3>
                                    <p class="text-[var(--bark)] text-xs leading-relaxed line-clamp-3 font-normal">{{ $catalog->description }}</p>
                                </div>
                            </div>

                            <div class="p-7 pt-0">
                                <div class="flex items-center justify-between pt-5 border-t border-dashed border-[var(--tan)]">
                                    <div>
                                        <p class="text-[9px] text-[var(--bark-light)] font-extrabold uppercase tracking-widest">Harga</p>
                                        <p class="font-mono-data text-[var(--ink)] font-black text-xl mt-0.5">Rp {{ number_format($catalog->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-[var(--paper-2)] rounded-3xl border border-dashed border-[var(--tan)] max-w-lg mx-auto shadow-sm">
                    <span class="text-6xl block mb-4">📦</span>
                    <h3 class="text-[var(--ink)] font-extrabold text-lg font-heading">Katalog Sedang Diperbarui</h3>
                    <p class="text-[var(--bark)] text-xs mt-2 max-w-xs mx-auto font-normal">Sistem sedang memproses sinkronisasi data produk dari inventaris kelompok tani.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- === TENTANG KAMI === -->
    <section id="tentang" class="py-24 bg-[var(--paper-2)] px-6 relative overflow-hidden">
        <div class="gill-pattern-dark absolute -top-20 -right-20 w-[400px] h-[400px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

                <div class="space-y-6 lg:col-span-6">
                    <span class="text-[var(--moss-dark)] text-xs font-black uppercase tracking-widest bg-[var(--moss-light)]/15 px-4 py-2 rounded-full border border-[var(--moss-light)]/30">Profil Kelembagaan</span>
                    <h2 class="text-3xl md:text-4xl font-black text-[var(--ink)] leading-tight tracking-tight font-heading">Mengenal Kelompok Usaha Harapan Asri</h2>
                    <p class="text-[var(--bark)] leading-relaxed text-sm md:text-base font-normal">
                        KUPS Harapan Asri didirikan atas dasar kolaborasi aktif komunitas petani dalam menata tata kelola budidaya jamur tiram yang ramah lingkungan. Kami memadukan kearifan agrikultur lokal dengan pencatatan digital terpadu demi memastikan keteraturan pasokan pasar.
                    </p>

                    <!-- Tahapan budidaya nyata — urutan berarti di sini, jadi angka tepat digunakan -->
                    <div class="pt-4 space-y-0">
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full bg-[var(--moss)] text-white flex items-center justify-center text-[11px] font-black font-mono-data shrink-0">01</div>
                                <div class="step-line w-px flex-1 my-1"></div>
                            </div>
                            <div class="pb-6">
                                <h4 class="text-[var(--ink)] font-extrabold text-sm">Persiapan Baglog</h4>
                                <p class="text-[var(--bark)] text-xs mt-0.5 font-normal">Media tanam serbuk kayu dan bahan organik disterilkan tanpa bahan toksik.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full bg-[var(--moss)] text-white flex items-center justify-center text-[11px] font-black font-mono-data shrink-0">02</div>
                                <div class="step-line w-px flex-1 my-1"></div>
                            </div>
                            <div class="pb-6">
                                <h4 class="text-[var(--ink)] font-extrabold text-sm">Inkubasi Miselium</h4>
                                <p class="text-[var(--bark)] text-xs mt-0.5 font-normal">Suhu dan kelembaban kumbung dipantau konstan hingga baglog dipenuhi miselium.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full bg-[var(--moss)] text-white flex items-center justify-center text-[11px] font-black font-mono-data shrink-0">03</div>
                                <div class="step-line w-px flex-1 my-1"></div>
                            </div>
                            <div class="pb-6">
                                <h4 class="text-[var(--ink)] font-extrabold text-sm">Fase Pertumbuhan</h4>
                                <p class="text-[var(--bark)] text-xs mt-0.5 font-normal">Tudung jamur mulai tumbuh; dashboard mencatat perkembangan tiap kluster kumbung.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-[var(--moss)] text-white flex items-center justify-center text-[11px] font-black font-mono-data shrink-0">04</div>
                            <div>
                                <h4 class="text-[var(--ink)] font-extrabold text-sm">Panen &amp; Distribusi</h4>
                                <p class="text-[var(--bark)] text-xs mt-0.5 font-normal">Jamur dipanen segar setiap hari dan langsung disalurkan ke rantai pasok.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-6 lg:sticky lg:top-28">
                    <div class="bg-gradient-to-br from-[var(--ink)] to-[var(--moss-dark)] rounded-[2rem] p-8 text-white flex flex-col justify-between min-h-64 shadow-xl relative overflow-hidden group">
                        <div class="absolute -right-6 -bottom-6 opacity-[0.06] group-hover:scale-110 transition duration-500">
                            <span class="text-9xl">🍄</span>
                        </div>
                        <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/10">
                            <span class="text-2xl">🏆</span>
                        </div>
                        <div>
                            <p class="text-[9px] text-[var(--tan)] font-extrabold uppercase tracking-wider">Misi Utama</p>
                            <h4 class="text-lg font-black mt-1 leading-tight font-heading">Mendorong Kemandirian Agribisnis Komunitas</h4>
                        </div>
                    </div>

                    <div class="bg-[var(--paper)] border border-[var(--tan)] rounded-[2rem] p-8 flex flex-col justify-between min-h-64 hover:border-[var(--moss-light)]/50 hover:shadow-lg transition duration-300 group">
                        <div class="w-12 h-12 bg-[var(--moss)]/10 text-[var(--moss-dark)] rounded-2xl flex items-center justify-center">
                            <span class="text-2xl">🌱</span>
                        </div>
                        <div>
                            <p class="text-[9px] text-[var(--bark-light)] font-extrabold uppercase tracking-wider">Nilai Inti</p>
                            <h4 class="text-lg font-extrabold text-[var(--ink)] mt-1 leading-tight font-heading">"Bersama Maju, Bersama Sejahtera"</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- === FOOTER === -->
    <footer class="bg-[var(--ink)] text-[var(--tan)] py-12 px-6 border-t border-white/5">
        <div class="max-w-7xl mx-auto flex flex-col items-center justify-center gap-2 text-center">
            <p class="font-black text-white text-lg tracking-tight font-heading">KUPS Harapan Asri</p>
            <p class="text-[11px] text-[var(--tan)]/70 mt-1">Sistem Informasi Monitoring Produksi Jamur Tiram</p>
            <p class="text-[12px] text-[var(--tan)] mt-2 italic">Jorong Tanah Bato Sijunjung, Kabupaten Sijunjung</p>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });
    </script>
</body>
</html>

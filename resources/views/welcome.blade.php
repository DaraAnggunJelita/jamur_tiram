<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUPS Harapan Asri — Sistem Informasi Budidaya Jamur Tiram</title>
    <meta name="description" content="Sistem Informasi Monitoring Produksi Jamur Tiram KUPS Harapan Asri. Temukan produk jamur tiram segar berkualitas tinggi.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 20px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }

        /* Floating animations for tech cards */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
        }
        @keyframes float-reverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-6px) rotate(-1deg); }
        }
        .animate-float-1 {
            animation: float 5s ease-in-out infinite;
        }
        .animate-float-2 {
            animation: float-reverse 4s ease-in-out infinite;
        }
        .animate-float-3 {
            animation: float 6s ease-in-out infinite;
            animation-delay: 1s;
        }

        /* Spore float animations */
        @keyframes spore-float {
            0% { transform: translateY(0) translateX(0) scale(0.8); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-100px) translateX(20px) scale(1.2); opacity: 0; }
        }
        .spore {
            position: absolute;
            background: rgba(52, 211, 153, 0.3);
            border-radius: 50%;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-emerald-500 selection:text-white overflow-x-hidden">

    <!-- === FLOATING GLASSMORPHIC NAVIGATION === -->
    <nav class="bg-white/80 backdrop-blur-lg border-b border-slate-200/50 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Logo -->
                <a href="#beranda" class="flex items-center space-x-3.5 group cursor-pointer">
                    <div class="w-11 h-11 bg-gradient-to-tr from-emerald-600 via-emerald-500 to-teal-400 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20 transform group-hover:rotate-6 transition duration-300">
                        <span class="text-white font-black text-lg tracking-tighter font-heading">K</span>
                    </div>
                    <div>
                        <p class="font-black text-slate-950 text-base leading-tight tracking-tight font-heading">KUPS Harapan Asri</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></span>
                            <span class="text-emerald-700 text-[10px] font-black leading-none uppercase tracking-widest block">Jamur Tiram Organik</span>
                        </div>
                    </div>
                </a>

                <!-- Desktop Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-slate-600 hover:text-emerald-600 text-sm font-bold transition relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-emerald-600 after:transition-all pb-1">Beranda</a>
                    <a href="#katalog" class="text-slate-600 hover:text-emerald-600 text-sm font-bold transition relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-emerald-600 after:transition-all pb-1">Katalog Produk</a>
                    <a href="#tentang" class="text-slate-600 hover:text-emerald-600 text-sm font-bold transition relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-emerald-600 after:transition-all pb-1">Tentang Kami</a>
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md shadow-emerald-600/10 hover:shadow-lg hover:shadow-emerald-600/20 hover:scale-[1.02] active:scale-[0.98] transition duration-200">
                        Akses Sistem
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-slate-600 hover:text-slate-900 p-2 focus:outline-hidden rounded-xl hover:bg-slate-100 transition duration-150">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden md:hidden bg-white/95 border-b border-slate-200/50 backdrop-blur-xl px-6 py-5 space-y-3.5 shadow-xl transition duration-300 animate-fadeIn">
            <a href="#beranda" class="block text-slate-700 hover:text-emerald-600 font-bold text-sm py-2">Beranda</a>
            <a href="#katalog" class="block text-slate-700 hover:text-emerald-600 font-bold text-sm py-2">Katalog Produk</a>
            <a href="#tentang" class="block text-slate-700 hover:text-emerald-600 font-bold text-sm py-2">Tentang Kami</a>
            <a href="{{ route('login') }}" class="w-full flex justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-3 rounded-xl transition duration-150 shadow-sm shadow-emerald-600/10">
                Akses Sistem
            </a>
        </div>
    </nav>

    <!-- === HERO SECTION (Deep Forest Green Gradient & Glowing Blobs) === -->
    <section id="beranda" class="relative bg-gradient-to-br from-slate-950 via-[#051c0f] to-slate-950 text-white min-h-[calc(100vh-5rem)] py-20 lg:py-28 px-6 overflow-hidden">

        <!-- Ambient Glowing Background Circles -->
        <div class="absolute top-[20%] left-[10%] w-[350px] h-[350px] bg-emerald-600/15 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] right-[5%] w-[450px] h-[450px] bg-teal-500/10 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Grid overlay -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,0.015)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.015)_1px,transparent_1px)] bg-[size:4rem_4rem] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10">

            <!-- Left Column: Typography & CTAs -->
            <div class="space-y-6 lg:col-span-7 text-center lg:text-left">
                <span class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[11px] font-black px-4 py-2 rounded-full uppercase tracking-wider backdrop-blur-md">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-ping"></span>
                    Sistem Monitoring KUPS Harapan Asri
                </span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-black leading-tight tracking-tight font-heading">
                    Optimasi & Pemantauan <br class="hidden md:inline"> Produksi <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-300">Jamur Tiram</span>
                </h1>
                {{-- <p class="text-slate-350 text-sm md:text-base max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal font-sans">
                    Transformasi digital pembudidayaan jamur tiram organik di kumbung binaan kelompok usaha tani sirkular. Terintegrasi secara transparan, dipantau berkala, dan dipanen segar setiap hari.
                </p> --}}

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4.5 pt-4">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto bg-white hover:bg-slate-100 text-slate-950 font-black px-8 py-4 rounded-2xl shadow-xl shadow-emerald-950/20 hover:scale-[1.02] active:scale-[0.98] transition duration-200 text-sm text-center">
                        Masuk ke Sistem
                    </a>
                    <a href="#katalog" class="w-full sm:w-auto border border-white/15 text-white font-bold px-8 py-4 rounded-2xl bg-white/5 hover:bg-white/10 hover:border-white/20 transition duration-200 text-sm text-center">
                        Lihat Katalog Produk
                    </a>
                </div>

                <!-- Features bullet details -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-8 max-w-3xl mx-auto lg:mx-0 text-left">
                    <div class="rounded-2xl bg-white/5 border border-white/5 p-4.5 hover:border-emerald-500/20 transition duration-200">
                        <p class="text-[9px] uppercase tracking-widest text-emerald-300 font-black">PRODUKSI</p>
                        <p class="mt-2 text-xs text-slate-300 leading-relaxed">Monitoring harian real-time untuk menjamin volume pasokan.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/5 p-4.5 hover:border-emerald-500/20 transition duration-200">
                        <p class="text-[9px] uppercase tracking-widest text-emerald-300 font-black">MUTU ORGANIK</p>
                        <p class="mt-2 text-xs text-slate-300 leading-relaxed">Tanpa pestisida dan zat kimia murni untuk menjaga kemurnian.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/5 p-4.5 hover:border-emerald-500/20 transition duration-200">
                        <p class="text-[9px] uppercase tracking-widest text-emerald-300 font-black">DISTRIBUSI</p>
                        <p class="mt-2 text-xs text-slate-300 leading-relaxed">Manajemen rantai pasok terpusat untuk menjaga kesegaran.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Mushroom Visual & IoT Sensor Overlay -->
            <div class="lg:col-span-5 relative flex items-center justify-center">

                <!-- Main Image Wrapper with Elegant Shadows -->
                <div class="relative w-full max-w-[420px] aspect-[4/5] rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl shadow-emerald-950/60 z-10 group bg-slate-900/60">
                    <img src="{{ asset('images/oyster_mushroom_hero.png') }}"
                         alt="Budidaya Jamur Tiram Harapan Asri"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700">

                    <!-- Dark Gradient Vignette Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>

                    <!-- Caption on bottom image -->
                    <div class="absolute bottom-6 left-6 right-6 text-left">
                        <span class="text-[9px] font-black uppercase tracking-widest text-emerald-400 bg-emerald-900/50 backdrop-blur-md px-2.5 py-1 rounded border border-emerald-500/35">Kumbung #4</span>
                        <h4 class="text-sm font-bold text-white mt-1.5">Kluster Budidaya Utama</h4>
                        <p class="text-[10px] text-slate-350">Kelembaban dan suhu dipantau konstan secara sirkular.</p>
                    </div>
                </div>

                <!-- Floating IoT Sensor Card 1: Suhu -->
                <div class="absolute -top-6 -left-6 z-20 bg-slate-950/75 backdrop-blur-md border border-white/10 p-3.5 rounded-2xl flex items-center gap-3.5 shadow-xl animate-float-1 w-[180px]">
                    <div class="w-9 h-9 bg-amber-500/20 text-amber-400 rounded-xl flex items-center justify-center text-lg shrink-0">
                        🌡️
                    </div>
                    <div class="min-w-0">
                        <span class="text-[9px] text-slate-400 uppercase tracking-wider block font-bold">SUHU KUMBUNG</span>
                        <span class="text-xs font-black text-white block mt-0.5">24.8°C <span class="text-[9px] text-emerald-400 font-black ml-1 uppercase">✓</span></span>
                    </div>
                </div>

                <!-- Floating IoT Sensor Card 2: Kelembaban -->
                <div class="absolute top-[40%] -right-8 z-20 bg-slate-950/75 backdrop-blur-md border border-white/10 p-3.5 rounded-2xl flex items-center gap-3.5 shadow-xl animate-float-2 w-[180px]">
                    <div class="w-9 h-9 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-lg shrink-0">
                        💧
                    </div>
                    <div class="min-w-0">
                        <span class="text-[9px] text-slate-400 uppercase tracking-wider block font-bold">KELEMBABAN</span>
                        <span class="text-xs font-black text-white block mt-0.5">85% RH <span class="text-[9px] text-emerald-400 font-black ml-1 uppercase">✓</span></span>
                    </div>
                </div>

                <!-- Floating IoT Sensor Card 3: Status -->
                <div class="absolute -bottom-6 -left-4 z-20 bg-slate-950/75 backdrop-blur-md border border-white/10 p-3.5 rounded-2xl flex items-center gap-3.5 shadow-xl animate-float-3 w-[190px]">
                    <div class="w-9 h-9 bg-emerald-500/20 text-emerald-400 rounded-xl flex items-center justify-center text-lg shrink-0">
                        ⚙️
                    </div>
                    <div class="min-w-0">
                        <span class="text-[9px] text-slate-400 uppercase tracking-wider block font-bold">KONDISI SISTEM</span>
                        <span class="text-xs font-black text-emerald-400 block mt-0.5 uppercase tracking-wide">Optimal & Stabil</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- === STATS SECTION (Lifted cards with elegant shadow glows) === -->
    <div class="px-6 relative z-20">
        <section class="bg-white py-8 sm:py-10 border border-slate-200/50 shadow-2xl shadow-slate-900/10 -mt-10 max-w-6xl mx-auto rounded-3xl grid grid-cols-2 md:grid-cols-4 gap-6 px-8 text-center bg-white/95 backdrop-blur-lg">

            <div class="p-2 space-y-0.5 transform hover:scale-[1.03] transition duration-200">
                <p class="text-3.5xl md:text-4.5xl font-black bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent font-heading">500+</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-wider">Kg Panen / Bulan</p>
            </div>

            <div class="p-2 space-y-0.5 border-l border-slate-100 transform hover:scale-[1.03] transition duration-200">
                <p class="text-3.5xl md:text-4.5xl font-black bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent font-heading">100%</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-wider">Mutu Terjamin</p>
            </div>

            <div class="p-2 space-y-0.5 border-l border-slate-100 transform hover:scale-[1.03] transition duration-200">
                <p class="text-3.5xl md:text-4.5xl font-black bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent font-heading">10+</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-wider">Kumbung Binaan</p>
            </div>

            <div class="p-2 space-y-0.5 border-l border-slate-100 transform hover:scale-[1.03] transition duration-200">
                <p class="text-3.5xl md:text-4.5xl font-black bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent font-heading">Grade A</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-wider">Standar Sortir</p>
            </div>

        </section>
    </div>

    <!-- === CATALOG PRODUCT SECTION === -->
    <section id="katalog" class="py-24 bg-slate-100 px-6">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-16 space-y-3">
                <span class="text-emerald-700 text-xs font-black uppercase tracking-widest bg-emerald-100/70 px-4 py-2 rounded-full border border-emerald-200/50">Katalog Digital</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight font-heading">Komoditas Jamur Tiram Unggulan</h2>
                <p class="text-slate-500 text-xs md:text-sm max-w-xl mx-auto leading-relaxed font-normal">Daftar produk jamur tiram putih berkualitas tinggi yang dikelola langsung oleh kelompok tani sirkular Harapan Asri.</p>
            </div>

            @if($catalogs->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($catalogs as $catalog)
                        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-200/60 overflow-hidden transition-all duration-300 group hover:-translate-y-1.5 hover:shadow-emerald-200/40 flex flex-col justify-between">
                            <div>
                                <!-- Image Card -->
                                <div class="h-60 bg-slate-150 flex items-center justify-center overflow-hidden relative">
                                    @if($catalog->image)
                                        <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="text-emerald-600 flex flex-col items-center space-y-2">
                                            <span class="text-6xl transform group-hover:scale-110 transition duration-300">🍄</span>
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Harapan Asri</span>
                                        </div>
                                    @endif
                                    {{-- <span class="absolute top-4 right-4 bg-emerald-500/90 backdrop-blur-md text-white text-[9px] font-black uppercase tracking-wider px-3.5 py-1.5 rounded-xl shadow-sm border border-white/10">Stok Tersedia</span> --}}
                                </div>

                                <!-- Text Body -->
                                <div class="p-7 space-y-2.5">
                                    <h3 class="text-lg font-extrabold text-slate-950 group-hover:text-emerald-600 transition duration-150 font-heading">{{ $catalog->name }}</h3>
                                    <p class="text-slate-500 text-xs leading-relaxed line-clamp-3 font-normal font-sans">{{ $catalog->description }}</p>
                                </div>
                            </div>

                            <!-- Footer Price & WhatsApp CTA -->
                            <div class="p-7 pt-0">
                                <div class="flex items-center justify-between pt-5 border-t border-slate-100">
                                    <div>
                                        <p class="text-[9px] text-slate-400 font-extrabold uppercase tracking-widest">Harga / Kg</p>
                                        <p class="text-slate-950 font-black text-xl mt-0.5">Rp {{ number_format($catalog->price, 0, ',', '.') }}</p>
                                    </div>

                                    {{-- <!-- WhatsApp link -->
                                    <a href="https://wa.me/6281234567890?text=Halo%20KUPS%20Harapan%20Asri,%20saya%20tertarik%20untuk%20memesan%20produk%20{{ urlencode($catalog->name) }}."
                                       target="_blank"
                                       class="bg-[#059669] hover:bg-[#047857] text-white font-extrabold text-xs px-5 py-3 rounded-xl transition duration-200 flex items-center gap-2 shadow-md shadow-emerald-600/10 hover:shadow-emerald-600/20 font-sans">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.411 0 11.989 0c3.183.001 6.177 1.24 8.43 3.496 2.254 2.256 3.491 5.253 3.491 8.434 0 6.583-5.352 11.93-11.933 11.93-2.007-.001-3.982-.506-5.732-1.47L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.742.002-2.602-1.01-5.05-2.85-6.892-1.84-1.842-4.29-2.853-6.895-2.854-5.438 0-9.862 4.37-9.866 9.743-.001 1.714.457 3.39 1.323 4.877l-.994 3.634 3.725-.964z"/></svg>
                                        <span>Pesan</span>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200/80 max-w-lg mx-auto shadow-sm">
                    <span class="text-6xl block mb-4">📦</span>
                    <h3 class="text-slate-900 font-extrabold text-lg font-heading">Katalog Sedang Diperbarui</h3>
                    <p class="text-slate-400 text-xs mt-2 max-w-xs mx-auto font-normal">Sistem sedang memproses sinkronisasi data produk dari inventaris kelompok tani.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- === ABOUT / INSTITUTIONAL PROFILE SECTION === -->
    <section id="tentang" class="py-24 bg-white px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                <!-- Left Column text -->
                <div class="space-y-6 lg:col-span-6">
                    <span class="text-emerald-700 text-xs font-black uppercase tracking-widest bg-emerald-100/70 px-4 py-2 rounded-full border border-emerald-200/50">Profil Kelembagaan</span>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight tracking-tight font-heading">Mengenal Kelompok Usaha Harapan Asri</h2>
                    <p class="text-slate-600 leading-relaxed text-sm md:text-base font-normal font-sans">
                        KUPS Harapan Asri didirikan atas dasar kolaborasi aktif komunitas petani dalam menata tata kelola budidaya jamur tiram yang ramah lingkungan. Kami memadukan kearifan agrikultur lokal dengan pencatatan digital terpadu demi memastikan keteraturan pasokan pasar.
                    </p>

                    <div class="space-y-4.5 pt-2">
                        <div class="flex items-start space-x-4">
                            <div class="w-8.5 h-8.5 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0 text-emerald-600 mt-0.5">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 class="text-slate-950 font-extrabold text-sm">Sertifikasi Alami Sirkular</h4>
                                <p class="text-slate-500 text-xs mt-0.5 font-normal">Nutrisi baglog menggunakan komponen organik pilihan tanpa bahan toksik.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-8.5 h-8.5 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0 text-emerald-600 mt-0.5">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 class="text-slate-950 font-extrabold text-sm">Pemantauan Terdistribusi</h4>
                                <p class="text-slate-500 text-xs mt-0.5 font-normal">Dashboard monitoring menyatukan akumulasi laporan panen harian seluruh kluster.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column graphic cards -->
                <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-slate-950 to-emerald-950 rounded-[2rem] p-8 text-white flex flex-col justify-between min-h-64 shadow-xl border border-slate-900 relative overflow-hidden group">
                        <!-- Spore glow icon -->
                        <div class="absolute -right-6 -bottom-6 opacity-[0.03] group-hover:scale-110 transition duration-500">
                            <span class="text-9xl">🍄</span>
                        </div>
                        <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/10">
                            <span class="text-2.5xl">🏆</span>
                        </div>
                        <div>
                            <p class="text-[9px] text-emerald-400 font-extrabold uppercase tracking-wider">Misi Utama</p>
                            <h4 class="text-lg font-black mt-1 leading-tight font-heading">Mendorong Kemandirian Agribisnis Komunitas</h4>
                        </div>
                    </div>

                    <div class="bg-slate-50 border border-slate-200 rounded-[2rem] p-8 flex flex-col justify-between min-h-64 hover:border-emerald-500/30 hover:shadow-lg transition duration-300 group">
                        <div class="w-12 h-12 bg-emerald-600/10 text-emerald-600 rounded-2xl flex items-center justify-center">
                            <span class="text-2.5xl">🌱</span>
                        </div>
                        <div>
                            <p class="text-[9px] text-slate-400 font-extrabold uppercase tracking-wider">Nilai Inti</p>
                            <h4 class="text-lg font-extrabold text-slate-950 mt-1 leading-tight font-heading">"Bersama Maju, Bersama Sejahtera"</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- === FOOTER === -->
<footer class="bg-slate-950 text-slate-400 py-12 px-6 border-t border-slate-900">
    <div class="max-w-7xl mx-auto flex flex-col items-center justify-center gap-6 text-center">
        <div>
            <p class="font-black text-white text-lg tracking-tight font-heading">KUPS Harapan Asri</p>
            <p class="text-[11px] text-slate-500 mt-1">Sistem Informasi Monitoring Produksi Jamur Tiram</p>
            <!-- Tambahan Lokasi -->
            <p class="text-[12px] text-slate-400 mt-2 italic">Jorong Tanah Bato Sijunjung, Kabupaten Sijunjung</p>
        </div>
    </div>
</footer>

            {{-- <div class="flex flex-wrap justify-center gap-6 text-xs font-bold uppercase tracking-wider">
                <a href="#beranda" class="hover:text-emerald-400 transition duration-150">Beranda</a>
                <a href="#katalog" class="hover:text-emerald-400 transition duration-150">Katalog</a>
                <a href="#tentang" class="hover:text-emerald-400 transition duration-150">Tentang</a>
                <a href="{{ route('login') }}" class="text-emerald-500 hover:text-emerald-400 transition duration-150">Akses Sistem</a>
            </div> --}}

            <div>
                {{-- <p class="text-[11px] text-slate-600">&copy; {{ date('Y') }} KUPS Harapan Asri. Dokumen Tugas Akhir Sistem Informasi.</p> --}}
            </div>
        </div>
    </footer>

    <!-- Toggle mobile menu script -->
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

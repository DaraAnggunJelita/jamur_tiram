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
        body { font-family: 'Inter', sans-serif; background-color: #FBF8F1; color: #26201B; }
        .font-heading { font-family: 'Fraunces', serif; font-optical-sizing: auto; }

        .text-moss { color: #4F6146; }
        .bg-moss { background-color: #4F6146; }
        .hover-bg-moss:hover { background-color: #37452F; }

        .text-clay { color: #A0653D; }
        .bg-clay { background-color: #A0653D; }

        .border-tan { border-color: #C9B896; }
        .bg-paper { background-color: #F6F1E6; }

        /* Subtle fade-in animation for scroll */
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="antialiased selection:bg-[#4F6146] selection:text-white">

    <!-- === NAVIGASI === -->
    <nav id="navbar" class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-[#C9B896]/30 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-10">
                <!-- Logo -->
                <a href="#beranda" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-moss rounded-xl flex items-center justify-center text-white font-black text-xl font-heading shadow-md transition-transform group-hover:scale-105">
                        K
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-[#26201B] text-lg leading-none font-heading tracking-tight">KUPS Harapan Asri</span>
                        <span class="text-clay text-[10px] font-black uppercase tracking-[0.15em] mt-1">Premium Organik</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-[#6B4E36] hover:text-moss text-sm font-semibold transition-colors">Beranda</a>
                    <a href="#keunggulan" class="text-[#6B4E36] hover:text-moss text-sm font-semibold transition-colors">Keunggulan</a>
                    <a href="#katalog" class="text-[#6B4E36] hover:text-moss text-sm font-semibold transition-colors">Katalog</a>
                    <a href="#tentang" class="text-[#6B4E36] hover:text-moss text-sm font-semibold transition-colors">Tentang Kami</a>
                    <a href="{{ route('login') }}" class="ml-4 px-6 py-2.5 bg-moss hover-bg-moss text-white text-xs font-black uppercase tracking-widest rounded-full shadow-md transition-all transform hover:-translate-y-0.5">
                        Akses Sistem
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-[#26201B] p-2 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden absolute w-full bg-white border-b border-tan shadow-xl px-6 py-6 space-y-4">
            <a href="#beranda" class="block text-[#26201B] font-bold py-2">Beranda</a>
            <a href="#keunggulan" class="block text-[#26201B] font-bold py-2">Keunggulan</a>
            <a href="#katalog" class="block text-[#26201B] font-bold py-2">Katalog Produk</a>
            <a href="#tentang" class="block text-[#26201B] font-bold py-2">Tentang Kami</a>
            <div class="pt-4 mt-2 border-t border-tan/30">
                <a href="{{ route('login') }}" class="w-full flex justify-center bg-moss text-white font-black text-sm uppercase py-3 rounded-xl">
                    Akses Sistem
                </a>
            </div>
        </div>
    </nav>

    <!-- === HERO SECTION === -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">

                <!-- Hero Text -->
                <div class="space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-bg-paper border border-tan/50 mx-auto lg:mx-0">
                        <span class="w-2 h-2 rounded-full bg-moss animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-moss">Hasil Panen Terbaik Hari Ini</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight font-heading text-[#26201B]">
                        Kesegaran Jamur Tiram <span class="text-moss italic">Premium</span> dari Petani Lokal.
                    </h1>

                    <p class="text-[#6B4E36] text-base md:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Kami membudidayakan jamur tiram organik dengan pengawasan sistem terpadu. Lebih bersih, lebih sehat, dan langsung dari kumbung kami ke dapur Anda.
                    </p>

                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#katalog" class="w-full sm:w-auto px-8 py-3.5 bg-moss hover-bg-moss text-white text-sm font-bold rounded-full shadow-lg transition-transform transform hover:-translate-y-0.5">
                            Lihat Produk
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 bg-transparent border-2 border-tan hover:border-moss text-[#26201B] text-sm font-bold rounded-full transition-colors">
                            Masuk Sistem
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="pt-8 mt-8 border-t border-tan/30 flex items-center justify-center lg:justify-start gap-8">
                        <div>
                            <p class="text-3xl font-black font-heading text-[#26201B]">100<span class="text-clay">%</span></p>
                            <p class="text-[10px] text-[#8E6E4E] uppercase tracking-widest font-bold mt-1">Organik Murni</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black font-heading text-[#26201B]">A<span class="text-clay">+</span></p>
                            <p class="text-[10px] text-[#8E6E4E] uppercase tracking-widest font-bold mt-1">Kualitas Grade</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative mx-auto w-full max-w-md lg:max-w-full lg:mr-0">
                    <!-- Decorative background element -->
                    <div class="absolute inset-0 bg-tan/20 rounded-[2.5rem] transform rotate-3 scale-105"></div>
                    <!-- Main image -->
                    <img src="{{ asset('images/oyster_mushroom_hero.png') }}" alt="Jamur Tiram Segar" class="relative z-10 rounded-[2.5rem] shadow-xl w-full object-cover aspect-[4/3] lg:aspect-[4/4]">

                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 z-20 bg-white p-4 rounded-2xl shadow-xl border border-tan/30 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-2xl">🌱</div>
                        <div>
                            <p class="text-xs text-[#8E6E4E] font-bold uppercase tracking-widest">Status Panen</p>
                            <p class="text-sm font-black font-heading text-moss">Siap Diolah</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- === KEUNGGULAN SECTION === -->
    <section id="keunggulan" class="py-24 bg-bg-paper relative border-y border-tan/20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 reveal">
            <div class="text-center mb-16 max-w-2xl mx-auto">
                <span class="text-clay text-[10px] font-black uppercase tracking-[0.2em] mb-3 block">Kenapa Memilih Kami?</span>
                <h2 class="text-3xl md:text-4xl font-black text-[#26201B] tracking-tight font-heading">
                    Kualitas dari Hulu ke Hilir
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-tan/40 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-moss/10 text-moss rounded-2xl flex items-center justify-center text-2xl mb-6">🌿</div>
                    <h3 class="text-xl font-black text-[#26201B] font-heading mb-3">Organik & Sehat</h3>
                    <p class="text-[#6B4E36] text-sm leading-relaxed">
                        Dibudidayakan tanpa bahan kimia berbahaya. Menggunakan media tanam alami serbuk gergaji kayu murni untuk nutrisi optimal.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-tan/40 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-clay/10 text-clay rounded-2xl flex items-center justify-center text-2xl mb-6">📊</div>
                    <h3 class="text-xl font-black text-[#26201B] font-heading mb-3">Terdata Sistematis</h3>
                    <p class="text-[#6B4E36] text-sm leading-relaxed">
                        Seluruh jadwal pembuatan baglog, inkubasi, hingga panen tercatat rapi di dalam sistem kami untuk menjaga konsistensi.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-tan/40 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-[#8E6E4E]/10 text-[#8E6E4E] rounded-2xl flex items-center justify-center text-2xl mb-6">🚚</div>
                    <h3 class="text-xl font-black text-[#26201B] font-heading mb-3">Segar Setiap Hari</h3>
                    <p class="text-[#6B4E36] text-sm leading-relaxed">
                        Proses panen dilakukan di pagi hari untuk memastikan tekstur jamur tiram tetap kenyal dan tidak layu saat didistribusikan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- === KATALOG PRODUK === -->
    <section id="katalog" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 reveal">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <span class="text-moss text-[10px] font-black uppercase tracking-[0.2em] mb-3 block">Katalog Produk</span>
                    <h2 class="text-3xl md:text-4xl font-black text-[#26201B] tracking-tight font-heading">Tawaran Terbaik <br class="hidden md:block"/>Untuk Anda</h2>
                </div>
                <p class="text-[#6B4E36] text-sm max-w-sm leading-relaxed">
                    Pilihan jamur tiram dan olahan terbaik langsung dari kelompok usaha perhutanan sosial Harapan Asri.
                </p>
            </div>

            @if($catalogs->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($catalogs as $catalog)
                        <div class="group bg-bg-paper rounded-3xl overflow-hidden border border-tan/30 hover:shadow-xl transition-all duration-300">
                            <!-- Image -->
                            <div class="h-64 bg-white relative p-6">
                                @if($catalog->image)
                                    <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->name }}" class="w-full h-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full rounded-2xl bg-tan/20 flex flex-col items-center justify-center space-y-2">
                                        <span class="text-4xl">🍄</span>
                                        <span class="text-[10px] font-bold text-[#8E6E4E] uppercase">Tanpa Foto</span>
                                    </div>
                                @endif
                                <div class="absolute top-8 right-8 bg-white px-3 py-1 rounded-full shadow text-[10px] font-bold text-moss uppercase tracking-widest">
                                    Tersedia
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-black text-[#26201B] font-heading mb-2">{{ $catalog->name }}</h3>
                                <p class="text-[#6B4E36] text-sm line-clamp-2 mb-6 h-10">{{ $catalog->description }}</p>

                                <div class="pt-4 border-t border-tan/40">
                                    <p class="text-[10px] text-[#8E6E4E] font-black uppercase tracking-widest mb-1">Harga Satuan</p>
                                    <p class="font-black text-2xl text-moss tracking-tight font-heading">
                                        Rp{{ number_format($catalog->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-bg-paper rounded-3xl border border-dashed border-tan/60 max-w-2xl mx-auto">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 text-3xl shadow-sm">📦</div>
                    <h3 class="text-[#26201B] font-black text-xl font-heading mb-2">Belum Ada Katalog</h3>
                    <p class="text-[#6B4E36] text-sm max-w-sm mx-auto">Saat ini kami sedang menyiapkan produk jamur segar terbaik untuk ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- === TENTANG KAMI === -->
    <section id="tentang" class="py-24 bg-bg-paper border-y border-tan/20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 reveal">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Text -->
                <div class="space-y-6">
                    <span class="text-clay text-[10px] font-black uppercase tracking-[0.2em] mb-1 block">Profil KUPS</span>
                    <h2 class="text-3xl md:text-4xl font-black text-[#26201B] leading-tight font-heading">
                        Merawat Alam,<br>Memberdayakan Petani.
                    </h2>
                    <p class="text-[#6B4E36] text-sm md:text-base leading-relaxed">
                        KUPS Harapan Asri terbentuk dari inisiatif kelompok masyarakat desa yang peduli terhadap pelestarian hutan dan kemandirian ekonomi. Melalui budidaya jamur tiram, kami memanfaatkan serbuk sisa gergaji kayu menjadi media bernilai ekonomis.
                    </p>
                    <p class="text-[#6B4E36] text-sm md:text-base leading-relaxed pb-4">
                        Dengan sistem informasi modern ini, semua proses dari pembibitan, inkubasi baglog, hingga laporan panen tercatat rapi untuk memastikan transparansi dan keadilan bagi semua anggota kelompok.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-moss font-bold text-sm hover:text-clay transition-colors group">
                        Masuk ke Dashboard Sistem
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- Right: Image / Illustration -->
                <div class="relative">
                    <div class="w-full aspect-square md:aspect-[4/3] rounded-3xl overflow-hidden bg-tan/30 border border-tan/50 relative">
                        <!-- Placeholder for a kumbung image or abstract pattern if none exists -->
                        <div class="absolute inset-0 bg-white flex flex-col items-center justify-center text-center p-8">
                            <div class="w-20 h-20 bg-moss/10 text-moss rounded-full flex items-center justify-center text-4xl mb-4">🏠</div>
                            <h3 class="font-heading font-black text-xl text-[#26201B] mb-2">Kumbung Harapan Asri</h3>
                            <p class="text-xs text-[#8E6E4E] max-w-xs">Pusat inkubasi baglog berkapasitas besar dengan pengaturan suhu optimal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- === FOOTER === -->
    <footer class="bg-white pt-16 pb-8 border-t border-tan/30 text-center">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="w-12 h-12 bg-moss text-white rounded-xl flex items-center justify-center text-2xl font-black font-heading mx-auto mb-6">
                K
            </div>
            <h4 class="font-black text-[#26201B] text-xl tracking-tight font-heading mb-2">KUPS Harapan Asri</h4>
            <p class="text-[#8E6E4E] text-sm max-w-md mx-auto mb-8">Sistem Informasi Monitoring Budidaya Jamur Tiram Terpadu.</p>

            {{-- <div class="flex items-center justify-center gap-6 mb-12">
                <a href="#beranda" class="text-xs font-bold text-[#6B4E36] hover:text-moss uppercase tracking-widest">Beranda</a>
                <a href="#keunggulan" class="text-xs font-bold text-[#6B4E36] hover:text-moss uppercase tracking-widest">Keunggulan</a>
                <a href="#katalog" class="text-xs font-bold text-[#6B4E36] hover:text-moss uppercase tracking-widest">Katalog</a>
            </div> --}}

            <div class="border-t border-tan/30 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-[#8E6E4E] font-medium">
                <p>&copy; {{ date('Y') }} KUPS Harapan Asri.</p>
                <p>Dikembangkan untuk Tata Kelola Pertanian Modern</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Logic
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

        // Scroll Animation Logic
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        setTimeout(reveal, 100);
    </script>
</body>
</html>

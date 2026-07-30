<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Lembaga — {{ $profile->nama_kups }}</title>
    <meta name="description" content="Profil lengkap, Visi, Misi, dan Sejarah dari {{ $profile->nama_kups }}, {{ $profile->sub_judul }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f0e8; color: #2c2c2c; line-height: 1.7; }
        .navbar { position: sticky; top: 0; z-index: 100; background: #f0ebe0; border-bottom: 1px solid #d5cab4; padding: 0 24px; }
        .navbar-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; height: 60px; }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit; }
        .brand-icon { width: 34px; height: 34px; background: #2d5a3d; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 15px; }
        .brand-name { font-weight: 700; font-size: 14px; color: #111; }
        .brand-sub  { font-size: 11px; color: #6b7280; }
        .nav-links  { display: flex; align-items: center; gap: 28px; list-style: none; }
        .nav-links a { font-size: 13px; font-weight: 500; color: #555; text-decoration: none; transition: color .15s; }
        .nav-links a:hover { color: #2d5a3d; }
        .nav-btn { font-size: 13px; font-weight: 600; color: #fff !important; background: #2d5a3d !important; padding: 7px 18px; border-radius: 5px; text-decoration: none; transition: background .15s; }
        .nav-btn:hover { background: #1e3d2a !important; }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-inner">
                <a href="{{ route('welcome') }}" class="brand">
                    <div class="brand-icon">K</div>
                    <div>
                        <div class="brand-name">{{ $profile->nama_kups }}</div>
                        <div class="brand-sub">{{ $profile->sub_judul }}</div>
                    </div>
                </a>
                <ul class="nav-links">
                    <li><a href="{{ route('welcome') }}">Kembali ke Beranda</a></li>
                    <li><a href="{{ route('login') }}" class="nav-btn">Masuk Sistem</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-[#d5cab4]/60 overflow-hidden">
            
            <!-- Header Banner -->
            <div class="bg-[#2d5a3d] text-white p-8 md:p-12 relative overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-10 translate-y-10">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <div class="relative z-10">
                    <span class="inline-block px-3 py-1 bg-white/10 rounded-md text-xs uppercase tracking-widest font-bold mb-3 text-[#b2dfdb]">
                        Profil & Legalitas Lembaga
                    </span>
                    <h1 class="text-3xl md:text-4xl font-black mb-2">{{ $profile->nama_kups }}</h1>
                    <p class="text-emerald-100 text-lg">{{ $profile->sub_judul }}</p>
                </div>
            </div>

            <!-- Content section -->
            <div class="p-8 md:p-12 space-y-12 text-gray-700">
                
                <!-- Sejarah & Tentang -->
                <section>
                    <h2 class="text-xl font-extrabold text-[#2d5a3d] mb-4 pb-2 border-b border-gray-200 flex items-center gap-2">
                        <span>Tentang Kami</span>
                    </h2>
                    <p class="text-base leading-relaxed text-justify text-gray-600">
                        {{ $profile->tentang_kami }}
                    </p>
                </section>

                <!-- Visi & Misi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-emerald-50/60 p-6 rounded-2xl border border-emerald-100">
                        <h3 class="text-lg font-bold text-[#1b3b27] mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#2d5a3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Visi Kami</span>
                        </h3>
                        <p class="text-sm leading-relaxed text-gray-700 font-medium italic">
                            "{{ $profile->visi }}"
                        </p>
                    </div>

                    <div class="bg-amber-50/50 p-6 rounded-2xl border border-amber-100">
                        <h3 class="text-lg font-bold text-[#785325] mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Misi & Langkah</span>
                        </h3>
                        <div class="text-sm leading-relaxed text-gray-700 whitespace-pre-line font-medium">
                            {{ $profile->misi }}
                        </div>
                    </div>
                </div>

                <!-- Statistik -->
                <section class="bg-[#2a382e] text-white p-8 rounded-2xl">
                    <div class="grid grid-cols-3 text-center gap-4">
                        <div>
                            <div class="text-3xl font-extrabold text-[#95d5b2]">{{ $profile->jumlah_anggota }}</div>
                            <div class="text-xs uppercase tracking-widest mt-1 text-gray-300">Anggota Aktif</div>
                        </div>
                        <div class="border-x border-white/10">
                            <div class="text-3xl font-extrabold text-[#95d5b2]">{{ $profile->siklus_panen }}×</div>
                            <div class="text-xs uppercase tracking-widest mt-1 text-gray-300">Siklus Panen / Musim</div>
                        </div>
                        <div>
                            <div class="text-3xl font-extrabold text-[#95d5b2]">{{ $profile->tahun_berdiri }}</div>
                            <div class="text-xs uppercase tracking-widest mt-1 text-gray-300">Tahun Berdiri</div>
                        </div>
                    </div>
                </section>

                <!-- Kontak -->
                <section>
                    <h2 class="text-xl font-extrabold text-[#2d5a3d] mb-4 pb-2 border-b border-gray-200">
                        Informasi Kontak & Sekretariat
                    </h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-gray-900 w-32 shrink-0">Alamat Kumbung</span>
                            <span>: {{ $profile->alamat }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-gray-900 w-32 shrink-0">Nomor Telepon</span>
                            <span>: {{ $profile->nomor_telepon ?: '-' }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="font-bold text-gray-900 w-32 shrink-0">Alamat Email</span>
                            <span>: {{ $profile->email ?: '-' }}</span>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <footer class="bg-[#1f3a28] text-white/60 py-8 text-center text-xs mt-16 border-t border-white/10">
        <p>&copy; {{ date('Y') }} {{ $profile->nama_kups }}. Sistem Monitoring dan Traceability Budidaya Jamur Tiram.</p>
    </footer>
</body>
</html>

@php
    $user = auth()->user();

    $dashboardRoute = route('dashboard');
    $isDashboardActive = request()->routeIs('dashboard');
    $pendingCount = 0;

    if ($user) {
        // Tentukan route dashboard berdasarkan role
        if ($user->isAdmin()) {
            $dashboardRoute = route('admin.dashboard');
            $isDashboardActive = request()->routeIs('admin.dashboard');
            $pendingCount = \App\Models\ProductionReport::where('status_validasi', 'pending')->count();
        } elseif ($user->isPetugas()) {
            $dashboardRoute = route('petugas.dashboard');
            $isDashboardActive = request()->routeIs('petugas.dashboard');
        } elseif ($user->isKetua()) {
            $dashboardRoute = route('ketua.dashboard');
            $isDashboardActive = request()->routeIs('ketua.dashboard');
        }
    }
@endphp

@if($user)
<div class="flex flex-col h-full bg-gradient-to-b from-[#3A5A40] to-[#253B29] border-r border-[#E6D5B8]/20 shadow-xl text-white">

    {{-- HEADER BRAND / LOGO (LEBIH KOMPAK) --}}
    <div class="flex items-center gap-3 px-3.5 h-14 border-b border-white/10 shrink-0 bg-transparent">
        <div class="w-8 h-8 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center shadow-md shrink-0 border border-white/20">
            <span class="text-white font-black text-sm tracking-tighter">K</span>
        </div>
        <div class="flex flex-col overflow-hidden">
            <span class="text-white font-bold text-sm leading-tight truncate font-serif">
                Harapan Asri
            </span>
            <span class="text-[#E6D5B8]/80 text-[9px] font-extrabold uppercase tracking-wide truncate">
                @if($user->isAdmin()) ADMIN PANEL
                @elseif($user->isPetugas()) PETUGAS KUMBUNG
                @elseif($user->isKetua()) LAPORAN EKSEKUTIF
                @else MEMBER AREA
                @endif
            </span>
        </div>
    </div>

    {{-- NAVIGATION MENU (LEBIH RAPAT & TIDAK MEMANJANG KOSONG) --}}
    <nav class="flex-1 overflow-y-auto py-3 px-2.5 space-y-4 scrollbar-hide text-xs font-semibold">

        {{-- MENU ADMIN --}}
        @if($user->isAdmin())
        <div>
            <div class="px-2.5 mb-1.5">
                <span class="text-[9px] font-extrabold text-[#E6D5B8]/60 uppercase tracking-wider">Admin Panel</span>
            </div>
            <div class="space-y-0.5">
                {{-- Dashboard Admin --}}
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span class="truncate">Dashboard Admin <span class="text-red-400">●</span></span>
                </a>

                {{-- Kelola Akun --}}
                <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('admin.users.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <span class="truncate">Kelola Akun Pengguna</span>
                </a>

                {{-- Kelola Bibit (CRUD) --}}
                <a href="{{ route('bibit.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('bibit.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('bibit.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <span class="truncate">Kelola Data Bibit</span>
                </a>

                {{-- Pengaturan EWS --}}
                <a href="{{ route('admin.ews.settings') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('admin.ews.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('admin.ews.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span class="truncate">Pengaturan Batas EWS</span>
                </a>

                {{-- Katalog Produk --}}
                <a href="{{ route('admin.catalogs.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('admin.catalogs.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('admin.catalogs.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <span class="truncate">Katalog Produk</span>
                </a>

                {{-- Kelola Profile KUPS --}}
                <a href="{{ route('admin.profile-kups.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('admin.profile-kups.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('admin.profile-kups.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <span class="truncate">Kelola Profile KUPS</span>
                </a>
            </div>
        </div>
        @endif

        {{-- MENU PETUGAS PRODUKSI --}}
        @if($user->isPetugas() || $user->isAdmin())
        <div>
            <div class="px-2.5 mb-1.5">
                <span class="text-[9px] font-extrabold text-[#E6D5B8]/60 uppercase tracking-wider">Alur Lapangan</span>
            </div>
            <div class="space-y-0.5">
                {{-- Dashboard Petugas --}}
                @if($user->isPetugas())
                <a href="{{ route('petugas.dashboard') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('petugas.dashboard') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('petugas.dashboard') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span class="truncate">Dashboard <span class="text-red-400">●</span></span>
                </a>
                @endif

                {{-- Sterilisasi --}}
                <a href="{{ route('sterilisasi.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('sterilisasi.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('sterilisasi.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="truncate">Sterilisasi Baglog</span>
                </a>

                {{-- Inokulasi --}}
                <a href="{{ route('inokulasi.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('inokulasi.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('inokulasi.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <span class="truncate">Data Inokulasi</span>
                </a>

                {{-- Monitoring --}}
                <a href="{{ route('monitoring.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('monitoring.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('monitoring.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="truncate">Monitoring Kumbung</span>
                </a>

                {{-- Pencatatan Panen --}}
                <a href="{{ route('petugas.laporan-panen.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('petugas.laporan-panen.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('petugas.laporan-panen.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </div>
                    <span class="truncate">Pencatatan Panen</span>
                </a>

                {{-- Alokasi Rendang Jamur --}}
                <a href="{{ route('rendang.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('rendang.index') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('rendang.index') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <span class="truncate">Alokasi Rendang</span>
                </a>
            </div>
        </div>
        @endif

        {{-- MENU KETUA KUPS --}}
        @if($user->isKetua() || $user->isAdmin())
        <div>
            <div class="px-2.5 mb-1.5">
                <span class="text-[9px] font-extrabold text-[#E6D5B8]/60 uppercase tracking-wider">Supervisi & Laporan</span>
            </div>
            <div class="space-y-0.5">
                {{-- Dashboard Eksekutif --}}
                @if($user->isKetua())
                <a href="{{ route('ketua.dashboard') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('ketua.dashboard') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('ketua.dashboard') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="truncate">Dashboard Eksekutif</span>
                </a>
                @endif

                {{-- Pantau Stok Bibit --}}
                <a href="{{ route('ketua.bibit.pantau') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('ketua.bibit.pantau') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('ketua.bibit.pantau') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                    </div>
                    <span class="truncate">Pantau Stok Bibit</span>
                </a>

                {{-- Verifikasi Data --}}
                <a href="{{ route('ketua.verifikasi.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('ketua.verifikasi.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('ketua.verifikasi.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="truncate">Verifikasi Data Petugas</span>
                </a>

                {{-- Cetak Laporan --}}
                <a href="{{ route('ketua.reports.index') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('ketua.reports.*') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('ketua.reports.*') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="truncate">Cetak Laporan</span>
                </a>
            </div>
        </div>
        @endif

        {{-- PROFIL AKUN (SEMUA ROLE) --}}
        <div>
            <div class="px-2.5 mb-1.5 mt-2 border-t border-white/10 pt-3">
                <span class="text-[9px] font-extrabold text-[#E6D5B8]/60 uppercase tracking-wider">Akun & Pengaturan</span>
            </div>
            <div class="space-y-0.5">
                <a href="{{ route('profile.edit') }}" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-lg transition duration-150 {{ request()->routeIs('profile.edit') ? 'bg-[#10B981]/15 text-[#10B981] font-bold' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center justify-center w-7 h-7 rounded-md {{ request()->routeIs('profile.edit') ? 'bg-[#10B981]/20 text-[#10B981]' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <span class="truncate">Profil Pengguna</span>
                </a>
            </div>
        </div>

    </nav>

    {{-- FOOTER USER PROFILE (LEBIH KOMPAK) --}}
    <div class="p-2.5 border-t border-white/10 shrink-0 bg-black/20">
        <div class="flex items-center justify-between gap-2 bg-white/5 hover:bg-white/10 transition rounded-xl p-2 border border-white/10">
            <div class="flex items-center gap-2.5 overflow-hidden min-w-0">
                <div class="w-8 h-8 rounded-lg font-extrabold text-xs flex items-center justify-center shrink-0 bg-[#10B981] text-[#253B29] shadow-inner">
                    {{ substr($user->name, 0, 2) }}
                </div>
                <div class="flex flex-col overflow-hidden min-w-0">
                    <span class="text-xs font-bold text-white truncate font-sans">
                        {{ $user->name }}
                    </span>
                    <span class="text-[9px] font-bold text-[#E6D5B8]/80 uppercase truncate">
                        {{ $user->role }}
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit"
                    title="Keluar Sistem"
                    class="w-7 h-7 flex items-center justify-center rounded-lg text-[#E6D5B8]/60 hover:text-white hover:bg-red-500/80 transition duration-150 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endif

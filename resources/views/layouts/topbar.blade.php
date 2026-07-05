@php
    $user = auth()->user();

    // Mapping judul halaman berdasarkan route aktif
    $pageTitle = 'Dashboard';
    if (request()->routeIs('admin.dashboard'))       $pageTitle = 'Antrian Validasi Pasokan';
    elseif (request()->routeIs('admin.users.*'))      $pageTitle = 'Manajemen Akun Pengguna';
    elseif (request()->routeIs('admin.catalogs.create')) $pageTitle = 'Tambah Produk Katalog';
    elseif (request()->routeIs('admin.catalogs.edit'))   $pageTitle = 'Edit Produk Katalog';
    elseif (request()->routeIs('admin.catalogs.*'))   $pageTitle = 'Pengelolaan Katalog Produk';
    elseif (request()->routeIs('petugas.dashboard'))  $pageTitle = 'Dashboard Petugas Harian';
    elseif (request()->routeIs('petugas.laporan-panen.create')) $pageTitle = 'Input Hasil Panen Harian';
    elseif (request()->routeIs('petugas.laporan-panen.edit'))   $pageTitle = 'Edit Laporan Hasil Panen';
    elseif (request()->routeIs('petugas.laporan-panen.*'))   $pageTitle = 'Kelola Laporan Panen';
    elseif (request()->routeIs('ketua.dashboard'))    $pageTitle = 'Tren & Laporan Hasil Panen';
    elseif (request()->routeIs('baglog.create'))      $pageTitle = 'Log Kondisi Kumbung';
    elseif (request()->routeIs('baglog.*'))           $pageTitle = 'Pemantauan Baglog';
    elseif (request()->routeIs('jadwal-panen.create')) $pageTitle = 'Atur Perkiraan Panen';
    elseif (request()->routeIs('jadwal-panen.*'))      $pageTitle = 'Agenda Jadwal Panen';
    elseif (request()->routeIs('profile.*'))          $pageTitle = 'Pengaturan Profil Akun';

    // Label role
    $roleLabel = match($user->role) {
        'admin'   => 'Admin Panel',
        'petugas' => 'Petugas Kumbung',
        'ketua'   => 'Laporan Eksekutif',
        default   => 'Member Area',
    };
@endphp

<header class="bg-white/80 backdrop-blur-md border-b border-slate-200/60 sticky top-0 z-30 h-16 flex items-center justify-between px-4 sm:px-6 shrink-0 shadow-sm">

    <!-- ====== KIRI: Hamburger + Breadcrumbs ====== -->
    <div class="flex items-center gap-4 min-w-0">

        <!-- Hamburger (hanya mobile) -->
        <button type="button"
                class="md:hidden -ml-1 flex items-center justify-center w-9 h-9 rounded-xl text-slate-500 hover:text-slate-800 hover:bg-slate-100 focus:outline-none transition duration-150"
                @click="sidebarOpen = true">
            <span class="sr-only">Buka sidebar</span>
            <svg class="w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Logo singkat untuk mobile (tidak ada sidebar fixed) -->
        <div class="flex items-center gap-2 md:hidden">
            <div class="w-7 h-7 bg-gradient-to-tr from-emerald-600 to-teal-400 rounded-lg flex items-center justify-center shadow-sm">
                <span class="text-white font-black text-[10px] font-heading">H</span>
            </div>
            <span class="font-extrabold text-slate-900 text-xs tracking-tight leading-tight">KUPS Harapan Asri</span>
        </div>

        <!-- Breadcrumbs (hanya desktop) -->
        <nav class="hidden md:flex items-center gap-1.5 text-xs font-semibold min-w-0" aria-label="Breadcrumb">
            <span class="text-slate-400 truncate">{{ $roleLabel }}</span>
            <svg class="w-3.5 h-3.5 text-slate-300 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-slate-800 font-extrabold truncate">{{ $pageTitle }}</span>
        </nav>

    </div>

    <!-- ====== KANAN: Status + Dropdown Profil ====== -->
    <div class="flex items-center gap-3 shrink-0">

        <!-- Indikator Sistem Online (tersembunyi di mobile) -->
        <div class="hidden sm:flex items-center gap-1.5 bg-emerald-50 border border-emerald-200/60 px-3 py-1.5 rounded-full">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="text-[9px] text-emerald-800 font-black tracking-widest uppercase">Sistem Online</span>
        </div>

        <!-- Dropdown Menu Profil -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-slate-200 text-xs font-bold rounded-xl text-slate-600 bg-white hover:bg-slate-50 hover:text-slate-800 focus:outline-none transition duration-150 shadow-sm">
                    <!-- Avatar inisial -->
                    <div class="w-6 h-6 rounded-lg font-black text-[9px] flex items-center justify-center uppercase
                                {{ $user->role === 'admin'  ? 'bg-rose-100 text-rose-700'    :
                                   ($user->role === 'ketua' ? 'bg-blue-100 text-blue-700'    :
                                   'bg-emerald-100 text-emerald-700') }}">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <!-- Nama (hanya di sm+) -->
                    <span class="hidden sm:inline max-w-[120px] truncate">{{ $user->name }}</span>
                    <!-- Role badge -->
                    <span class="text-[8px] font-black px-1.5 py-0.5 rounded-md uppercase border hidden sm:inline-block
                                 {{ $user->role === 'admin'  ? 'bg-rose-50 text-rose-700 border-rose-200'     :
                                    ($user->role === 'ketua' ? 'bg-blue-50 text-blue-700 border-blue-200'     :
                                    'bg-emerald-50 text-emerald-700 border-emerald-200') }}">
                        {{ $user->role }}
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="font-semibold text-sm text-slate-700">
                    Profil Akun
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                                     class="font-semibold text-sm text-red-600 hover:bg-red-50"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar Sistem
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

    </div>
</header>

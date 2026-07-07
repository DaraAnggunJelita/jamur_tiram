@php
    $user = auth()->user();

    // Mapping judul halaman berdasarkan route aktif
    $pageTitle = 'Dashboard';
    if (request()->routeIs('admin.dashboard'))           $pageTitle = 'Antrian Validasi Pasokan';
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

<header class="bg-[#FBF8F1]/80 backdrop-blur-md border-b border-[#C9B896]/40 sticky top-0 z-30 h-16 flex items-center justify-between px-4 sm:px-6 shrink-0 shadow-xs font-sans text-[#26201B]">

    <div class="flex items-center gap-4 min-w-0">

        <button type="button"
                class="md:hidden -ml-1 flex items-center justify-center w-9 h-9 rounded-xl text-[#8E6E4E] hover:text-[#26201B] hover:bg-[#E6DAC2]/40 focus:outline-none transition duration-150 cursor-pointer"
                @click="sidebarOpen = true">
            <span class="sr-only">Buka sidebar</span>
            <svg class="w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="flex items-center gap-2 md:hidden">
            <div class="w-7 h-7 bg-gradient-to-tr from-[#37452F] to-[#4F6146] rounded-lg flex items-center justify-center shadow-xs">
                <span class="text-white font-black text-[10px] font-heading">K</span>
            </div>
            <span class="font-black text-[#26201B] text-xs tracking-tight leading-tight font-heading">KUPS Harapan Asri</span>
        </div>

        <nav class="hidden md:flex items-center gap-1.5 text-xs font-bold min-w-0" aria-label="Breadcrumb">
            <span class="text-[#8E6E4E] truncate font-heading">{{ $roleLabel }}</span>
            <svg class="w-3.5 h-3.5 text-[#C9B896] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-[#26201B] font-black truncate font-heading text-sm">{{ $pageTitle }}</span>
        </nav>

    </div>

    <div class="flex items-center gap-3 shrink-0">

        <div class="hidden sm:flex items-center gap-1.5 bg-[#7C9169]/10 border border-[#7C9169]/30 px-3 py-1.5 rounded-full">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#4F6146] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#4F6146]"></span>
            </span>
            <span class="text-[9px] text-[#37452F] font-black tracking-widest uppercase font-mono-data">Sistem Online</span>
        </div>

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-[#C9B896]/50 text-xs font-bold rounded-xl text-[#362C24] bg-white hover:bg-[#F6F1E6] hover:text-[#26201B] focus:outline-none transition duration-150 shadow-2xs cursor-pointer">
                    <div class="w-6 h-6 rounded-lg font-black text-[9px] flex items-center justify-center uppercase font-mono-data
                                {{ $user->role === 'admin'  ? 'bg-[#A0653D]/20 text-[#A0653D]'    :
                                   ($user->role === 'ketua' ? 'bg-[#C9B896]/30 text-[#6B4E36]'    :
                                   'bg-[#4F6146]/20 text-[#37452F]') }}">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <span class="hidden sm:inline max-w-[120px] truncate font-bold font-heading text-[#26201B]">{{ $user->name }}</span>
                    <span class="text-[8px] font-black px-1.5 py-0.5 rounded-md uppercase border hidden sm:inline-block font-mono-data
                                 {{ $user->role === 'admin'  ? 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20'     :
                                    ($user->role === 'ketua' ? 'bg-[#C9B896]/20 text-[#6B4E36] border-[#C9B896]/40'     :
                                    'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30') }}">
                        {{ $user->role }}
                    </span>
                    <svg class="w-3.5 h-3.5 text-[#8E6E4E] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="font-bold text-sm text-[#362C24] hover:text-[#4F6146] hover:bg-[#F6F1E6]">
                    Profil Akun
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                                     class="font-black text-sm text-[#A0653D] hover:bg-[#A0653D]/10"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar Sistem
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

    </div>
</header>

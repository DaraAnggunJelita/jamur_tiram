@php
    $user = auth()->user();

    // Tentukan route dashboard berdasarkan role
    if ($user->isAdmin()) {
        $dashboardRoute = route('admin.dashboard');
        $isDashboardActive = request()->routeIs('admin.dashboard');
    } elseif ($user->isPetugas()) {
        $dashboardRoute = route('petugas.dashboard');
        $isDashboardActive = request()->routeIs('petugas.dashboard');
    } elseif ($user->isKetua()) {
        $dashboardRoute = route('ketua.dashboard');
        $isDashboardActive = request()->routeIs('ketua.dashboard');
    } else {
        $dashboardRoute = route('dashboard');
        $isDashboardActive = request()->routeIs('dashboard');
    }

    // Hitung laporan pending khusus untuk admin
    $pendingCount = 0;
    if ($user->isAdmin()) {
        $pendingCount = \App\Models\ProductionReport::where('status_validasi', 'pending')->count();
    }
@endphp

<div class="flex flex-col h-full bg-[#26201B] border-r border-[#C9B896]/10">

    <div class="flex items-center gap-3.5 px-5 h-20 border-b border-[#C9B896]/10 shrink-0 bg-[#1F1A16]">
        <div class="w-10 h-10 bg-gradient-to-tr from-[#37452F] via-[#4F6146] to-[#7C9169] rounded-xl flex items-center justify-center shadow-lg shadow-black/40 shrink-0">
            <span class="text-white font-black text-base font-heading tracking-tighter">K</span>
        </div>
        <div class="overflow-hidden">
            <p class="font-black text-sm text-white tracking-tight leading-tight font-heading truncate">KUPS Harapan Asri</p>
            <span class="text-[9px] text-[#7C9169] font-black tracking-[0.2em] uppercase block mt-0.5">
                @if($user->isAdmin()) ADMIN PANEL
                @elseif($user->isPetugas()) PETUGAS KUMBUNG
                @elseif($user->isKetua()) LAPORAN EKSEKUTIF
                @else MEMBER AREA
                @endif
            </span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-7 scrollbar-thin">

        <div>
            <p class="text-[9px] font-black tracking-[0.2em] text-[#C9B896]/50 uppercase px-4 mb-2.5">MENU UTAMA</p>
            <div class="space-y-0.5">
                @include('layouts.sidebar.dashboard')
                @include('layouts.sidebar.baglog')
                @includeWhen($user->isPetugas(), 'layouts.sidebar.laporan_panen')
                @includeWhen($user->isKetua(), 'layouts.sidebar.reports')
                @include('layouts.sidebar.jadwal_panen')
            </div>
        </div>

        @if($user->isAdmin())
        <div>
            <p class="text-[9px] font-black tracking-[0.2em] text-[#C9B896]/50 uppercase px-4 mb-2.5">KELOLA DATA</p>
            <div class="space-y-0.5">
                @include('layouts.sidebar.users')
                @include('layouts.sidebar.catalogs')
            </div>
        </div>
        @endif

        <div>
            <p class="text-[9px] font-black tracking-[0.2em] text-[#C9B896]/50 uppercase px-4 mb-2.5">AKUN</p>
            <div class="space-y-0.5">
                @include('layouts.sidebar.profile')
            </div>
        </div>

    </nav>

    <div class="p-3 border-t border-[#C9B896]/10 shrink-0 bg-[#1F1A16]">
        <div class="flex items-center gap-3 bg-white/5 rounded-2xl p-3 border border-white/5">
            <div class="w-9 h-9 rounded-xl font-black text-xs flex items-center justify-center uppercase shrink-0 font-mono-data
                        {{ $user->role === 'admin'   ? 'bg-[#A0653D]/20 text-[#E6DAC2] ring-1 ring-[#A0653D]/40'   :
                           ($user->role === 'ketua'  ? 'bg-[#8E6E4E]/20 text-[#FBF8F1] ring-1 ring-[#8E6E4E]/40'   :
                           'bg-[#4F6146]/20 text-[#7C9169] ring-1 ring-[#4F6146]/40') }}">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>

            <div class="flex-1 overflow-hidden min-w-0">
                <p class="text-sm font-black text-white leading-tight truncate font-heading">{{ $user->name }}</p>
                <span class="text-[9px] font-black uppercase tracking-widest block mt-0.5
                             {{ $user->role === 'admin'  ? 'text-[#A0653D]'    :
                                ($user->role === 'ketua' ? 'text-[#C9B896]'    :
                                'text-[#7C9169]') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit"
                        title="Keluar Sistem"
                        class="w-8 h-8 flex items-center justify-center rounded-xl text-[#C9B896]/50 hover:text-[#A0653D] hover:bg-[#A0653D]/10 transition duration-150 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

</div>

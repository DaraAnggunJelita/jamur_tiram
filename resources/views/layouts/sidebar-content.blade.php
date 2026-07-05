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

<div class="flex flex-col h-full bg-[#04130b]">

    <!-- === LOGO HEADER === -->
    <div class="flex items-center gap-3.5 px-5 h-20 border-b border-white/5 shrink-0">
        <div class="w-10 h-10 bg-gradient-to-tr from-emerald-500 to-teal-400 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-900/60 shrink-0">
            <span class="text-white font-black text-base font-heading tracking-tighter">H</span>
        </div>
        <div class="overflow-hidden">
            <p class="font-black text-sm text-white tracking-tight leading-tight font-heading truncate">KUPS Harapan Asri</p>
            <span class="text-[9px] text-emerald-400/80 font-black tracking-[0.2em] uppercase block mt-0.5">
                @if($user->isAdmin()) ADMIN PANEL
                @elseif($user->isPetugas()) PETUGAS KUMBUNG
                @elseif($user->isKetua()) LAPORAN EKSEKUTIF
                @else MEMBER AREA
                @endif
            </span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-7">

        <!-- MENU UTAMA -->
        <div>
            <p class="text-[9px] font-black tracking-[0.2em] text-emerald-500/40 uppercase px-4 mb-2.5">MENU UTAMA</p>
            <div class="space-y-0.5">
                @include('layouts.sidebar.dashboard')
                @include('layouts.sidebar.baglog')
                @includeWhen($user->isPetugas(), 'layouts.sidebar.laporan_panen')
                @includeWhen($user->isKetua(), 'layouts.sidebar.reports')
                @include('layouts.sidebar.jadwal_panen')
            </div>
        </div>

        <!-- KELOLA DATA (Hanya Admin) -->
        @if($user->isAdmin())
        <div>
            <p class="text-[9px] font-black tracking-[0.2em] text-emerald-500/40 uppercase px-4 mb-2.5">KELOLA DATA</p>
            <div class="space-y-0.5">
                @include('layouts.sidebar.users')
                @include('layouts.sidebar.catalogs')
            </div>
        </div>
        @endif

        <!-- AKUN -->
        <div>
            <p class="text-[9px] font-black tracking-[0.2em] text-emerald-500/40 uppercase px-4 mb-2.5">AKUN</p>
            <div class="space-y-0.5">
                @include('layouts.sidebar.profile')
            </div>
        </div>

    </nav>

    <!-- === USER INFO & LOGOUT (Bottom) === -->
    <div class="p-3 border-t border-white/5 shrink-0">
        <div class="flex items-center gap-3 bg-white/5 rounded-2xl p-3 border border-white/5">
            <!-- Avatar -->
            <div class="w-9 h-9 rounded-xl font-black text-xs flex items-center justify-center uppercase shrink-0
                        {{ $user->role === 'admin'   ? 'bg-rose-500/20 text-rose-300 ring-1 ring-rose-500/25'   :
                           ($user->role === 'ketua'  ? 'bg-blue-500/20 text-blue-300 ring-1 ring-blue-500/25'   :
                           'bg-emerald-500/20 text-emerald-300 ring-1 ring-emerald-500/25') }}">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>

            <!-- Name + Role -->
            <div class="flex-1 overflow-hidden min-w-0">
                <p class="text-sm font-extrabold text-white leading-tight truncate">{{ $user->name }}</p>
                <span class="text-[9px] font-black uppercase tracking-widest
                             {{ $user->role === 'admin'  ? 'text-rose-400'    :
                                ($user->role === 'ketua' ? 'text-blue-400'    :
                                'text-emerald-400') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit"
                        title="Keluar Sistem"
                        class="w-8 h-8 flex items-center justify-center rounded-xl text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

</div>

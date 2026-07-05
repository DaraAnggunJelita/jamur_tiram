<a href="{{ route('petugas.laporan-panen.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group
          {{ request()->routeIs('petugas.laporan-panen.*') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-900/50' : 'text-slate-400 hover:bg-white/5 hover:text-slate-100' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('petugas.laporan-panen.*') ? 'text-white' : 'text-slate-500 group-hover:text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <span>Laporan Panen</span>
</a>

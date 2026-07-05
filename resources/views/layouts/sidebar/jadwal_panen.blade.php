<a href="{{ route('jadwal-panen.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group
          {{ request()->routeIs('jadwal-panen.*') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-900/50' : 'text-slate-400 hover:bg-white/5 hover:text-slate-100' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('jadwal-panen.*') ? 'text-white' : 'text-slate-500 group-hover:text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    </svg>
    <span>Jadwal Panen</span>
</a>

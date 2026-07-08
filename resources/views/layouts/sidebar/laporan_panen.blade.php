<a href="{{ route('petugas.laporan-panen.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
          {{ request()->routeIs('petugas.laporan-panen.*')
             ? 'bg-[#4F6146] text-[#FBF8F1] shadow-md shadow-black/30'
             : 'text-[#C9B896]/60 hover:bg-white/5 hover:text-white' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('petugas.laporan-panen.*') ? 'text-[#FBF8F1]' : 'text-[#C9B896]/40 group-hover:text-[#7C9169]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <span>Laporan Panen</span>
</a>

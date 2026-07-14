<a href="{{ route('jadwal-panen.index') }}"
 class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
 {{ request()->routeIs('jadwal-panen.*')
 ?'bg-gradient-to-r from-[#E6D5B8] to-[#10B981] text-[#253B29] shadow-md shadow-black/20 font-bold'
 :'text-[#E6D5B8]/70 hover:bg-white/10 hover:text-[#F3F5F4]' }}">
 <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('jadwal-panen.*') ?'text-[#253B29]' :'text-[#E6D5B8]/50 group-hover:text-white' }}"
 fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
 </svg>
 <span>Jadwal Panen</span>
</a>


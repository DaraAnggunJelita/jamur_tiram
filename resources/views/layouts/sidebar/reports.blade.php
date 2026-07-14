<a href="{{ route('ketua.reports.index') }}"
 class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
 {{ request()->routeIs('ketua.reports.*')
 ?'bg-gradient-to-r from-[#E6D5B8] to-[#10B981] text-[#253B29] shadow-md shadow-black/20 font-bold'
 :'text-[#E6D5B8]/70 hover:bg-white/10 hover:text-[#F3F5F4]' }}">
 <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('ketua.reports.*') ?'text-[#253B29]' :'text-[#E6D5B8]/50 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6M9 9V7a2 2 0 012-2h2a2 2 0 012 2v2" />
 </svg>
 <span class="flex-1">Laporan</span>
</a>


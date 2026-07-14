<a href="{{ route('baglog.index') }}"
 class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
 {{ request()->routeIs('baglog.*')
 ?'bg-gradient-to-r from-[#E6D5B8] to-[#10B981] text-[#253B29] shadow-md shadow-black/20 font-bold'
 :'text-[#E6D5B8]/70 hover:bg-white/10 hover:text-[#F3F5F4]' }}">
 <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('baglog.*') ?'text-[#253B29]' :'text-[#E6D5B8]/50 group-hover:text-white' }}"
 fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
 </svg>
 <span>Baglog</span>
</a>


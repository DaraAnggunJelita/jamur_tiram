<a href="{{ route('baglog.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
          {{ request()->routeIs('baglog.*')
             ? 'bg-[#4F6146] text-[#FBF8F1] shadow-md shadow-black/30'
             : 'text-[#C9B896]/60 hover:bg-white/5 hover:text-white' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('baglog.*') ? 'text-[#FBF8F1]' : 'text-[#C9B896]/40 group-hover:text-[#7C9169]' }}"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
    </svg>
    <span>Baglog</span>
</a>

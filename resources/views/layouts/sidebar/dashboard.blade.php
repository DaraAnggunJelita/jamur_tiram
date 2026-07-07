<a href="{{ $dashboardRoute }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
          {{ $isDashboardActive
             ? 'bg-[#4F6146] text-[#FBF8F1] shadow-md shadow-black/30'
             : 'text-[#C9B896]/60 hover:bg-white/5 hover:text-white' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ $isDashboardActive ? 'text-[#FBF8F1]' : 'text-[#C9B896]/40 group-hover:text-[#7C9169]' }}"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
    </svg>
    <span class="flex-1">Dashboard</span>

    @if($user->isAdmin() && $pendingCount > 0)
        <span class="inline-flex items-center bg-[#A0653D] text-[#FBF8F1] text-[9px] font-black px-2 py-0.5 rounded-full animate-pulse shrink-0 font-mono-data">
            {{ $pendingCount }}
        </span>
    @endif
</a>

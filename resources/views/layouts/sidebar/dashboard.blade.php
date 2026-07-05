<a href="{{ $dashboardRoute }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group
          {{ $isDashboardActive
             ? 'bg-emerald-600 text-white shadow-md shadow-emerald-900/50'
             : 'text-slate-400 hover:bg-white/5 hover:text-slate-100' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ $isDashboardActive ? 'text-white' : 'text-slate-500 group-hover:text-emerald-400' }}"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
    </svg>
    <span class="flex-1">Dashboard</span>
    @if($user->isAdmin() && $pendingCount > 0)
        <span class="inline-flex items-center bg-amber-500 text-white text-[9px] font-black px-2 py-0.5 rounded-full animate-pulse shrink-0">
            {{ $pendingCount }}
        </span>
    @endif
</a>

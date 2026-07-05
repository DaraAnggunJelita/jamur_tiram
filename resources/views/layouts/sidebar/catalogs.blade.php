<a href="{{ route('admin.catalogs.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group
          {{ request()->routeIs('admin.catalogs.*')
             ? 'bg-emerald-600 text-white shadow-md shadow-emerald-900/50'
             : 'text-slate-400 hover:bg-white/5 hover:text-slate-100' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('admin.catalogs.*') ? 'text-white' : 'text-slate-500 group-hover:text-emerald-400' }}"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
    </svg>
    <span>Katalog Produk</span>
</a>

<a href="{{ route('admin.users.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
          {{ request()->routeIs('admin.users.*')
             ? 'bg-gradient-to-r from-[#E6D5B8] to-[#DDA15E] text-[#253B29] shadow-md shadow-black/20 font-bold'
             : 'text-[#E6D5B8]/70 hover:bg-white/10 hover:text-[#F6F1E6]' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'text-[#253B29]' : 'text-[#E6D5B8]/50 group-hover:text-white' }}"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
    <span>Kelola Akun</span>
</a>


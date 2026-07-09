<a href="{{ route('profile.edit') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group cursor-pointer
          {{ request()->routeIs('profile.edit')
             ? 'bg-gradient-to-r from-[#E6D5B8] to-[#DDA15E] text-[#253B29] shadow-md shadow-black/20 font-bold'
             : 'text-[#E6D5B8]/70 hover:bg-white/10 hover:text-[#F6F1E6]' }}">
    <svg class="w-[18px] h-[18px] shrink-0 transition-colors duration-200 {{ request()->routeIs('profile.edit') ? 'text-[#253B29]' : 'text-[#E6D5B8]/50 group-hover:text-white' }}"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
    </svg>
    <span>Profil Akun</span>
</a>


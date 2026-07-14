<nav x-data="{ open: false }" class="bg-[#FFFFFF] border-b border-[#E5E7EB]/40 sticky top-0 z-30 shadow-xs backdrop-blur-lg">
 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
 <div class="flex justify-between h-16">
 <div class="flex">
 <div class="shrink-0 flex items-center">
 <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5 group">
 <div class="w-9 h-9 bg-gradient-to-tr from-[#047857] via-[#059669] to-[#34D399] rounded-xl flex items-center justify-center shadow-md shadow-[#059669]/20 group-hover:rotate-6 transition duration-200">
 <span class="text-white font-bold text-base">K</span>
 </div>
 <div class="hidden sm:block">
 <span class="font-bold text-[#064E3B] text-sm leading-tight block">KUPS Harapan Asri</span>
 <span class="text-[9px] text-[#059669] font-bold block">MEMBER AREA</span>
 </div>
 </a>
 </div>

 <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
 <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[#374151] hover:text-[#059669] font-bold">
 {{ __('Dashboard Utama') }}
 </x-nav-link>

 {{-- Navigasi Tambahan Berdasarkan Role --}}
 @if(auth()->user()->isAdmin())
 <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-[#374151] hover:text-[#059669] font-bold">
 {{ __('Kelola Pengguna') }}
 </x-nav-link>
 <x-nav-link :href="route('admin.catalogs.index')" :active="request()->routeIs('admin.catalogs.*')" class="text-[#374151] hover:text-[#059669] font-bold">
 {{ __('Katalog Produk') }}
 </x-nav-link>
 @endif
 </div>
 </div>

 <div class="hidden sm:flex sm:items-center sm:ms-6">
 <x-dropdown align="right" width="48">
 <x-slot name="trigger">
 <button class="inline-flex items-center px-4 py-2 border border-[#E5E7EB]/50 text-sm leading-4 font-bold rounded-xl text-[#374151] bg-[#F3F5F4] hover:bg-[#E6DAC2]/50 hover:text-[#064E3B] focus:outline-none transition ease-in-out duration-150 cursor-pointer">
 <div class="flex items-center space-x-2">
 <div class="w-6 h-6 rounded-full bg-gradient-to-br from-[#047857] to-[#059669] text-white font-bold text-[9px] flex items-center justify-center shadow-xs">
 {{ substr(Auth::user()->name, 0, 2) }}
 </div>
 <span class="font-bold text-xs text-[#064E3B]">{{ Auth::user()->name }}</span>
 <span class="bg-[#E6DAC2] text-[#047857] text-[9px] font-bold px-2 py-0.5 rounded-md border border-[#E5E7EB]/50">{{ Auth::user()->role }}</span>
 </div>

 <div class="ms-2">
 <svg class="fill-current h-4 w-4 text-[#6B7280]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
 <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
 </svg>
 </div>
 </button>
 </x-slot>

 <x-slot name="content">
 <x-dropdown-link :href="route('profile.edit')" class="font-bold text-[#374151] hover:text-[#059669] hover:bg-[#F3F5F4]">
 {{ __('Profil Akun') }}
 </x-dropdown-link>

 <form method="POST" action="{{ route('logout') }}">
 @csrf

 <x-dropdown-link :href="route('logout')" class="font-bold text-[#F59E0B] hover:bg-[#F59E0B]/10"
 onclick="event.preventDefault();
 this.closest('form').submit();">
 {{ __('Keluar Sistem') }}
 </x-dropdown-link>
 </form>
 </x-slot>
 </x-dropdown>
 </div>

 <div class="-me-2 flex items-center sm:hidden">
 <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-[#6B7280] hover:text-[#064E3B] hover:bg-[#E6DAC2]/40 focus:outline-none transition duration-150 ease-in-out">
 <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
 <path :class="{'hidden': open,'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
 <path :class="{'hidden': ! open,'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
 </svg>
 </button>
 </div>
 </div>
 </div>

 <div :class="{'block': open,'hidden': ! open}" class="hidden sm:hidden bg-[#F3F5F4] border-t border-[#E5E7EB]/30">
 <div class="pt-2 pb-3 space-y-1">
 <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold text-[#374151]">
 {{ __('Dashboard Utama') }}
 </x-responsive-nav-link>

 @if(auth()->user()->isAdmin())
 <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="font-bold text-[#374151]">
 {{ __('Kelola Pengguna') }}
 </x-responsive-nav-link>
 <x-responsive-nav-link :href="route('admin.catalogs.index')" :active="request()->routeIs('admin.catalogs.*')" class="font-bold text-[#374151]">
 {{ __('Katalog Produk') }}
 </x-responsive-nav-link>
 @endif
 </div>

 <div class="pt-4 pb-1 border-t border-[#E5E7EB]/40">
 <div class="px-4">
 <div class="font-bold text-base text-[#064E3B]">{{ Auth::user()->name }}</div>
 <div class="font-medium text-sm text-[#6B7280]">{{ Auth::user()->email }}</div>
 </div>

 <div class="mt-3 space-y-1">
 <x-responsive-nav-link :href="route('profile.edit')" class="font-bold text-[#374151]">
 {{ __('Profil Akun') }}
 </x-responsive-nav-link>

 <form method="POST" action="{{ route('logout') }}">
 @csrf

 <x-responsive-nav-link :href="route('logout')" class="text-[#F59E0B] font-bold"
 onclick="event.preventDefault();
 this.closest('form').submit();">
 {{ __('Keluar Sistem') }}
 </x-responsive-nav-link>
 </form>
 </div>
 </div>
 </div>
</nav>

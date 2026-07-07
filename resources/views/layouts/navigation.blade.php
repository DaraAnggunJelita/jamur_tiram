<nav x-data="{ open: false }" class="bg-[#FBF8F1] border-b border-[#C9B896]/40 sticky top-0 z-30 shadow-xs backdrop-blur-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5 group">
                        <div class="w-9 h-9 bg-gradient-to-tr from-[#37452F] via-[#4F6146] to-[#7C9169] rounded-xl flex items-center justify-center shadow-md shadow-[#4F6146]/20 group-hover:rotate-6 transition duration-200">
                            <span class="text-white font-black text-base font-heading">K</span>
                        </div>
                        <div class="hidden sm:block">
                            <span class="font-black text-[#26201B] text-sm tracking-tight leading-tight block font-heading">KUPS Harapan Asri</span>
                            <span class="text-[9px] text-[#4F6146] font-black tracking-widest uppercase block">MEMBER AREA</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[#362C24] hover:text-[#4F6146] font-bold">
                        {{ __('Dashboard Utama') }}
                    </x-nav-link>

                    {{-- Navigasi Tambahan Berdasarkan Role --}}
                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-[#362C24] hover:text-[#4F6146] font-bold">
                            {{ __('Kelola Pengguna') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.catalogs.index')" :active="request()->routeIs('admin.catalogs.*')" class="text-[#362C24] hover:text-[#4F6146] font-bold">
                            {{ __('Katalog Produk') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-[#C9B896]/50 text-sm leading-4 font-bold rounded-xl text-[#362C24] bg-[#F6F1E6] hover:bg-[#E6DAC2]/50 hover:text-[#26201B] focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-[#37452F] to-[#4F6146] text-white font-black text-[9px] flex items-center justify-center uppercase shadow-xs font-mono-data">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                                <span class="font-bold text-xs text-[#26201B] font-heading">{{ Auth::user()->name }}</span>
                                <span class="bg-[#E6DAC2] text-[#6B4E36] text-[9px] font-black px-2 py-0.5 rounded-md uppercase border border-[#C9B896]/50 font-mono-data">{{ Auth::user()->role }}</span>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4 text-[#8E6E4E]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-bold text-[#362C24] hover:text-[#4F6146] hover:bg-[#F6F1E6]">
                            {{ __('Profil Akun') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" class="font-black text-[#A0653D] hover:bg-[#A0653D]/10"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Keluar Sistem') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-[#8E6E4E] hover:text-[#26201B] hover:bg-[#E6DAC2]/40 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#F6F1E6] border-t border-[#C9B896]/30">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold text-[#362C24]">
                {{ __('Dashboard Utama') }}
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="font-bold text-[#362C24]">
                    {{ __('Kelola Pengguna') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.catalogs.index')" :active="request()->routeIs('admin.catalogs.*')" class="font-bold text-[#362C24]">
                    {{ __('Katalog Produk') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-[#C9B896]/40">
            <div class="px-4">
                <div class="font-black text-base text-[#26201B] font-heading">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#8E6E4E] font-mono-data">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="font-bold text-[#362C24]">
                    {{ __('Profil Akun') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="text-[#A0653D] font-black"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Keluar Sistem') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

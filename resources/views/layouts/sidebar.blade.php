{{-- ============================================================
     SIDEBAR WRAPPER
     - Desktop: Fixed, lebar 256px (md) / 288px (lg), selalu visible
     - Mobile : Sliding drawer dikontrol Alpine.js (sidebarOpen)
     ============================================================ --}}

<!-- ======================== DESKTOP SIDEBAR ======================== -->
<aside class="hidden md:flex md:flex-col md:fixed md:inset-y-0 md:left-0 md:w-64 lg:w-72 z-40 shadow-2xl shadow-black/40 border-r border-[#C9B896]/10">
    <div class="flex flex-col h-full overflow-hidden">
        @include('layouts.sidebar-content')
    </div>
</aside>

<!-- ======================== MOBILE SIDEBAR DRAWER ======================== -->
<div x-show="sidebarOpen"
     class="relative z-50 md:hidden"
     role="dialog"
     aria-modal="true"
     x-cloak>

    <!-- Backdrop (Menggunakan warna pekat organik dengan efek blur halus) -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-[#26201B]/80 backdrop-blur-xs"
         @click="sidebarOpen = false">
    </div>

    <!-- Drawer Panel -->
    <div class="fixed inset-y-0 left-0 z-50 flex flex-col w-72 max-w-[85vw]">
        <div x-show="sidebarOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="relative flex-1 flex flex-col w-full h-full bg-[#26201B] shadow-2xl shadow-black/60 border-r border-[#C9B896]/10">

            <!-- Close button (Tombol tutup bergaya rustic modern) -->
            <div class="absolute top-5 right-4 z-50">
                <button type="button"
                        @click="sidebarOpen = false"
                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-[#C9B896] hover:text-white hover:bg-white/10 transition duration-150 cursor-pointer">
                    <span class="sr-only">Tutup sidebar</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar Content -->
            <div class="flex flex-col h-full overflow-y-auto">
                @include('layouts.sidebar-content')
            </div>

        </div>
    </div>
</div>

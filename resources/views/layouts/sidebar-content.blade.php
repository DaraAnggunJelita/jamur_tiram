@php
 $user = auth()->user();

 $dashboardRoute = route('dashboard');
 $isDashboardActive = request()->routeIs('dashboard');
 $pendingCount = 0;

 if ($user) {
 // Tentukan route dashboard berdasarkan role
 if ($user->isAdmin()) {
 $dashboardRoute = route('admin.dashboard');
 $isDashboardActive = request()->routeIs('admin.dashboard');
 $pendingCount = \App\Models\ProductionReport::where('status_validasi','pending')->count();
 } elseif ($user->isPetugas()) {
 $dashboardRoute = route('petugas.dashboard');
 $isDashboardActive = request()->routeIs('petugas.dashboard');
 } elseif ($user->isKetua()) {
 $dashboardRoute = route('ketua.dashboard');
 $isDashboardActive = request()->routeIs('ketua.dashboard');
 }
 }
@endphp

@if($user)
<div class="flex flex-col h-full bg-gradient-to-b from-[#3A5A40] to-[#253B29] border-r border-[#E6D5B8]/20 shadow-xl">

 <div class="flex items-center gap-3.5 px-5 h-20 border-b border-white/10 shrink-0 bg-transparent">
 <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg shrink-0 border border-white/20">
 <span class="text-white font-bold text-base tracking-tighter">K</span>
 </div>
 <div class="flex flex-col overflow-hidden">
 <span class="text-white font-bold text-[15px] leading-tight truncate">
 Harapan Asri
 </span>
 <span class="text-[#E6D5B8]/80 text-[10px] font-bold truncate">
 @if($user->isAdmin()) ADMIN PANEL
 @elseif($user->isPetugas()) PETUGAS KUMBUNG
 @elseif($user->isKetua()) LAPORAN EKSEKUTIF
 @else MEMBER AREA
 @endif
 </span>
 </div>
 </div>

 <nav class="flex-1 overflow-y-auto py-5 px-3 space-y-8 scrollbar-hide">

 {{-- MENU PETUGAS PRODUKSI --}}
 @if($user->isPetugas())
 <div>
 <div class="px-3 mb-3">
 <span class="text-[10px] font-bold text-[#E6D5B8]/60">ALUR LAPANGAN</span>
 </div>
 <div class="space-y-1">
 {{-- Dashboard --}}
 <a href="{{ route('petugas.dashboard') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('petugas.dashboard') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('petugas.dashboard') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
 </div>
 <span class="text-sm font-bold">Dashboard <span class="text-red-400">●</span></span>
 </a>



 {{-- Baglog --}}
 <a href="{{ route('baglog.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('baglog.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->is('baglog*') || request()->routeIs('baglog.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
 </div>
 <span class="text-sm font-bold">Pembuatan Baglog</span>
 </a>

 {{-- Sterilisasi --}}
 <a href="{{ route('sterilisasi.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('sterilisasi.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('sterilisasi.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
 </div>
 <span class="text-sm font-bold">Sterilisasi Baglog</span>
 </a>

 {{-- Inokulasi --}}
 <a href="{{ route('inokulasi.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('inokulasi.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('inokulasi.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
 </div>
 <span class="text-sm font-bold">Data Inokulasi</span>
 </a>

 {{-- Monitoring --}}
 <a href="{{ route('monitoring.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('monitoring.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('monitoring.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
 </div>
 <span class="text-sm font-bold">Monitoring Kumbung</span>
 </a>

 {{-- Pencatatan Panen --}}
 <a href="{{ route('petugas.laporan-panen.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('petugas.laporan-panen.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('petugas.laporan-panen.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
 </div>
 <span class="text-sm font-bold">Pencatatan Panen</span>
 </a>

 {{-- Alokasi Rendang Jamur --}}
 <a href="{{ route('rendang.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('rendang.index') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('rendang.index') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
 </div>
 <span class="text-sm font-bold">Alokasi Rendang Jamur</span>
 </a>
 </div>
 </div>
 @endif

 {{-- MENU KETUA KUPS --}}
 @if($user->isKetua())
 <div>
 <div class="px-3 mb-3">
 <span class="text-[10px] font-bold text-[#E6D5B8]/60">SUPERVISI & LAPORAN</span>
 </div>
 <div class="space-y-1">
 {{-- Dashboard Eksekutif --}}
 <a href="{{ route('ketua.dashboard') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('ketua.dashboard') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('ketua.dashboard') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
 </div>
 <span class="text-sm font-bold">Dashboard Eksekutif</span>
 </a>

 {{-- Pembibitan --}}
 <a href="{{ route('bibit.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('bibit.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('bibit.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
 </div>
 <span class="text-sm font-bold">Data Pembibitan</span>
 </a>

 {{-- Verifikasi Data --}}
 <a href="{{ route('ketua.verifikasi.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('ketua.verifikasi.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('ketua.verifikasi.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
 </div>
 <span class="text-sm font-bold">Verifikasi Data Petugas</span>
 </a>

 {{-- Lacak Investigasi --}}
 <a href="{{ route('ketua.traceability.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('ketua.traceability.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('ketua.traceability.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
 </div>
 <span class="text-sm font-bold">Lacak Investigasi Batch</span>
 </a>

 {{-- Cetak Laporan --}}
 <a href="{{ route('ketua.reports.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('ketua.reports.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('ketua.reports.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
 </div>
 <span class="text-sm font-bold">Cetak Laporan Bulanan</span>
 </a>
 
 </div>
 </div>
 @endif

 {{-- MENU ADMIN --}}
 @if($user->isAdmin())
 <div>
 <div class="px-3 mb-3">
 <span class="text-[10px] font-bold text-[#E6D5B8]/60">ADMIN PANEL</span>
 </div>
 <div class="space-y-1">
 {{-- Kelola Akun --}}
 <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('admin.users.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.users.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
 </div>
 <span class="text-sm font-bold">Kelola Akun Pengguna</span>
 </a>

 {{-- Pantau Stok Bibit --}}
 <a href="{{ route('admin.bibit.pantau') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('admin.bibit.pantau') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.bibit.pantau') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
 </div>
 <span class="text-sm font-bold">Konfirmasi & Pantau Stok</span>
 </a>

 {{-- Pengaturan EWS --}}
 <a href="{{ route('admin.ews.settings') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('admin.ews.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.ews.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
 </div>
 <span class="text-sm font-bold">Pengaturan Batas EWS</span>
 </a>

 {{-- Katalog Produk --}}
 <a href="{{ route('admin.catalogs.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('admin.catalogs.*') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.catalogs.*') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
 </div>
 <span class="text-sm font-bold">Katalog Produk</span>
 </a>
 </div>
 </div>
 @endif

 {{-- PROFIL AKUN (SEMUA ROLE) --}}
 <div>
 <div class="px-3 mb-3 mt-4 border-t border-white/10 pt-6">
 <span class="text-[10px] font-bold text-[#E6D5B8]/60">AKUN</span>
 </div>
 <div class="space-y-1">
 <a href="{{ route('profile.edit') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('profile.edit') ?'bg-[#10B981]/10 text-[#10B981]' :'text-white/80 hover:bg-white/5 hover:text-white' }}">
 <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('profile.edit') ?'bg-[#10B981]/20 text-[#10B981]' :'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
 </div>
 <span class="text-sm font-bold">Profil Pengguna</span>
 </a>
 </div>
 </div>

 </nav>

 <div class="p-3 border-t border-white/10 shrink-0 bg-black/20">
 <div class="flex items-center gap-3 bg-white/5 hover:bg-white/10 transition rounded-2xl p-3 border border-white/10">
 <div class="w-9 h-9 rounded-xl font-bold text-xs flex items-center justify-center shrink-0 bg-[#10B981] text-[#253B29] shadow-inner">
 {{ substr($user->name, 0, 2) }}
 </div>
 <div class="flex flex-col overflow-hidden min-w-0 flex-1">
 <span class="text-sm font-bold text-white truncate font-sans">
 {{ $user->name }}
 </span>
 <span class="text-[10px] font-bold text-[#E6D5B8]/80 truncate">
 {{ $user->role }}
 </span>
 </div>
 
 <form method="POST" action="{{ route('logout') }}" class="shrink-0">
 @csrf
 <button type="submit"
 title="Keluar Sistem"
 class="w-8 h-8 flex items-center justify-center rounded-xl text-[#E6D5B8]/60 hover:text-white hover:bg-red-500/80 transition duration-150 cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
 d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
 </svg>
 </button>
 </form>
 </div>
 </div>
</div>
@endif

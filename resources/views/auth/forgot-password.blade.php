@extends('layouts.auth')

@section('title','Lupa Sandi')

@section('sidebar-title','Pulihkan Akses Akun Anda')
@section('sidebar-description','Masukkan email terdaftar Anda untuk menerima tautan pemulihan kata sandi.')

@section('content')
<div class="w-full max-w-[360px] mx-auto flex flex-col justify-center px-4 py-6">

 <div class="mb-5">
 <h1 class="text-xl font-bold text-slate-900 sm:text-2xl">
 Lupa Kata Sandi?
 </h1>
 <p class="mt-1 text-xs text-slate-400 leading-relaxed font-normal">
 Masukkan alamat email Anda untuk menerima tautan pemulihan sandi baru.
 </p>
 </div>

 <!-- Session Status -->
 <x-auth-session-status class="mb-4" :status="session('status')" />

 <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
 @csrf

 {{-- Email Address --}}
 <div class="group-field">
 <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-500 font-semibold text-[11px] mb-1.5 label-transition" />
 <div class="relative">
 <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400">
 <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
 <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
 </svg>
 </div>
 <input id="email"
 class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-2.5 ps-11 pe-4 text-slate-900 placeholder-slate-300 focus:border-emerald-600 focus:ring-0 focus:bg-white shadow-sm focus:shadow-md transition-all duration-200 text-xs font-medium font-sans"
 type="email"
 name="email"
 value="{{ old('email') }}"
 required
 autofocus
 placeholder="Masukkan email terdaftar" />
 </div>
 <x-input-error :messages="$errors->get('email')" class="mt-1" />
 </div>

 <div class="pt-2">
 <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#0d7844] hover:bg-[#0a5e35] text-white font-semibold py-2.5 px-4 rounded-xl shadow-md active:scale-[0.98] transition-all duration-200 text-xs font-sans">
 <span>Kirim Link Reset</span>
 <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
 <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
 </svg>
 </button>
 </div>
 </form>

 <div class="mt-6 text-center text-[11px] text-slate-400 font-medium font-sans">
 Kembali ke <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-800 transition-colors duration-150">Halaman Masuk</a>
 </div>
</div>
@endsection

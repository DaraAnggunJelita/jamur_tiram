@extends('layouts.auth')

@section('title','Login')

@section('content')
<div class="w-full max-w-[360px] mx-auto flex flex-col px-4 pt-0 pb-4 font-sans">

 <div class="mb-6 text-center flex flex-col items-center">
    <h1 class="text-base font-bold text-[#064E3B] sm:text-lg">
      Selamat Datang Kembali
    </h1>
    <p class="mt-1.5 text-xs text-[#047857] leading-relaxed font-medium">
      Silakan masuk untuk mengelola sistem monitoring produksi jamur tiram Anda.
    </p>
 </div>

 <x-auth-session-status class="mb-4" :status="session('status')" />

 <form method="POST" action="{{ route('login') }}" class="space-y-4">
 @csrf

 <div class="group-field">
 <x-input-label for="email" :value="__('Email atau Username')" class="text-[#047857] font-bold text-[10px] mb-1.5 label-transition" />
 <div class="relative">
 <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-[#E5E7EB] icon-transition">
 <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
 <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
 </svg>
 </div>
 <input id="email"
 class="block w-full rounded-xl border-[#E5E7EB]/50 bg-[#FFFFFF] py-2.5 ps-11 pe-4 text-[#064E3B] placeholder-[#E5E7EB] focus:border-[#059669] focus:ring-0 focus:bg-white shadow-xs focus:shadow-md transition-all duration-200 text-xs font-medium"
 type="email"
 name="email"
 value="{{ old('email') }}"
 required
 autofocus
 placeholder="Masukkan email Anda" />
 </div>
 <x-input-error :messages="$errors->get('email')" class="mt-1" />
 </div>

  <div class="group-field" x-data="{ showPassword: false }">
    <x-input-label for="password" :value="__('Kata Sandi')" class="text-[#047857] font-bold text-[10px] mb-1.5 label-transition" />
    <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-[#E5E7EB] icon-transition">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
      </div>
      <input id="password"
        class="block w-full rounded-xl border-[#E5E7EB]/50 bg-[#FFFFFF] py-2.5 ps-11 pe-11 text-[#064E3B] placeholder-[#E5E7EB] focus:border-[#059669] focus:ring-0 focus:bg-white shadow-xs focus:shadow-md transition-all duration-200 text-xs font-medium"
        :type="showPassword ? 'text' : 'password'"
        type="password"
        name="password"
        required
        placeholder="••••••••" />
      <button type="button" 
        @click="showPassword = !showPassword"
        class="absolute inset-y-0 end-0 flex items-center pe-3.5 text-[#9CA3AF] hover:text-[#047857] focus:outline-none cursor-pointer transition-colors duration-150"
        title="Tampilkan / Sembunyikan Kata Sandi">
        <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        <svg x-show="showPassword" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 013.98-.863c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-4.22-4.22L3 3" />
        </svg>
      </button>
    </div>
    <x-input-error :messages="$errors->get('password')" class="mt-1" />
  </div>

 <div class="pt-2">
 <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#047857] to-[#059669] hover:from-[#064E3B] hover:to-[#047857] text-white font-bold py-3 px-4 rounded-xl shadow-md shadow-[#059669]/10 hover:shadow-lg active:scale-[0.98] transition-all duration-200 text-xs">
 <span>Masuk ke Sistem</span>
 <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
 <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
 </svg>
 </button>
 </div>
 </form>
</div>
@endsection

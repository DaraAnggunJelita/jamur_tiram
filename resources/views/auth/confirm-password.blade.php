@extends('layouts.auth')

@section('title','Konfirmasi Sandi')

@section('sidebar-title','Konfirmasi Akses Keamanan')
@section('sidebar-description','Ini adalah area yang aman. Harap konfirmasikan kata sandi Anda sebelum melanjutkan.')

@section('content')
<div class="w-full max-w-[360px] mx-auto flex flex-col justify-center px-4 py-6">

 <div class="mb-5">
 <h1 class="text-xl font-bold text-slate-900 sm:text-2xl">
 Konfirmasi Kata Sandi
 </h1>
 <p class="mt-1 text-xs text-slate-400 leading-relaxed font-normal font-sans">
 Masukkan kata sandi Anda untuk melanjutkan.
 </p>
 </div>

 <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
 @csrf

 {{-- Password --}}
 <div class="group-field">
 <x-input-label for="password" :value="__('Kata Sandi')" class="text-slate-500 font-semibold text-[11px] mb-1.5 label-transition" />
 <div class="relative">
 <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400">
 <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
 <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
 </svg>
 </div>
 <input id="password"
 class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-2.5 ps-11 pe-4 text-slate-900 placeholder-slate-300 focus:border-emerald-600 focus:ring-0 focus:bg-white shadow-sm focus:shadow-md transition-all duration-200 text-xs font-medium font-sans"
 type="password"
 name="password"
 required
 autocomplete="current-password"
 placeholder="••••••••" />
 </div>
 <x-input-error :messages="$errors->get('password')" class="mt-1" />
 </div>

 <div class="pt-2">
 <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#0d7844] hover:bg-[#0a5e35] text-white font-semibold py-2.5 px-4 rounded-xl shadow-md active:scale-[0.98] transition-all duration-200 text-xs font-sans font-sans">
 <span>Konfirmasi</span>
 <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
 <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
 </svg>
 </button>
 </div>
 </form>
</div>
@endsection

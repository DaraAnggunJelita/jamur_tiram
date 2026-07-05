@extends('layouts.auth')

@section('title', 'Login')

@section('sidebar-title', 'Pantau Pertumbuhan Jamur Secara Digital')

@section('sidebar-description', 'Optimalkan hasil panen dengan pemantauan suhu, kelembaban, dan siklus pertumbuhan secara real-time.')

@section('content')
<div class="w-full max-w-[360px] mx-auto flex flex-col justify-center px-4 py-6">

    <div class="mb-5">
        <h1 class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">
            Selamat Datang Kembali
        </h1>
        <p class="mt-1 text-xs text-slate-400 leading-relaxed">
            Silakan masuk untuk mengelola produksi jamur Anda.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div class="group-field">
            <x-input-label for="email" :value="__('Email atau Username')" class="text-slate-500 font-semibold text-[11px] tracking-wide uppercase mb-1.5 label-transition" />
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400 icon-transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="email"
                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-2.5 ps-11 pe-4 text-slate-900 placeholder-slate-300 focus:border-emerald-600 focus:ring-0 focus:bg-white shadow-sm focus:shadow-md transition-all duration-200 text-xs font-medium"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Masukkan email Anda" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="group-field">
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-slate-500 font-semibold text-[11px] tracking-wide uppercase label-transition" />
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-bold text-emerald-600 hover:text-emerald-800 transition-colors duration-150" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400 icon-transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password"
                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-2.5 ps-11 pe-11 text-slate-900 placeholder-slate-300 focus:border-emerald-600 focus:ring-0 focus:bg-white shadow-sm focus:shadow-md transition-all duration-200 text-xs font-medium"
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••" />
                <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 text-slate-400 cursor-pointer hover:text-slate-600 transition-colors duration-150">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center pt-0.5">
            <label for="remember_me" class="inline-flex items-center text-xs text-slate-500 cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-transparent shadow-sm cursor-pointer transition-transform duration-150 active:scale-90" name="remember">
                <span class="ms-2 text-slate-400 font-medium">Ingat saya untuk 30 hari</span>
            </label>
        </div>

        <div class="pt-1">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#0d7844] hover:bg-[#0a5e35] text-white font-semibold py-2.5 px-4 rounded-xl shadow-md active:scale-[0.98] transition-all duration-200 text-xs tracking-wider uppercase">
                <span>Masuk</span>
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </form>
</div>

@endsection

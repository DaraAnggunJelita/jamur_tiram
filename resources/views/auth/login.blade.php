@extends('layouts.auth')

@section('title', 'Login')

@section('sidebar-title', 'Pantau Pertumbuhan Jamur Secara Digital')

@section('sidebar-description', 'Optimalkan hasil panen dengan pemantauan suhu, kelembaban, dan siklus pertumbuhan secara real-time.')

@section('content')
<div class="w-full max-w-[360px] mx-auto flex flex-col justify-center px-4 py-6 font-sans">

    <div class="mb-6">
        <h1 class="text-2xl font-black tracking-tight text-[#26201B] sm:text-3xl font-heading">
            Selamat Datang Kembali
        </h1>
        <p class="mt-1.5 text-xs text-[#6B4E36] leading-relaxed font-medium">
            Silakan masuk untuk mengelola sistem monitoring produksi jamur tiram Anda.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div class="group-field">
            <x-input-label for="email" :value="__('Email atau Username')" class="text-[#6B4E36] font-bold text-[10px] tracking-widest uppercase mb-1.5 label-transition" />
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-[#C9B896] icon-transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="email"
                    class="block w-full rounded-xl border-[#C9B896]/50 bg-[#FBF8F1] py-2.5 ps-11 pe-4 text-[#26201B] placeholder-[#C9B896] focus:border-[#4F6146] focus:ring-0 focus:bg-white shadow-xs focus:shadow-md transition-all duration-200 text-xs font-medium font-mono-data"
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
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-[#6B4E36] font-bold text-[10px] tracking-widest uppercase label-transition" />
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-black text-[#4F6146] hover:text-[#37452F] transition-colors duration-150" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-[#C9B896] icon-transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password"
                    class="block w-full rounded-xl border-[#C9B896]/50 bg-[#FBF8F1] py-2.5 ps-11 pe-11 text-[#26201B] placeholder-[#C9B896] focus:border-[#4F6146] focus:ring-0 focus:bg-white shadow-xs focus:shadow-md transition-all duration-200 text-xs font-medium font-mono-data"
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••" />
                <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 text-[#C9B896] cursor-pointer hover:text-[#6B4E36] transition-colors duration-150">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center pt-0.5">
            <label for="remember_me" class="inline-flex items-center text-xs text-[#6B4E36] cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="h-3.5 w-3.5 rounded border-[#C9B896] text-[#4F6146] focus:ring-transparent shadow-xs cursor-pointer transition-transform duration-150 active:scale-90" name="remember">
                <span class="ms-2 text-[#8E6E4E] font-medium">Ingat saya untuk 30 hari</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#37452F] to-[#4F6146] hover:from-[#26201B] hover:to-[#37452F] text-white font-black py-3 px-4 rounded-xl shadow-md shadow-[#4F6146]/10 hover:shadow-lg active:scale-[0.98] transition-all duration-200 text-xs tracking-widest uppercase">
                <span>Masuk ke Sistem</span>
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection

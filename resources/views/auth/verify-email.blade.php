@extends('layouts.auth')

@section('title','Verifikasi Email')

@section('sidebar-title','Verifikasikan Email Anda')
@section('sidebar-description','Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasikan alamat email Anda melalui tautan yang baru saja kami kirimkan.')

@section('content')
<div class="w-full max-w-[360px] mx-auto flex flex-col justify-center px-4 py-6 font-sans">

 <div class="mb-5">
 <h1 class="text-xl font-bold text-slate-900 sm:text-2xl">
 Verifikasi Email
 </h1>
 <p class="mt-2 text-xs text-slate-400 leading-relaxed font-normal font-sans">
 Silakan periksa kotak masuk email Anda dan klik tautan verifikasi yang kami kirimkan. Jika tidak menerimanya, kami dengan senang hati akan mengirimkan ulang.
 </p>
 </div>

 @if (session('status') =='verification-link-sent')
 <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-xl text-xs font-bold leading-normal font-sans">
 ✓ Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan.
 </div>
 @endif

 <div class="space-y-4 pt-2">
 <form method="POST" action="{{ route('verification.send') }}">
 @csrf
 <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#0d7844] hover:bg-[#0a5e35] text-white font-semibold py-2.5 px-4 rounded-xl shadow-md active:scale-[0.98] transition-all duration-200 text-xs font-sans">
 <span>Kirim Ulang Email</span>
 <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
 <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
 </svg>
 </button>
 </form>

 <form method="POST" action="{{ route('logout') }}" class="text-center m-0">
 @csrf
 <button type="submit" class="text-xs font-bold text-slate-400 hover:text-red-500 transition-colors duration-150 font-sans">
 Keluar Sistem
 </button>
 </form>
 </div>
</div>
@endsection

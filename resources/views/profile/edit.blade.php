<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Profile') }}
 </h2>
 <span class="bg-[#E6DAC2] text-[#047857] text-xs font-bold px-3 py-1 rounded-full border border-[#E5E7EB]/60">
 Mode Admin
 </span>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- Form Update Informasi Profil --}}
 <div class="p-6 sm:p-8 bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40">
 <div class="max-w-xl font-sans">
 @include('profile.partials.update-profile-information-form')
 </div>
 </div>

 {{-- Form Update Password --}}
 <div class="p-6 sm:p-8 bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40">
 <div class="max-w-xl font-sans">
 @include('profile.partials.update-password-form')
 </div>
 </div>

 {{-- Form Hapus Akun --}}
 <div class="p-6 sm:p-8 bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40">
 <div class="max-w-xl font-sans">
 @include('profile.partials.delete-user-form')
 </div>
 </div>

 </div>
 </div>
</x-app-layout>

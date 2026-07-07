<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Profile') }}
            </h2>
            <span class="bg-[#E6DAC2] text-[#6B4E36] text-xs font-black px-3 py-1 rounded-full border border-[#C9B896]/60 font-mono-data tracking-wide">
                Mode Admin
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Form Update Informasi Profil --}}
            <div class="p-6 sm:p-8 bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40">
                <div class="max-w-xl font-sans">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Form Update Password --}}
            <div class="p-6 sm:p-8 bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40">
                <div class="max-w-xl font-sans">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Form Hapus Akun --}}
            <div class="p-6 sm:p-8 bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40">
                <div class="max-w-xl font-sans">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

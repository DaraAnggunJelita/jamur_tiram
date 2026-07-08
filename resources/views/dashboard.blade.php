<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] overflow-hidden shadow-xs rounded-2xl border border-[#C9B896]/40">
                <div class="p-6 text-[#26201B] font-medium">
                    {{ __("Anda telah berhasil masuk ke sistem!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                    {{ __('Atur Perkiraan Panen') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/40 p-6 sm:p-8 shadow-xs">

                {{-- Header Section Form --}}
                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-8 h-8 bg-[#7C9169]/15 rounded-lg flex items-center justify-center text-[#4F6146] text-lg">
                        <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading">Atur Jadwal Estimasi</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium">Prediksikan tanggal pemetikan jamur tiram berikutnya.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('jadwal-panen.store') }}" class="space-y-5">
                    @csrf

                    {{-- Tanggal Perkiraan Panen --}}
                    <div>
                        <label for="tanggal_estimasi" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1.5">Tanggal Perkiraan Panen</label>
                        <input type="date" id="tanggal_estimasi" name="tanggal_estimasi"
                               min="{{ date('Y-m-d') }}" value="{{ old('tanggal_estimasi') }}" required
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white font-mono-data shadow-2xs focus:border-[#4F6146] focus:ring-0 text-sm py-2.5 text-[#26201B] placeholder-[#C9B896] @error('tanggal_estimasi') border-[#A0653D] focus:border-[#A0653D] @enderror">
                        @error('tanggal_estimasi')
                            <p class="text-[#A0653D] text-xs font-bold mt-1 font-sans">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Catatan Blok / Kumbung --}}
                    <div>
                        <label for="catatan" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1.5">Catatan Blok / Kumbung</label>
                        <textarea id="catatan" name="catatan" rows="4"
                                  placeholder="Misal: Kumbung A blok 2 siap panen raya..."
                                  class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-0 text-sm py-2.5 text-[#26201B] placeholder-[#C9B896]/70 @error('catatan') border-[#A0653D] focus:border-[#A0653D] @enderror">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="text-[#A0653D] text-xs font-bold mt-1 font-sans">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Aksi Tombol Batal & Simpan --}}
                    <div class="pt-4 border-t border-[#C9B896]/20 flex justify-end gap-3">
                        <a href="{{ route('jadwal-panen.index') }}"
                           class="px-5 py-2.5 text-sm font-black text-[#8E6E4E] hover:text-[#26201B] transition cursor-pointer">
                            Batal
                        </a>
                        <button type="submit"
                                class="py-2.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 cursor-pointer">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                    {{ __('Log Kondisi Kumbung') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">

                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-8 h-8 bg-[#4F6146]/10 rounded-lg flex items-center justify-center text-[#4F6146]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Log Kondisi Kumbung Baru</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium">Catat kondisi pertumbuhan baglog dan iklim kumbung hari ini.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('baglog.store') }}" class="space-y-5">
                    @csrf

                    {{-- Tanggal Pengecekan --}}
                    <div>
                        <label for="tanggal" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Tanggal Pengecekan</label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal', date('Y-m-d')) }}" required
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('tanggal') border-[#A0653D] @enderror">
                        @error('tanggal')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Baglog Aktif --}}
                    <div>
                        <label for="jumlah_baglog_aktif" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Jumlah Baglog Aktif</label>
                        <input type="number" id="jumlah_baglog_aktif" name="jumlah_baglog_aktif"
                               placeholder="Contoh: 1500" value="{{ old('jumlah_baglog_aktif') }}" required min="0"
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50 @error('jumlah_baglog_aktif') border-[#A0653D] @enderror">
                        @error('jumlah_baglog_aktif')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kondisi Lingkungan Kumbung --}}
                    <div>
                        <label for="kondisi_kumbung" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Kondisi Lingkungan Kumbung</label>
                        <input type="text" id="kondisi_kumbung" name="kondisi_kumbung"
                               placeholder="Misal: Suhu 24°C, Kelembaban 85%" value="{{ old('kondisi_kumbung') }}" required
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50 @error('kondisi_kumbung') border-[#A0653D] @enderror">
                        @error('kondisi_kumbung')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-[#C9B896]/20 flex justify-end gap-3">
                        <a href="{{ route('baglog.index') }}"
                           class="px-5 py-2.5 text-sm font-bold text-[#8E6E4E] hover:text-[#26201B] transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="py-2.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 cursor-pointer">
                            Kirim Data Log
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

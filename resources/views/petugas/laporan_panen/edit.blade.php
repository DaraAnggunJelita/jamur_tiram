<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                    {{ __('Edit Laporan Hasil Panen') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">

                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-8 h-8 bg-[#6B4E36]/10 rounded-lg flex items-center justify-center text-[#6B4E36]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Modifikasi Laporan Panen</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium">Sesuaikan data berat dan kondisi panen jamur tiram yang Anda input.</p>
                    </div>
                </div>

                <form action="{{ route('petugas.laporan-panen.update', $report->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Tanggal Panen --}}
                    <div>
                        <label for="tanggal" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Tanggal Panen</label>
                        <input type="date" id="tanggal" name="tanggal"
                            max="{{ date('Y-m-d') }}"
                            value="{{ old('tanggal', $report->tanggal) }}"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('tanggal') border-[#A0653D] @enderror" required>
                        @error('tanggal')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Panen --}}
                    <div>
                        <label for="jumlah_panen" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Berat Hasil Panen</label>
                        <div class="relative rounded-xl shadow-2xs">
                            <input type="number" step="0.1" min="0.1" id="jumlah_panen" name="jumlah_panen"
                                placeholder="Contoh: 12.5"
                                value="{{ old('jumlah_panen', $report->jumlah_panen) }}"
                                class="block w-full pr-12 rounded-xl border-[#C9B896]/60 bg-white focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50 @error('jumlah_panen') border-[#A0653D] @enderror" required>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-[#8E6E4E] text-sm font-black font-mono-data">Kg</span>
                            </div>
                        </div>
                        @error('jumlah_panen')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kondisi Jamur --}}
                    <div>
                        <label for="kondisi" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Kondisi Hasil Panen</label>
                        <select id="kondisi" name="kondisi"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('kondisi') border-[#A0653D] @enderror" required>
                            <option value="Bagus" {{ old('kondisi', $report->kondisi) === 'Bagus' ? 'selected' : '' }}>🟢 Bagus — Segar & Berkualitas</option>
                            <option value="Cukup" {{ old('kondisi', $report->kondisi) === 'Cukup' ? 'selected' : '' }}>🟡 Cukup — Sedikit Layu / Kecil</option>
                            <option value="Rusak" {{ old('kondisi', $report->kondisi) === 'Rusak' ? 'selected' : '' }}>🔴 Rusak — Layu / Busuk</option>
                        </select>
                        @error('kondisi')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Catatan Harian --}}
                    <div>
                        <label for="catatan" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Catatan Kumbung <span class="text-[#8E6E4E] font-normal capitalize">(Opsional)</span></label>
                        <textarea id="catatan" name="catatan" rows="4"
                            placeholder="Misal: Suhu kumbung 25°C, kelembaban udara 82%..."
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50 @error('catatan') border-[#A0653D] @enderror">{{ old('catatan', $report->catatan) }}</textarea>
                        @error('catatan')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-[#C9B896]/20 flex justify-end gap-3">
                        <a href="{{ route('petugas.laporan-panen.index') }}"
                            class="px-5 py-2.5 text-sm font-bold text-[#8E6E4E] hover:text-[#26201B] transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="py-2.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

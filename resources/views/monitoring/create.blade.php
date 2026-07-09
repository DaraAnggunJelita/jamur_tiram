<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                    {{ __('Input Monitoring Kumbung') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] shadow-xs sm:rounded-2xl sm:border border-y border-[#C9B896]/40 p-6 sm:p-8">

                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-8 h-8 bg-[#4F6146]/10 rounded-lg flex items-center justify-center text-[#4F6146]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Pemantauan Harian</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium">Catat kondisi lingkungan kumbung secara visual.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('monitoring.store') }}" class="space-y-6">
                    @csrf

                    {{-- Pilihan Inokulasi --}}
                    <div>
                        <label for="inokulasi_id" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Batch Inokulasi</label>
                        <select id="inokulasi_id" name="inokulasi_id"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-3 text-[#362C24] font-bold @error('inokulasi_id') border-[#A0653D] @enderror" required>
                            <option value="">-- Pilih Batch --</option>
                            @foreach($inokulasis as $ino)
                                <option value="{{ $ino->id }}">Inokulasi #{{ $ino->id }} ({{ \Carbon\Carbon::parse($ino->tanggal)->format('d M Y') }})</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label for="tanggal" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Tanggal Pemantauan</label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ date('Y-m-d') }}" required
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-3 text-[#362C24] font-bold">
                    </div>

                    {{-- Kondisi Udara (Touch-Friendly Radio Buttons) --}}
                    <div>
                        <label class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-2">Kondisi Udara</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="kondisi_udara" value="Sejuk" class="peer sr-only" required>
                                <div class="rounded-xl border border-[#C9B896]/60 bg-white p-4 text-center shadow-2xs hover:bg-[#F6F1E6] peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:ring-1 peer-checked:ring-blue-500 transition">
                                    <span class="block text-sm font-bold text-[#362C24]">Sejuk</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="kondisi_udara" value="Hangat" class="peer sr-only">
                                <div class="rounded-xl border border-[#C9B896]/60 bg-white p-4 text-center shadow-2xs hover:bg-[#F6F1E6] peer-checked:border-yellow-500 peer-checked:bg-yellow-50 peer-checked:ring-1 peer-checked:ring-yellow-500 transition">
                                    <span class="block text-sm font-bold text-[#362C24]">Hangat</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="kondisi_udara" value="Panas/Gersang" class="peer sr-only">
                                <div class="rounded-xl border border-[#C9B896]/60 bg-white p-4 text-center shadow-2xs hover:bg-[#F6F1E6] peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:ring-1 peer-checked:ring-red-500 transition">
                                    <span class="block text-sm font-bold text-[#362C24]">Panas/Gersang</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Kondisi Lantai (Touch-Friendly Radio Buttons) --}}
                    <div>
                        <label class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-2">Kondisi Lantai</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="kondisi_lantai" value="Basah/Lembab" class="peer sr-only" required>
                                <div class="rounded-xl border border-[#C9B896]/60 bg-white p-4 text-center shadow-2xs hover:bg-[#F6F1E6] peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:ring-1 peer-checked:ring-blue-500 transition">
                                    <span class="block text-sm font-bold text-[#362C24]">Basah/Lembab</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="kondisi_lantai" value="Kering" class="peer sr-only">
                                <div class="rounded-xl border border-[#C9B896]/60 bg-white p-4 text-center shadow-2xs hover:bg-[#F6F1E6] peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:ring-1 peer-checked:ring-red-500 transition">
                                    <span class="block text-sm font-bold text-[#362C24]">Kering</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Jumlah Penyiraman --}}
                    <div>
                        <label for="jumlah_penyiraman" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Jumlah Penyiraman (Hari Ini)</label>
                        <div class="relative rounded-xl shadow-2xs w-32">
                            <input type="number" id="jumlah_penyiraman" name="jumlah_penyiraman"
                                   value="0" min="0" required
                                   class="block w-full rounded-xl border-[#C9B896]/60 bg-white focus:border-[#4F6146] focus:ring-[#4F6146] text-lg text-center py-3 text-[#362C24] font-black">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-[#8E6E4E] text-xs font-bold font-mono-data">x</span>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-6 border-t border-[#C9B896]/20">
                        <button type="submit"
                                class="w-full py-3.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 cursor-pointer flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Monitoring
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

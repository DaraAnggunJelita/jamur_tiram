<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                    {{ __('Input Batch Baglog Baru') }}
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
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Data Pembuatan Baglog</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium">Catat batch baru baglog dengan relasi sumber bibit.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('baglog.store') }}" class="space-y-5">
                    @csrf

                    {{-- Pilihan Bibit --}}
                    <div>
                        <label for="bibit_id" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Sumber Bibit</label>
                        <select id="bibit_id" name="bibit_id"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('bibit_id') border-[#A0653D] @enderror" required>
                            <option value="">-- Pilih Bibit --</option>
                            @foreach($bibits as $b)
                                <option value="{{ $b->id }}">{{ $b->kode_bibit }} ({{ $b->jumlah }} botol)</option>
                            @endforeach
                        </select>
                        @error('bibit_id')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kode Batch --}}
                    <div>
                        <label for="kode_batch" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Kode Batch</label>
                        <input type="text" id="kode_batch" name="kode_batch"
                               placeholder="Contoh: BATCH-01" value="{{ old('kode_batch') }}" required
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50 @error('kode_batch') border-[#A0653D] @enderror">
                        @error('kode_batch')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Pembuatan --}}
                    <div>
                        <label for="tanggal_pembuatan" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Tanggal Pembuatan</label>
                        <input type="date" id="tanggal_pembuatan" name="tanggal_pembuatan"
                               value="{{ old('tanggal_pembuatan', date('Y-m-d')) }}" required
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('tanggal_pembuatan') border-[#A0653D] @enderror">
                        @error('tanggal_pembuatan')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Baglog --}}
                    <div>
                        <label for="jumlah_baglog" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Jumlah Baglog Dibuat</label>
                        <input type="number" id="jumlah_baglog" name="jumlah_baglog"
                               placeholder="Contoh: 1500" value="{{ old('jumlah_baglog') }}" required min="1"
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50 @error('jumlah_baglog') border-[#A0653D] @enderror">
                        @error('jumlah_baglog')
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
                            Simpan Data Batch
                        </button>
                    </div>
                </form>

            </div>
            
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8 mt-8">
                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-8 h-8 bg-[#A0653D]/10 rounded-lg flex items-center justify-center text-[#A0653D]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Form Input Sterilisasi Baglog</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium">Catat proses pengukusan untuk sterilisasi batch baglog.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('sterilisasi.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="baglog_id" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Pilih Batch Baglog</label>
                        <select id="baglog_id" name="baglog_id"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('baglog_id') border-[#A0653D] @enderror" required>
                            <option value="">-- Pilih Batch Baglog --</option>
                            @foreach($baglogs as $b)
                                <option value="{{ $b->id }}">{{ $b->kode_batch }} (Dibuat: {{ \Carbon\Carbon::parse($b->tanggal_pembuatan)->format('d M Y') }})</option>
                            @endforeach
                        </select>
                        @error('baglog_id')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_sterilisasi" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Tanggal Sterilisasi</label>
                        <input type="date" id="tanggal_sterilisasi" name="tanggal"
                               value="{{ date('Y-m-d') }}" required
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('tanggal') border-[#A0653D] @enderror">
                        @error('tanggal')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="durasi_pengukusan" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Durasi Pengukusan / Sterilisasi (Jam)</label>
                        <input type="number" id="durasi_pengukusan" name="durasi_pengukusan"
                               placeholder="Contoh: 7 atau 8" required min="1"
                               class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50 @error('durasi_pengukusan') border-[#A0653D] @enderror">
                        @error('durasi_pengukusan')
                            <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="kondisi_air" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Kondisi Air Kuali/Drum</label>
                            <select id="kondisi_air" name="kondisi_air"
                                    class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('kondisi_air') border-[#A0653D] @enderror" required>
                                <option value="">-- Pilih Kondisi Air --</option>
                                <option value="Aman">Aman</option>
                                <option value="Menipis">Menipis</option>
                                <option value="Habis">Habis</option>
                            </select>
                            @error('kondisi_air')
                                <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kestabilan_api" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Kestabilan Api Kompor</label>
                            <select id="kestabilan_api" name="kestabilan_api"
                                    class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('kestabilan_api') border-[#A0653D] @enderror" required>
                                <option value="">-- Pilih Kestabilan Api --</option>
                                <option value="Stabil-Besar">Stabil-Besar</option>
                                <option value="Mengecil">Mengecil</option>
                                <option value="Padam">Padam</option>
                            </select>
                            @error('kestabilan_api')
                                <p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#C9B896]/20 flex justify-end gap-3">
                        <button type="submit"
                                class="py-2.5 px-6 bg-[#A0653D] hover:bg-[#8e5a36] text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-md shadow-[#A0653D]/10 transform hover:-translate-y-0.5 cursor-pointer">
                            Simpan Data Sterilisasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

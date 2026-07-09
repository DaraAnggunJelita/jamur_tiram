<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <button onclick="history.back()"
                class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition shadow-xs cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </button>
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Input Sterilisasi Baglog') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">
                <form method="POST" action="{{ route('sterilisasi.store') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="baglog_id" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Batch Baglog</label>
                        <select name="baglog_id" id="baglog_id" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                            <option value="">-- Pilih Batch Baglog --</option>
                            @foreach($baglogs as $b)
                                <option value="{{ $b->id }}">Batch #{{ $b->kode_batch }} ({{ $b->jumlah_baglog }} Pcs)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tanggal" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Tanggal Sterilisasi</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                    </div>
                    <div>
                        <label for="durasi_pengukusan" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Durasi Pengukusan (Jam)</label>
                        <input type="number" name="durasi_pengukusan" id="durasi_pengukusan" min="1" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                    </div>
                    <div>
                        <label for="kondisi_air" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Kondisi Air di Drum</label>
                        <select name="kondisi_air" id="kondisi_air" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                            <option value="Aman">Aman</option>
                            <option value="Menipis">Menipis</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                    <div>
                        <label for="kestabilan_api" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Kestabilan Api</label>
                        <select name="kestabilan_api" id="kestabilan_api" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                            <option value="Stabil-Besar">Stabil-Besar</option>
                            <option value="Mengecil">Mengecil</option>
                            <option value="Padam">Padam</option>
                        </select>
                    </div>
                    
                    <div class="pt-4 border-t border-[#C9B896]/20 flex justify-end">
                        <button type="submit" class="py-2.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-extrabold rounded-xl shadow-md transition">
                            Simpan Sterilisasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

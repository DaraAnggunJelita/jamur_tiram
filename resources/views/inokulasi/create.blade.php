<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <button onclick="history.back()"
                class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition shadow-xs cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </button>
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Input Inokulasi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">
                <form method="POST" action="{{ route('inokulasi.store') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="sterilisasi_id" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Batch Sterilisasi</label>
                        <select name="sterilisasi_id" id="sterilisasi_id" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                            <option value="">-- Pilih Batch Sterilisasi --</option>
                            @foreach($sterilisasis as $s)
                                <option value="{{ $s->id }}">Sterilisasi #{{ $s->id }} (Baglog #{{ $s->baglog->kode_batch ?? 'N/A' }}) - {{ $s->status_sterilisasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tanggal" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Tanggal Inokulasi</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="jumlah_berhasil" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1">Berhasil Tumbuh</label>
                            <input type="number" name="jumlah_berhasil" id="jumlah_berhasil" min="0" value="0" required class="block w-full rounded-xl border-[#C9B896]/60 bg-white py-2.5 shadow-sm focus:border-[#4F6146] focus:ring-[#4F6146]">
                        </div>
                        <div>
                            <label for="jumlah_kontaminasi" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1 text-red-600">Gagal/Kontaminasi</label>
                            <input type="number" name="jumlah_kontaminasi" id="jumlah_kontaminasi" min="0" value="0" required class="block w-full rounded-xl border-red-200 bg-red-50 py-2.5 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                    <div class="pt-4 border-t border-[#C9B896]/20 flex justify-end">
                        <button type="submit" class="py-2.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-extrabold rounded-xl shadow-md transition">
                            Simpan Inokulasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

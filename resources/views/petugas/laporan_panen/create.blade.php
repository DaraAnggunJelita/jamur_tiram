<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                    {{ __('Input Hasil Panen Harian') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">

                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-8 h-8 bg-[#4F6146]/10 rounded-lg flex items-center justify-center text-[#4F6146]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Form Laporan Produksi Baru</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium">Sistem otomatis mendistribusikan panen berdasarkan kualitas.</p>
                    </div>
                </div>

                <form action="{{ route('petugas.laporan-panen.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Inokulasi Batch --}}
                    <div>
                        <label for="inokulasi_id" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Batch Inokulasi</label>
                        <select id="inokulasi_id" name="inokulasi_id"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium @error('inokulasi_id') border-[#A0653D] @enderror" required>
                            <option value="">-- Pilih Batch Inokulasi --</option>
                            @foreach($inokulasis as $ino)
                                <option value="{{ $ino->id }}" {{ old('inokulasi_id') == $ino->id ? 'selected' : '' }}>Inokulasi #{{ $ino->id }} - {{ \Carbon\Carbon::parse($ino->tanggal)->format('d M Y') }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Panen & Jumlah Panen (Grid) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="tanggal" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Tanggal Panen</label>
                            <input type="date" id="tanggal" name="tanggal"
                                max="{{ date('Y-m-d') }}"
                                value="{{ old('tanggal', date('Y-m-d')) }}"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium" required>
                        </div>

                        <div>
                            <label for="jumlah_panen" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Berat Hasil (Kg)</label>
                            <div class="relative rounded-xl shadow-2xs">
                                <input type="number" step="0.1" min="0.1" id="jumlah_panen" name="jumlah_panen"
                                    placeholder="Contoh: 12.5"
                                    value="{{ old('jumlah_panen') }}"
                                    class="block w-full pr-12 rounded-xl border-[#C9B896]/60 bg-white focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-[#8E6E4E] text-sm font-black font-mono-data">Kg</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kualitas Jamur --}}
                    <div>
                        <label for="kualitas_panen" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Klasifikasi Kualitas Panen</label>
                        <select id="kualitas_panen" name="kualitas_panen"
                            onchange="updateSimulasi()"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-3 text-[#362C24] font-bold" required>
                            <option value="">-- Pilih Kualitas Visual --</option>
                            <option value="Kualitas Bagus">Kualitas Bagus (Jamur Segar, Putih, Besar)</option>
                            <option value="Kualitas Cukup">Kualitas Cukup (Ukuran Sedang, Warna Agak Kusam)</option>
                            <option value="Kualitas Buruk/Layu">Kualitas Buruk/Layu (Jamur Patah, Kekuningan/Layu)</option>
                        </select>
                    </div>

                    {{-- Tabel Simulasi Distribusi (Update via JS) --}}
                    <div id="simulasi_box" class="hidden mt-4 p-4 rounded-xl border-2 border-dashed border-[#C9B896] bg-[#F6F1E6]">
                        <h4 class="text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-2">Simulasi Distribusi Otomatis</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm">
                                <span id="simulasi_icon"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z'/></svg></span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#26201B]" id="simulasi_tujuan">Menunggu Input Kualitas</p>
                                <p class="text-xs font-medium text-[#8E6E4E]" id="simulasi_deskripsi">-</p>
                            </div>
                        </div>
                    </div>

                    {{-- Catatan Harian --}}
                    <div>
                        <label for="catatan" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Catatan Tambahan <span class="text-[#8E6E4E] font-normal capitalize">(Opsional)</span></label>
                        <textarea id="catatan" name="catatan" rows="3"
                            placeholder="Ada temuan aneh saat panen?"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="pt-6 border-t border-[#C9B896]/20 flex justify-end gap-3">
                        <a href="{{ route('petugas.laporan-panen.index') }}"
                            class="px-5 py-2.5 text-sm font-bold text-[#8E6E4E] hover:text-[#26201B] transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="py-2.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-extrabold rounded-xl transition shadow-md hover:-translate-y-0.5">
                            Kirim & Distribusikan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function updateSimulasi() {
            const select = document.getElementById('kualitas_panen');
            const box = document.getElementById('simulasi_box');
            const tujuan = document.getElementById('simulasi_tujuan');
            const deskripsi = document.getElementById('simulasi_deskripsi');
            const icon = document.getElementById('simulasi_icon');

            if (select.value) {
                box.classList.remove('hidden');
                
                if (select.value === 'Kualitas Bagus') {
                    tujuan.innerText = 'Siap Jual Segar';
                    tujuan.className = 'text-sm font-black text-green-700';
                    deskripsi.innerText = 'Diarahkan ke pasar Swalayan & Konsumen Langsung.';
                    icon.innerHTML = <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 6h16M4 10h16M4 14h16M4 18h16'/></svg>;
                    box.className = 'mt-4 p-4 rounded-xl border-2 border-green-200 bg-green-50';
                } else if (select.value === 'Kualitas Cukup') {
                    tujuan.innerText = 'Siap Jual Grosir';
                    tujuan.className = 'text-sm font-black text-yellow-700';
                    deskripsi.innerText = 'Diarahkan ke pasar Tradisional / Pengepul.';
                    icon.innerText = '<svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg>';
                    box.className = 'mt-4 p-4 rounded-xl border-2 border-yellow-200 bg-yellow-50';
                } else if (select.value === 'Kualitas Buruk/Layu') {
                    tujuan.innerText = 'Pengolahan Kuliner Rendang';
                    tujuan.className = 'text-sm font-black text-red-700';
                    deskripsi.innerText = 'Diarahkan ke Dapur KUPS untuk diolah menjadi Rendang Jamur (Value Added).';
                    icon.innerHTML = <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'/></svg>;
                    box.className = 'mt-4 p-4 rounded-xl border-2 border-red-200 bg-red-50';
                }
            } else {
                box.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>



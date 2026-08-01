<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <button onclick="history.back()"
                class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </button>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Input Stok Bibit F2 & Alokasi Petugas') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen font-sans text-[#064E3B]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xs rounded-2xl border border-[#E5E7EB]/60 p-6 sm:p-8">
                
                <form method="POST" action="{{ route('bibit.store') }}" class="space-y-6" id="form-bibit">
                    @csrf

                    {{-- 1. BAGIAN JUMLAH BUNGKUS & BANYAK BAGLOG --}}
                    <div class="bg-[#F9FAFB] p-5 rounded-xl border border-[#E5E7EB]">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="jumlah" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">
                                    Jumlah Bungkus Bibit <span class="text-red-500">*</span>
                                </label>
                                <input type="number" step="any" name="jumlah" id="jumlah" min="0.1" value="{{ old('jumlah', 5) }}" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-sm font-bold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]"
                                    placeholder="Contoh: 5">
                                <p class="text-[11px] text-[#6B7280] font-medium mt-1.5">Masukkan total bungkus stok bibit yang akan dialokasikan.</p>
                                @error('jumlah')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="banyak_baglog" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">
                                    Kapasitas Baglog (Otomatis)
                                </label>
                                <div class="relative">
                                    <input type="number" step="any" name="banyak_baglog" id="banyak_baglog" readonly
                                        class="block w-full rounded-xl border-[#E5E7EB] bg-[#F3F4F6] py-2.5 px-3.5 text-sm font-bold text-[#047857] cursor-not-allowed">
                                    <span class="absolute right-3.5 top-2.5 text-xs font-bold text-[#6B7280]">Baglog</span>
                                </div>
                                <p class="text-[11px] text-[#6B7280] font-medium mt-1.5">Kalkulasi otomatis: 1 Bungkus Bibit = 50 Baglog.</p>
                                @error('banyak_baglog')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- 2. PEMBAGIAN KE PETUGAS --}}
                    <div class="border border-[#E5E7EB] rounded-xl p-5 bg-white">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-[#E5E7EB]/60">
                            <div>
                                <h3 class="font-bold text-xs text-[#064E3B] uppercase tracking-wider flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    Pilih Petugas Penerima & Alokasi Stok
                                </h3>
                                <p class="text-[11px] text-[#6B7280] font-medium mt-0.5">Stok bibit akan dibagi secara rata kepada seluruh petugas yang dipilih.</p>
                            </div>
                            <button type="button" onclick="toggleSelectAll()" id="btn-toggle-all"
                                class="text-xs font-semibold px-3 py-1.5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] rounded-lg transition cursor-pointer">
                                Pilih Semua
                            </button>
                        </div>

                        <div class="space-y-2 max-h-60 overflow-y-auto pr-1">
                            @forelse($petugas as $p)
                                <label class="flex items-center justify-between p-3 rounded-xl border border-[#E5E7EB] hover:bg-[#F9FAFB] hover:border-[#059669]/50 cursor-pointer transition select-none group">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" name="user_ids[]" value="{{ $p->id }}"
                                            class="petugas-cb w-4 h-4 text-[#059669] rounded border-[#D1D5DB] focus:ring-[#059669] transition"
                                            checked onchange="recalculateShare()">
                                        <div>
                                            <span class="block text-xs font-bold text-[#1F2937] group-hover:text-[#064E3B]">{{ $p->name }}</span>
                                            <span class="text-[11px] text-[#6B7280] font-medium">{{ $p->email }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="badge-share inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#F3F4F6] text-[#4B5563] transition">
                                            Menghitung...
                                        </span>
                                    </div>
                                </label>
                            @empty
                                <div class="text-center py-4 text-xs text-red-500 font-bold italic">
                                    Belum ada akun ber-role Petugas terdaftar di sistem.
                                </div>
                            @endforelse
                        </div>

                        @error('user_ids')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                    </div>

                    {{-- 3. INFORMASI DETAIL BATCH BIBIT --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="kode_bibit" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Kode Bibit <span class="text-red-500">*</span></label>
                            <input type="text" name="kode_bibit" id="kode_bibit" value="F2" readonly
                                class="block w-full rounded-xl border-[#E5E7EB] bg-[#F3F4F6] py-2.5 px-3.5 text-xs font-bold text-[#047857] cursor-not-allowed uppercase">
                            <p class="text-[11px] text-[#6B7280] font-medium mt-1">Kode bibit F2 standar terikat di sistem.</p>
                            @error('kode_bibit')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="asal_bibit" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Asal Bibit / Produsen <span class="text-red-500">*</span></label>
                            <input type="text" name="asal_bibit" id="asal_bibit" value="{{ old('asal_bibit') }}" required
                                class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]"
                                placeholder="Contoh: Laboratorium IPB / Payakumbuh">
                            @error('asal_bibit')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="tanggal_masuk" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Tanggal Masuk <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required
                            class="block w-full sm:w-1/2 rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                        @error('tanggal_masuk')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-6 border-t border-[#E5E7EB]/60 flex items-center justify-end gap-3">
                        <a href="{{ route('bibit.index') }}" 
                            class="py-2.5 px-5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-xs font-semibold rounded-xl border border-[#D1D5DB] transition cursor-pointer">
                            Batal
                        </a>
                        <button type="submit" 
                            class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl shadow-md transition duration-150 transform hover:-translate-y-0.5 cursor-pointer">
                            Simpan & Alokasikan Stok
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputJumlah = document.getElementById('jumlah');
            inputJumlah.addEventListener('input', recalculateShare);
            recalculateShare();
        });

        function toggleSelectAll() {
            const checkboxes = document.querySelectorAll('.petugas-cb');
            if (checkboxes.length === 0) return;

            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
            });

            const btn = document.getElementById('btn-toggle-all');
            if (!allChecked) {
                btn.innerText = 'Batal Pilih Semua';
            } else {
                btn.innerText = 'Pilih Semua';
            }

            recalculateShare();
        }

        function recalculateShare() {
            const totalBungkus = parseFloat(document.getElementById('jumlah').value) || 0;
            const totalBaglog = totalBungkus * 50;

            document.getElementById('banyak_baglog').value = totalBaglog;

            const checkedBoxes = document.querySelectorAll('.petugas-cb:checked');
            const allBoxLabels = document.querySelectorAll('.petugas-cb');
            const countChecked = checkedBoxes.length;

            allBoxLabels.forEach(cb => {
                const badge = cb.closest('label').querySelector('.badge-share');
                if (!cb.checked) {
                    badge.innerText = 'Tidak Dipilih';
                    badge.className = 'badge-share inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-[#F3F4F6] text-[#9CA3AF] transition';
                } else {
                    if (countChecked > 0 && totalBungkus > 0) {
                        const shareBungkus = (totalBungkus / countChecked).toLocaleString('id-ID', {maximumFractionDigits: 2});
                        const shareBaglog = (totalBaglog / countChecked).toLocaleString('id-ID', {maximumFractionDigits: 1});
                        badge.innerText = `${shareBungkus} Bungkus (${shareBaglog} Baglog)`;
                        badge.className = 'badge-share inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#D1FAE5] text-[#065F46] transition';
                    } else {
                        badge.innerText = `0 Bungkus`;
                        badge.className = 'badge-share inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-amber-100 text-amber-800 transition';
                    }
                }
            });
        }
    </script>
</x-app-layout>

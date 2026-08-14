<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                    {{ __('Input Hasil Panen Harian') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">

                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#E5E7EB]/20">
                    <div class="w-8 h-8 bg-[#059669]/10 rounded-lg flex items-center justify-center text-[#059669]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-[#064E3B]">Form Laporan Produksi Baru</h3>
                        <p class="text-xs text-[#6B7280] font-medium">Sistem otomatis mendistribusikan panen berdasarkan kualitas.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl text-sm font-bold shadow-2xs flex items-start gap-3">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <ul class="list-none m-0 p-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('petugas.laporan-panen.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Real-time Warning Banner (Dipindahkan ke Paling Atas Form) --}}
                    <div id="warning-50-hari" class="hidden p-4 bg-amber-50 border border-amber-300 text-amber-900 rounded-xl text-xs leading-relaxed flex items-start gap-3 shadow-2xs">
                        <div class="w-7 h-7 bg-amber-200/50 rounded-lg flex items-center justify-center text-amber-800 shrink-0 mt-0.5 animate-pulse">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-amber-950 uppercase tracking-wide">Peringatan: Belum Cukup Umur Untuk Dipanen!</h4>
                            <p id="warning-50-hari-text" class="mt-1 font-medium"></p>
                        </div>
                    </div>

                    {{-- Hitung Tanggal Minimal Panen (Inokulasi + 50 Hari) Via Blade --}}
                    @php
                        $selectedIno = null;
                        if(request()->has('inokulasi_id')) {
                            $selectedIno = $inokulasis->firstWhere('id', request('inokulasi_id'));
                        } elseif($inokulasis->isNotEmpty()) {
                            $selectedIno = $inokulasis->first();
                        }

                        // Jika ada batch terpilih, hitung minimal tanggal panen (Inokulasi + 50 Hari)
                        $minPanenDate = $selectedIno
                            ? \Carbon\Carbon::parse($selectedIno->tanggal)->addDays(50)->format('Y-m-d')
                            : date('Y-m-d');
                    @endphp

                    {{-- Inokulasi Batch --}}
                    <div>
                        <label for="inokulasi_id" class="block text-xs font-bold text-[#047857] mb-1.5">Batch Inokulasi (Wajib Inkubasi 100%)</label>
                        <select id="inokulasi_id" name="inokulasi_id"
                        class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium @error('inokulasi_id') border-[#F59E0B] @enderror" required>
                            <option value="">-- Pilih Batch Inokulasi (Miselium 100%) --</option>
                            @foreach($inokulasis as $ino)
                                @php
                                    $rawNama = $ino->user->name ?? 'Petugas';
                                    $namaPetugas = trim(str_replace('(Petugas)', '', $rawNama));
                                    $jenisBibit = ucwords($ino->bibit->asal_bibit ?? $ino->bibit->kode_bibit ?? $ino->sterilisasi->bibit->asal_bibit ?? 'Bibit F2');
                                    $jumlahBaglog = $ino->jumlah_berhasil > 0 ? $ino->jumlah_berhasil : ($ino->sterilisasi->bibit->banyak_baglog ?? 0);
                                    $tglInkubasiTerakhir = \Carbon\Carbon::parse($ino->tanggal)->addDays(40)->format('d M Y');

                                    // Cek progres inkubasi tertinggi
                                    $maxProgres = $ino->logInkubasis->max('persentase_tumbuh') ?? 0;
                                    $isSiapPanen = $maxProgres == 100;
                                @endphp

                                <option value="{{ $ino->id }}"
                                    {{ !$isSiapPanen ? 'disabled' : '' }}
                                    {{ old('inokulasi_id', request('inokulasi_id')) == $ino->id ? 'selected' : '' }}
                                    data-tanggal="{{ $ino->tanggal }}"
                                    data-used-cycles="{{ $ino->productionReports->where('status_validasi', '!=', 'dibatalkan')->pluck('siklus_panen')->implode(',') }}"
                                    class="{{ !$isSiapPanen ? 'bg-gray-100 text-gray-400' : 'text-gray-800 font-semibold' }}">

                                    Inokulasi #{{ $ino->id }} — Progres: {{ $maxProgres }}% {{ !$isSiapPanen ? '[BELUM SIAP PANEN]' : '[SIAP PANEN]' }} | {{ $namaPetugas }} | Bibit: {{ $jenisBibit }} ({{ number_format($jumlahBaglog) }} Baglog)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Siklus Panen & Tanggal Panen (Grid) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="tanggal" class="block text-xs font-bold text-[#047857] mb-1.5">Tanggal Panen</label>

                            <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', $minPanenDate) }}"
                            class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium" required>

                            <p class="text-[10px] text-[#6B7280] mt-1">* Disarankan umur panen mencapai minimal 50 hari sejak inokulasi.</p>
                        </div>
                        <div>
                            <label for="siklus_panen" class="block text-xs font-bold text-[#047857] mb-1.5">Siklus Panen Ke-</label>
                            <select id="siklus_panen" name="siklus_panen"
                            class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium @error('siklus_panen') border-[#F59E0B] @enderror" required>
                                <option value="">-- Pilih Siklus --</option>
                                @for($i = 1; $i <= 7; $i++)
                                    <option value="{{ $i }}" {{ old('siklus_panen') == $i ? 'selected' : '' }}>Panen Ke-{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    {{-- Pemisahan Grade Kualitas --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5 p-5 rounded-xl border-2 border-dashed border-[#E5E7EB] bg-[#F3F5F4]/50">
                        <div>
                            <label for="berat_grade_a" class="block text-xs font-bold text-green-700 mb-1.5">Berat Grade A (Kg)</label>
                            <p class="text-[10px] text-gray-500 mb-2 leading-tight">Jamur segar kualitas bagus untuk dijual langsung.</p>
                            <div class="relative rounded-xl shadow-2xs">
                                <input type="number" step="0.1" min="0" id="berat_grade_a" name="berat_grade_a"
                                placeholder="0"
                                value="{{ old('berat_grade_a', 0) }}"
                                class="block w-full pr-12 rounded-xl border-[#E5E7EB]/60 bg-white focus:border-green-600 focus:ring-green-600 text-sm py-2.5 text-[#374151] font-bold" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-[#6B7280] text-sm font-bold">Kg</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="berat_grade_b" class="block text-xs font-bold text-red-700 mb-1.5">Berat Grade B (Kg)</label>
                            <p class="text-[10px] text-gray-500 mb-2 leading-tight">Jamur layu/patah dialokasikan untuk olahan rendang.</p>
                            <div class="relative rounded-xl shadow-2xs">
                                <input type="number" step="0.1" min="0" id="berat_grade_b" name="berat_grade_b"
                                placeholder="0"
                                value="{{ old('berat_grade_b', 0) }}"
                                class="block w-full rounded-xl pr-12 border-[#E5E7EB]/60 bg-white focus:border-red-600 focus:ring-red-600 text-sm py-2.5 text-[#374151] font-bold" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-[#6B7280] text-sm font-bold">Kg</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Catatan Harian --}}
                    <div class="mt-5">
                        <label for="catatan" class="block text-xs font-bold text-[#047857] mb-1.5">Catatan Tambahan <span class="text-[#6B7280] font-normal capitalize">(Opsional)</span></label>
                        <textarea id="catatan" name="catatan" rows="3"
                        placeholder="Ada temuan aneh saat panen?"
                        class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium placeholder-[#6B7280]/50">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="pt-6 border-t border-[#E5E7EB]/20 flex justify-end gap-3">
                        <a href="{{ route('petugas.laporan-panen.index') }}"
                        class="px-5 py-2.5 text-sm font-bold text-[#6B7280] hover:text-[#064E3B] transition">
                            Batal
                        </a>
                        <button id="btn-simpan" type="submit"
                        class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-sm font-extrabold rounded-xl transition shadow-md hover:-translate-y-0.5">
                            Kirim Data Panen
                        </button>
                    </div>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectEl = document.getElementById('inokulasi_id');
                        const tanggalInput = document.getElementById('tanggal');
                        const warningDiv = document.getElementById('warning-50-hari');
                        const warningText = document.getElementById('warning-50-hari-text');
                        const siklusSelect = document.getElementById('siklus_panen');

                        function checkAge() {
                            let tglInokulasiStr = '';
                            if (selectEl.tagName === 'SELECT') {
                                const selectedOpt = selectEl.options[selectEl.selectedIndex];
                                tglInokulasiStr = selectedOpt ? selectedOpt.getAttribute('data-tanggal') : '';
                            } else {
                                tglInokulasiStr = selectEl.getAttribute('data-tanggal') || '';
                            }

                            const tglPanenStr = tanggalInput.value;

                            if (!tglInokulasiStr || !tglPanenStr) {
                                warningDiv.classList.add('hidden');
                                return;
                            }

                            const tglInokulasi = new Date(tglInokulasiStr + 'T00:00:00');
                            const tglPanen = new Date(tglPanenStr + 'T00:00:00');

                            const timeDiff = tglPanen.getTime() - tglInokulasi.getTime();
                            const diffDays = Math.round(timeDiff / (1000 * 3600 * 24));

                            if (diffDays < 50) {
                                warningText.innerHTML = `Tanggal panen terpilih membuat umur baglog baru mencapai <span class="font-extrabold text-red-600">${diffDays} hari</span> sejak inokulasi (bibit dimasukkan).<br>Harap dicatat: Baglog baru layak dipanen minimal umur <span class="font-extrabold text-red-700">50 hari</span> (40 hari dari inokulasi sampai inkubasi selesai + masa pertumbuhan jamur).`;
                                warningDiv.classList.remove('hidden');
                            } else {
                                warningDiv.classList.add('hidden');
                            }
                        }

                        function updateSiklusOptions() {
                            if (!siklusSelect) return;
                            
                            let usedCyclesStr = '';
                            if (selectEl.tagName === 'SELECT') {
                                const selectedOpt = selectEl.options[selectEl.selectedIndex];
                                usedCyclesStr = selectedOpt ? selectedOpt.getAttribute('data-used-cycles') : '';
                            } else {
                                usedCyclesStr = selectEl.getAttribute('data-used-cycles') || '';
                            }

                            const usedCycles = usedCyclesStr ? usedCyclesStr.split(',').map(Number) : [];
                            const currentSelectedVal = siklusSelect.value;

                            siklusSelect.innerHTML = '<option value="">-- Pilih Siklus --</option>';

                            let availableCount = 0;
                            for (let i = 1; i <= 7; i++) {
                                if (!usedCycles.includes(i)) {
                                    const opt = document.createElement('option');
                                    opt.value = i;
                                    opt.textContent = `Panen Ke-${i}`;
                                    if (currentSelectedVal == i) {
                                        opt.selected = true;
                                    }
                                    siklusSelect.appendChild(opt);
                                    availableCount++;
                                }
                            }

                            if (availableCount === 0) {
                                const opt = document.createElement('option');
                                opt.value = "";
                                opt.disabled = true;
                                opt.textContent = "Semua siklus panen (1-7) sudah tercatat";
                                opt.selected = true;
                                siklusSelect.appendChild(opt);
                            }
                        }

                        if (selectEl) {
                            selectEl.addEventListener('change', function() {
                                checkAge();
                                updateSiklusOptions();
                            });
                            if (tanggalInput) {
                                tanggalInput.addEventListener('change', checkAge);
                                tanggalInput.addEventListener('input', checkAge);
                            }
                            checkAge();
                            updateSiklusOptions();
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>

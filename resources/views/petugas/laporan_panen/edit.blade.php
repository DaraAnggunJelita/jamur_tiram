<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Edit Laporan Hasil Panen') }}
            </h2>
            <a href="{{ route('petugas.laporan-panen.index') }}"
               class="inline-flex items-center px-4 py-2 border border-slate-350 hover:bg-slate-100 text-slate-700 text-xs font-bold uppercase rounded-xl transition duration-150 shadow-sm">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200/60 p-6 sm:p-8 shadow-sm">
                
                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-slate-100">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800">Modifikasi Laporan Panen</h3>
                        <p class="text-xs text-slate-500">Sesuaikan data berat dan kondisi panen jamur tiram yang Anda input.</p>
                    </div>
                </div>

                <form action="{{ route('petugas.laporan-panen.update', $report->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Tanggal Panen --}}
                    <div>
                        <label for="tanggal" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Tanggal Panen</label>
                        <input type="date" id="tanggal" name="tanggal"
                            max="{{ date('Y-m-d') }}"
                            value="{{ old('tanggal', $report->tanggal) }}"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('tanggal') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror" required>
                        @error('tanggal')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Panen --}}
                    <div>
                        <label for="jumlah_panen" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Berat Hasil Panen</label>
                        <div class="relative rounded-xl shadow-sm">
                            <input type="number" step="0.1" min="0.1" id="jumlah_panen" name="jumlah_panen"
                                placeholder="Contoh: 12.5"
                                value="{{ old('jumlah_panen', $report->jumlah_panen) }}"
                                class="block w-full pr-12 rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('jumlah_panen') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror" required>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-slate-400 text-sm font-bold">Kg</span>
                            </div>
                        </div>
                        @error('jumlah_panen')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kondisi Jamur --}}
                    <div>
                        <label for="kondisi" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kondisi Hasil Panen</label>
                        <select id="kondisi" name="kondisi"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('kondisi') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror" required>
                            <option value="Bagus" {{ old('kondisi', $report->kondisi) === 'Bagus' ? 'selected' : '' }}>🟢 Bagus — Segar & Berkualitas</option>
                            <option value="Cukup" {{ old('kondisi', $report->kondisi) === 'Cukup' ? 'selected' : '' }}>🟡 Cukup — Sedikit Layu / Kecil</option>
                            <option value="Rusak" {{ old('kondisi', $report->kondisi) === 'Rusak' ? 'selected' : '' }}>🔴 Rusak — Layu / Busuk</option>
                        </select>
                        @error('kondisi')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Catatan Harian --}}
                    <div>
                        <label for="catatan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Catatan Kumbung <span class="text-slate-400 font-normal capitalize">(Opsional)</span></label>
                        <textarea id="catatan" name="catatan" rows="4"
                            placeholder="Misal: Suhu kumbung 25°C, kelembaban udara 82%..."
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('catatan') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror">{{ old('catatan', $report->catatan) }}</textarea>
                        @error('catatan')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('petugas.laporan-panen.index') }}"
                            class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="py-2.5 px-6 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-sm transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

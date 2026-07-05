<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Log Kondisi Kumbung') }}
            </h2>
            <a href="{{ route('baglog.index') }}"
               class="inline-flex items-center px-4 py-2 border border-slate-350 hover:bg-slate-100 text-slate-700 text-xs font-bold uppercase rounded-xl transition duration-150 shadow-sm">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200/60 p-6 sm:p-8 shadow-sm">
                
                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-slate-100">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800">Log Kondisi Kumbung Baru</h3>
                        <p class="text-xs text-slate-500">Catat kondisi pertumbuhan baglog dan iklim kumbung hari ini.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('baglog.store') }}" class="space-y-5">
                    @csrf

                    {{-- Tanggal Pengecekan --}}
                    <div>
                        <label for="tanggal" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Tanggal Pengecekan</label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal', date('Y-m-d')) }}" required
                               class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('tanggal') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror">
                        @error('tanggal')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Baglog Aktif --}}
                    <div>
                        <label for="jumlah_baglog_aktif" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Jumlah Baglog Aktif</label>
                        <input type="number" id="jumlah_baglog_aktif" name="jumlah_baglog_aktif"
                               placeholder="Contoh: 1500" value="{{ old('jumlah_baglog_aktif') }}" required min="0"
                               class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('jumlah_baglog_aktif') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror">
                        @error('jumlah_baglog_aktif')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kondisi Lingkungan Kumbung --}}
                    <div>
                        <label for="kondisi_kumbung" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kondisi Lingkungan Kumbung</label>
                        <input type="text" id="kondisi_kumbung" name="kondisi_kumbung"
                               placeholder="Misal: Suhu 24°C, Kelembaban 85%" value="{{ old('kondisi_kumbung') }}" required
                               class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('kondisi_kumbung') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror">
                        @error('kondisi_kumbung')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('baglog.index') }}"
                           class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="py-2.5 px-6 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-sm transform hover:-translate-y-0.5">
                            Kirim Data Log
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

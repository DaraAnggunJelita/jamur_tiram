<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Atur Perkiraan Panen') }}
            </h2>
            <a href="{{ route('jadwal-panen.index') }}"
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800">Atur Jadwal Estimasi</h3>
                        <p class="text-xs text-slate-500">Prediksikan tanggal pemetikan jamur tiram berikutnya.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('jadwal-panen.store') }}" class="space-y-5">
                    @csrf

                    {{-- Tanggal Perkiraan Panen --}}
                    <div>
                        <label for="tanggal_estimasi" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Tanggal Perkiraan Panen</label>
                        <input type="date" id="tanggal_estimasi" name="tanggal_estimasi"
                               min="{{ date('Y-m-d') }}" value="{{ old('tanggal_estimasi') }}" required
                               class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('tanggal_estimasi') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror">
                        @error('tanggal_estimasi')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Catatan Blok / Kumbung --}}
                    <div>
                        <label for="catatan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Catatan Blok / Kumbung</label>
                        <textarea id="catatan" name="catatan" rows="4"
                                  placeholder="Misal: Kumbung A blok 2 siap panen raya..."
                                  class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 @error('catatan') border-rose-300 focus:border-rose-550 focus:ring-rose-550 @enderror">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('jadwal-panen.index') }}"
                           class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="py-2.5 px-6 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-sm transform hover:-translate-y-0.5">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

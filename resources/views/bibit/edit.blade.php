<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <button onclick="history.back()" 
                class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </button>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Edit Stok Bibit') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen font-sans text-[#064E3B]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xs rounded-2xl border border-[#E5E7EB]/60 p-6 sm:p-8">
                
                <div class="flex items-center space-x-3 pb-4 mb-6 border-b border-[#E5E7EB]/60">
                    <div class="w-8 h-8 bg-[#D1FAE5] rounded-xl flex items-center justify-center text-[#047857]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#064E3B] uppercase tracking-wider">Formulir Edit Stok Bibit</h3>
                        <p class="text-[11px] text-[#6B7280] font-medium mt-0.5">Ubah data stok bibit jamur tiram (Kode: {{ $bibit->kode_bibit }}).</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('bibit.update', $bibit->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Kode Bibit --}}
                        <div class="md:col-span-2">
                            <label for="kode_bibit" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Kode Bibit</label>
                            <input type="text" id="kode_bibit" name="kode_bibit" 
                                value="F2" readonly 
                                class="block w-full rounded-xl border-[#E5E7EB] bg-[#F3F4F6] py-2.5 px-3.5 text-xs font-bold text-[#047857] cursor-not-allowed uppercase">
                            <p class="text-[11px] text-[#6B7280] font-medium mt-1">Kode bibit F2 terikat standar di sistem.</p>
                            @error('kode_bibit')
                                <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Asal Bibit --}}
                        <div class="md:col-span-2">
                            <label for="asal_bibit" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Asal Bibit / Produsen <span class="text-red-500">*</span></label>
                            <input type="text" id="asal_bibit" name="asal_bibit" 
                                value="{{ old('asal_bibit', $bibit->asal_bibit) }}" required 
                                class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            @error('asal_bibit')
                                <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Petugas Penerima --}}
                        <div class="md:col-span-2">
                            <label for="user_id" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Petugas Penerima Stok Bibit <span class="text-red-500">*</span></label>
                            <select id="user_id" name="user_id" required 
                                class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                                <option value="">-- Pilih Petugas Penerima --</option>
                                @foreach($petugas as $p)
                                    <option value="{{ $p->id }}" {{ old('user_id', $bibit->user_id) == $p->id ? 'selected' : '' }}>
                                        {{ $p->name }} ({{ $p->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Masuk --}}
                        <div>
                            <label for="tanggal_masuk" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Tanggal Masuk <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" 
                                value="{{ old('tanggal_masuk', $bibit->tanggal_masuk) }}" required
                                class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            @error('tanggal_masuk')
                                <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah Bungkus --}}
                        <div>
                            <label for="jumlah" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Jatah Bungkus Petugas <span class="text-red-500">*</span></label>
                            <input type="number" id="jumlah" name="jumlah" min="0.1" step="any"
                                value="{{ old('jumlah', $bibit->jumlah) }}" required 
                                class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-bold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            @error('jumlah')
                                <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#E5E7EB]/60 flex items-center justify-end gap-3">
                        @php
                            $redirectRoute = auth()->user()->role === 'ketua' ? route('ketua.bibit.pantau') : route('bibit.index');
                        @endphp
                        <a href="{{ $redirectRoute }}" 
                            class="py-2.5 px-5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-xs font-semibold rounded-xl border border-[#D1D5DB] transition cursor-pointer">
                            Batal
                        </a>
                        <button type="submit" 
                            class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl shadow-md transition duration-150 transform hover:-translate-y-0.5 cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

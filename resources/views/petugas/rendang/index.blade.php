<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Alokasi Kuliner Rendang Jamur') }}
            </h2>
            <span class="bg-[#A0653D]/10 text-[#A0653D] text-xs font-black px-3 py-1 rounded-full border border-[#A0653D]/30 font-mono-data tracking-wide uppercase">
                Pengolahan Pasca Panen
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu Info --}}
            <div class="bg-gradient-to-r from-[#FBF8F1] to-[#F6F1E6] border border-[#C9B896]/50 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                <div>
                    <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Daftar Jamur Kurang Optimal (Layu / Patah)</h3>
                    <p class="text-xs text-[#8E6E4E] font-medium mt-1">Data ini merupakan hasil sortir otomatis dari Pencatatan Panen untuk diolah menjadi produk bernilai tambah (Value Added Product) berupa Rendang Jamur.</p>
                </div>
                <div class="w-12 h-12 bg-[#A0653D]/10 rounded-xl flex items-center justify-center text-[#A0653D] shadow-inner shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>

            {{-- Tabel Daftar --}}
            <div class="bg-[#FBF8F1] overflow-hidden shadow-xs rounded-2xl border border-[#C9B896]/40">
                <div class="p-6">
                    <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                        <div class="w-8 h-8 bg-[#A0653D]/10 rounded-lg flex items-center justify-center text-[#A0653D]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Riwayat Alokasi Bahan Baku Rendang</h3>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-[#C9B896]/30">
                        <table class="min-w-full divide-y divide-[#C9B896]/20">
                            <thead class="bg-[#F6F1E6]/50">
                                <tr>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Tanggal Masuk</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Petugas Penyetor</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Berat Bahan (Kg)</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Status Tujuan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-[#C9B896]/15 text-[#362C24]">
                                @forelse($panenBuruk as $panen)
                                <tr class="hover:bg-[#F6F1E6]/30 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#26201B] font-mono-data">
                                        {{ \Carbon\Carbon::parse($panen->tanggal)->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#8E6E4E]">
                                        {{ $panen->user->name ?? 'Petugas' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#A0653D] font-mono-data">
                                        {{ number_format($panen->jumlah_panen, 1) }} Kg
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 bg-[#A0653D]/10 text-[#A0653D] text-[10px] font-black rounded-full border border-[#A0653D]/20 uppercase tracking-wider font-mono-data">
                                            {{ $panen->status_distribusi }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="w-12 h-12 bg-[#F6F1E6] border border-[#C9B896]/40 text-[#8E6E4E] rounded-xl flex items-center justify-center mx-auto mb-3 text-xl shadow-2xs">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                        </div>
                                        <p class="text-sm font-black text-[#26201B] font-heading">Belum ada alokasi jamur rendang.</p>
                                        <p class="text-xs text-[#8E6E4E] mt-1 font-medium">Panen dengan kualitas buruk/layu akan otomatis tercatat di sini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

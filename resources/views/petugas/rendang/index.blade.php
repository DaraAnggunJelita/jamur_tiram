<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <a href="{{ route('petugas.dashboard') }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                title="Kembali ke Dashboard">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Alokasi Rendang Jamur') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu Info --}}
            <div class="bg-gradient-to-r from-[#FFFFFF] to-[#F3F5F4] border border-[#E5E7EB]/50 rounded-2xl p-6 shadow-sm flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
                <div>
                    <h3 class="text-xs font-bold text-[#064E3B] uppercase tracking-wider">Daftar Jamur Kurang Optimal (Layu / Patah)</h3>
                    {{-- <p class="text-xs text-[#6B7280] font-medium mt-1">Data ini merupakan hasil sortir otomatis dari Pencatatan Panen untuk diolah menjadi produk bernilai tambah berupa Rendang Jamur.</p> --}}
                </div>
                <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shadow-inner shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>

            <div class="bg-white border border-[#E5E7EB]/60 rounded-2xl p-6 shadow-xs overflow-hidden">

                {{-- Form Filter & Pencarian --}}
                <form method="GET" action="{{ route('rendang.index') }}" class="flex flex-col sm:flex-row items-center gap-3 mb-6">
                    <div class="relative w-full sm:flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#9CA3AF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari berdasarkan nama petugas penyetor..."
                            class="w-full pl-9 pr-3.5 py-2 bg-[#F9FAFB] border border-[#E5E7EB] rounded-xl text-xs font-medium text-[#1F2937] placeholder-[#9CA3AF] focus:bg-white focus:border-[#059669] focus:ring-[#059669]">
                    </div>

                    <div class="w-full sm:w-48">
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="w-full px-3.5 py-2 bg-[#F9FAFB] border border-[#E5E7EB] rounded-xl text-xs font-medium text-[#1F2937] focus:bg-white focus:border-[#059669] focus:ring-[#059669]"
                            onchange="this.form.submit()">
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                        <button type="submit"
                            class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span>Cari</span>
                        </button>
                        @if(request('search') || request('date'))
                        <a href="{{ route('rendang.index') }}"
                            class="inline-flex items-center justify-center p-2 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#4B5563] rounded-xl transition cursor-pointer" title="Reset Filter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </a>
                        @endif
                    </div>
                </form>

                <div class="overflow-x-auto rounded-xl border border-[#E5E7EB]/50">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-[#F9FAFB] border-b border-[#E5E7EB] text-[#4B5563] uppercase tracking-wider text-[11px] font-semibold">
                                <th class="py-2.5 px-4">Tanggal Masuk</th>
                                <th class="py-2.5 px-4">Petugas Penyetor</th>
                                <th class="py-2.5 px-4">Berat Bahan (Kg)</th>
                                <th class="py-2.5 px-4">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E7EB]/50 text-[#374151]">
                            @forelse($panenBuruk as $panen)
                            <tr class="hover:bg-[#F9FAFB] transition duration-150">
                                <td class="py-3 px-4 font-semibold text-[#1F2937] whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($panen->tanggal)->isoFormat('D MMMM Y') }}
                                </td>
                                <td class="py-3 px-4 font-medium text-[#6B7280] whitespace-nowrap">
                                    {{ $panen->user->name ?? 'Petugas' }}
                                </td>
                                <td class="py-3 px-4 font-bold text-amber-700 whitespace-nowrap">
                                    {{ number_format($panen->berat_grade_b, 1) }} <span class="text-[10px] font-normal text-[#6B7280]">Kg</span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-800">
                                        ● Pengolahan Kuliner Rendang
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="w-10 h-10 bg-[#F3F4F6] text-[#9CA3AF] rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                    </div>
                                    <p class="text-xs font-bold text-[#374151]">Belum ada alokasi jamur rendang</p>
                                    <p class="text-xs text-[#6B7280] mt-0.5 font-medium">Panen dengan kualitas buruk/layu akan otomatis tercatat di sini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 pt-4 border-t border-[#E5E7EB]/40 px-2">
                    {{ $panenBuruk->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

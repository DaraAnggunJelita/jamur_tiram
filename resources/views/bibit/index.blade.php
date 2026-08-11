<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                title="Kembali ke Dashboard">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Kelola Distribusi Bibit') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen font-sans text-[#064E3B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
            <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-xs font-semibold shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#059669] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <div class="bg-white border border-[#E5E7EB]/60 rounded-2xl p-6 shadow-xs overflow-hidden">

                {{-- Header Card --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/40">
                    <div>
                        <h2 class="text-base font-bold text-[#064E3B]">Data Pembibitan (Stok F2)</h2>
                        {{-- <p class="text-xs text-[#6B7280] font-medium mt-0.5">Daftar riwayat stok bibit jamur tiram yang masuk ke kelompok usaha.</p> --}}
                    </div>
                    <a href="{{ route('bibit.create') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 cursor-pointer self-start sm:self-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Input Stok Bibit Baru</span>
                    </a>
                </div>

                {{-- Form Filter & Pencarian --}}
                <form method="GET" action="{{ route('bibit.index') }}" class="flex flex-col sm:flex-row items-center gap-3 mb-6">
                    <div class="relative w-full sm:flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#9CA3AF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kode bibit, asal bibit, atau petugas..."
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
                        <a href="{{ route('bibit.index') }}"
                            class="inline-flex items-center justify-center p-2 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#4B5563] rounded-xl transition cursor-pointer" title="Reset Filter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </a>
                        @endif
                    </div>
                </form>

                {{-- Tabel Data --}}
                <div class="overflow-x-auto border border-[#E5E7EB]/60 rounded-xl">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-[#F9FAFB] border-b border-[#E5E7EB] text-[#4B5563] uppercase tracking-wider text-[11px] font-semibold">
                                <th class="py-3 px-4">Tgl Masuk</th>
                                <th class="py-3 px-4">Kode</th>
                                <th class="py-3 px-4">Asal Bibit</th>
                                <th class="py-3 px-4">Petugas Penerima</th>
                                <th class="py-3 px-4 text-center">Jumlah</th>
                                <th class="py-3 px-4 text-center">Kapasitas</th>
                                <th class="py-3 px-4 text-center">Sisa Stok</th>
                                <th class="py-3 px-4 text-center">Status</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E7EB]/50 text-[#374151]">
                            @forelse($bibits as $bibit)
                            <tr class="hover:bg-[#F9FAFB] transition duration-150">
                                <td class="py-3.5 px-4 font-semibold text-[#1F2937] whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($bibit->tanggal_masuk)->isoFormat('D MMM YYYY') }}
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-[#34D399]/15 text-[#047857]">
                                        {{ $bibit->kode_bibit }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 font-medium text-[#4B5563]">
                                    {{ ucwords($bibit->asal_bibit ?? '-') }}
                                </td>
                                <td class="py-3.5 px-4 font-semibold text-[#1F2937]">
                                    {{ $bibit->user->name ?? 'N/A' }}
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-[#059669] whitespace-nowrap">
                                    {{ (float)$bibit->jumlah }} <span class="text-[10px] font-normal text-[#6B7280]">Bungkus</span>
                                </td>
                                <td class="py-3.5 px-4 text-center font-semibold text-[#1F2937] whitespace-nowrap">
                                    {{ (float)($bibit->banyak_baglog ?? ($bibit->jumlah * 50)) }} <span class="text-[10px] font-normal text-[#6B7280]">Baglog</span>
                                </td>
                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <span class="font-bold {{ $bibit->sisa_stok > 0 ? 'text-[#059669]' : 'text-red-500' }}">
                                        {{ (float)$bibit->sisa_stok }}
                                    </span>
                                    <span class="text-[10px] font-normal text-[#6B7280]">Bungkus</span>
                                </td>
                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    @if($bibit->status === 'Aktif/Siap Pakai')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-[#D1FAE5] text-[#065F46]">
                                        ● Aktif / Siap Pakai
                                    </span>
                                    @elseif($bibit->status === 'Pending Konfirmasi Admin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-800">
                                        ● Menunggu Konfirmasi
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-red-100 text-red-700">
                                        ● {{ $bibit->status }}
                                    </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    @if($bibit->sisa_stok == $bibit->jumlah)
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('bibit.edit', $bibit->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-xs font-semibold rounded-lg border border-[#D1D5DB] transition cursor-pointer">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('bibit.destroy', $bibit->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus data bibit ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-lg border border-red-200 transition cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <span class="text-[11px] text-[#9CA3AF] font-medium italic">Terkunci (Terpakai)</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="py-12 text-center text-[#6B7280] font-medium">
                                    <div class="w-10 h-10 bg-[#F3F4F6] text-[#9CA3AF] rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <p class="text-xs font-bold text-[#374151]">Belum ada data stok bibit masuk.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 pt-4 border-t border-[#E5E7EB]/40 px-2">
                    {{ $bibits->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

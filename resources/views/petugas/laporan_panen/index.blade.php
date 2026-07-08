<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Kelola Laporan Hasil Panen') }}
            </h2>
            <span class="bg-[#E6DAC2] text-[#6B4E36] text-xs font-black px-3 py-1 rounded-full border border-[#C9B896]/60 font-mono-data tracking-wide">
                Pencatatan Produksi
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert Notifikasi Sukses --}}
            @if (session('success'))
                <div class="bg-[#7C9169]/10 border-l-4 border-[#4F6146] text-[#37452F] p-4 rounded-r shadow-2xs flex items-center space-x-3 font-sans" role="alert">
                    <svg class="w-5 h-5 text-[#4F6146] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <div>
                        <p class="font-black text-sm font-heading">Berhasil!</p>
                        <p class="text-xs font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-[#A0653D]/10 border-l-4 border-[#A0653D] text-[#A0653D] p-4 rounded-r shadow-2xs flex items-center space-x-3 font-sans" role="alert">
                    <svg class="w-5 h-5 text-[#A0653D] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <div>
                        <p class="font-black text-sm font-heading">Gagal!</p>
                        <p class="text-xs font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            {{-- === TABEL RIWAYAT LAPORAN === --}}
            <div class="bg-[#FBF8F1] overflow-hidden shadow-xs rounded-2xl border border-[#C9B896]/40">
                <div class="p-6">
                    {{-- Header Tabel --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 mb-6 border-b border-[#C9B896]/20">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 bg-[#4F6146]/10 rounded-lg flex items-center justify-center text-[#4F6146]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Semua Riwayat Laporan Panen</h3>
                                <p class="text-xs text-[#8E6E4E] font-medium mt-0.5">Daftar lengkap laporan produksi jamur yang Anda kirimkan.</p>
                            </div>
                        </div>
                        <a href="{{ route('petugas.laporan-panen.create') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Input Hasil Panen
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-[#C9B896]/30">
                        <table class="min-w-full divide-y divide-[#C9B896]/20">
                            <thead class="bg-[#F6F1E6]/50">
                                <tr>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Tanggal</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Berat (Kg)</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Kondisi</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Status Validasi</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Catatan</th>
                                    <th class="px-6 py-3.5 text-center text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-[#C9B896]/15 text-[#362C24]">
                                @forelse ($reports as $report)
                                    <tr class="hover:bg-[#F6F1E6]/30 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#26201B] font-mono-data">
                                            {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#4F6146] font-mono-data">
                                            {{ number_format($report->jumlah_panen, 1) }} Kg
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-black rounded-full border uppercase tracking-wider font-mono-data
                                                {{ $report->kondisi === 'Bagus' ? 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30' :
                                                   ($report->kondisi === 'Cukup' ? 'bg-[#C9B896]/20 text-[#6B4E36] border-[#C9B896]/40' : 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20') }}">
                                                {{ $report->kondisi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($report->status_validasi === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#C9B896]/20 text-[#6B4E36] border border-[#C9B896]/40 animate-pulse font-mono-data">
                                                    ⏳ Menunggu Validasi
                                                </span>
                                            @elseif ($report->status_validasi === 'valid')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#7C9169]/15 text-[#37452F] border border-[#7C9169]/30 font-mono-data">
                                                    ✓ Valid
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#A0653D]/10 text-[#A0653D] border border-[#A0653D]/20 font-mono-data">
                                                    ✕ Invalid
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-[#8E6E4E] max-w-xs truncate font-medium">
                                            {{ $report->catatan ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-xs font-bold">
                                            @if ($report->status_validasi === 'pending')
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('petugas.laporan-panen.edit', $report->id) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-[#E6DAC2]/40 hover:bg-[#E6DAC2]/80 text-[#6B4E36] rounded-lg border border-[#C9B896]/60 transition duration-150">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('petugas.laporan-panen.destroy', $report->id) }}" method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');"
                                                          class="inline-block m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-[#A0653D]/10 hover:bg-[#A0653D] hover:text-white text-[#A0653D] rounded-lg border border-[#A0653D]/30 transition duration-150 cursor-pointer">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-[#C9B896] text-xs italic font-medium">Terkunci</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="w-12 h-12 bg-[#F6F1E6] border border-[#C9B896]/40 text-[#8E6E4E] rounded-xl flex items-center justify-center mx-auto mb-3 text-xl shadow-2xs">
                                                📋
                                            </div>
                                            <p class="text-sm font-black text-[#26201B] font-heading">Belum ada laporan produksi.</p>
                                            <p class="text-xs text-[#8E6E4E] mt-1 font-medium">Klik tombol di atas untuk mulai membuat laporan panen harian baru.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

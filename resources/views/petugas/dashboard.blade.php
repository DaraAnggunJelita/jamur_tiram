<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Dashboard Petugas Harian') }}
            </h2>
            <span class="bg-[#E6DAC2] text-[#6B4E36] text-xs font-black px-3 py-1 rounded-full border border-[#C9B896]/60 font-mono-data tracking-wide">
                Kumbung Jamur
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="bg-[#7C9169]/10 border-l-4 border-[#4F6146] text-[#37452F] p-4 rounded-r shadow-2xs flex items-center space-x-3 font-sans" role="alert">
                    <svg class="w-5 h-5 text-[#4F6146] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <div>
                        <p class="font-black text-sm font-heading">Laporan Terkirim!</p>
                        <p class="text-xs font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- === STATS CARDS === --}}
            @php
                $myTotalHarvest = \App\Models\ProductionReport::where('user_id', auth()->id())->where('status_validasi', 'valid')->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->sum('jumlah_panen');
                $myPendingCount = \App\Models\ProductionReport::where('user_id', auth()->id())->where('status_validasi', 'pending')->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->count();
                $myApprovedCount = \App\Models\ProductionReport::where('user_id', auth()->id())->where('status_validasi', 'valid')->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->count();
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card Total Panen -->
                <div class="bg-[#FBF8F1] rounded-2xl shadow-xs border border-[#C9B896]/40 p-6 flex items-center space-x-4 hover:border-[#7C9169]/40 hover:shadow-md transition duration-200">
                    <div class="p-3.5 rounded-xl bg-[#4F6146]/10 text-[#4F6146] shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-[9px] text-[#8E6E4E] font-black uppercase tracking-widest font-mono-data">Total Hasil Panen Anda (Bulan Ini)</p>
                        <h4 class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ number_format($myTotalHarvest, 1) }} <span class="text-sm font-bold text-[#8E6E4E]">Kg</span></h4>
                    </div>
                </div>

                <!-- Card Laporan Pending -->
                <div class="bg-[#FBF8F1] rounded-2xl shadow-xs border border-[#C9B896]/40 p-6 flex items-center space-x-4 hover:border-[#C9B896]/60 hover:shadow-md transition duration-200">
                    <div class="p-3.5 rounded-xl bg-[#C9B896]/20 text-[#6B4E36] shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[9px] text-[#8E6E4E] font-black uppercase tracking-widest font-mono-data">Laporan Menunggu (Bulan Ini)</p>
                        <h4 class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ $myPendingCount }} <span class="text-sm font-bold text-[#8E6E4E]">Laporan</span></h4>
                    </div>
                </div>

                <!-- Card Laporan Valid -->
                <div class="bg-[#FBF8F1] rounded-2xl shadow-xs border border-[#C9B896]/40 p-6 flex items-center space-x-4 hover:border-[#7C9169]/40 hover:shadow-md transition duration-200">
                    <div class="p-3.5 rounded-xl bg-[#37452F]/10 text-[#37452F] shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[9px] text-[#8E6E4E] font-black uppercase tracking-widest font-mono-data">Laporan Disetujui (Bulan Ini)</p>
                        <h4 class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ $myApprovedCount }} <span class="text-sm font-bold text-[#8E6E4E]">Laporan</span></h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">

                {{-- === TABEL RIWAYAT LAPORAN === --}}
                <div class="bg-[#FBF8F1] overflow-hidden shadow-xs rounded-2xl border border-[#C9B896]/40">
                    <div class="p-6">
                        {{-- Header Tabel --}}
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 mb-6 border-b border-[#C9B896]/20">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-8 h-8 bg-[#4F6146]/10 rounded-lg flex items-center justify-center text-[#4F6146]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                                </div>
                                <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Laporan Panen Bulan Ini</h3>
                            </div>
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
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-[#C9B896]/15 text-[#362C24]">
                                    @forelse ($recentReports as $report)
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
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="w-12 h-12 bg-[#F6F1E6] border border-[#C9B896]/40 text-[#8E6E4E] rounded-xl flex items-center justify-center mx-auto mb-3 text-xl shadow-2xs">
                                                    📋
                                                </div>
                                                <p class="text-sm font-black text-[#26201B] font-heading">Belum ada laporan produksi.</p>
                                                <p class="text-xs text-[#8E6E4E] mt-1 font-medium">Gunakan tombol di atas untuk mulai menginput data panen harian.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- View All Reports Link --}}
                        @if ($recentReports->isNotEmpty())
                            <div class="mt-6 text-center border-t border-[#C9B896]/20 pt-4">
                                <a href="{{ route('petugas.laporan-panen.index') }}" class="inline-flex items-center text-sm font-black text-[#4F6146] hover:text-[#37452F] transition">
                                    Lihat Semua Riwayat Laporan Panen
                                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

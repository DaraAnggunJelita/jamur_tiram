<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
            {{ __('Dashboard Petugas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 1. PUSAT PERINGATAN DINI (EWS) --}}
            @if(isset($peringatanAktif) && $peringatanAktif->count() > 0)
                <div class="bg-red-50 border-l-4 border-red-500 rounded-r-xl shadow-md p-5 mb-6 animate-pulse-slow">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="ml-3 w-full">
                            <h3 class="text-sm font-black text-red-800 uppercase tracking-widest">Pusat Peringatan Dini (EWS) Aktif!</h3>
                            <div class="mt-2 text-sm text-red-700 space-y-2">
                                @foreach($peringatanAktif as $peringatan)
                                    <div class="flex justify-between items-center bg-white/50 p-3 rounded-lg">
                                        <p class="font-semibold">{{ $peringatan->pesan }}</p>
                                        {{-- Tombol Tandai Selesai (Dalam implementasi asli akan men-trigger update ke DB) --}}
                                        <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-md shadow transition">
                                            Selesai Ditindaklanjuti
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-[#7C9169]/10 border border-[#7C9169]/30 rounded-xl p-4 mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#7C9169]/20 flex items-center justify-center text-[#4F6146]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <p class="text-sm font-bold text-[#37452F]">EWS Aman. Tidak ada peringatan kritis di kumbung saat ini.</p>
                </div>
            @endif

            {{-- 2. RINGKASAN STATISTIK & PIE CHART --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Card Stat 1 --}}
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs flex items-center gap-4">
                    <div class="w-12 h-12 bg-[#4F6146]/10 rounded-xl flex items-center justify-center text-[#4F6146]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#8E6E4E] font-black uppercase tracking-widest">Total Panen (Bulan Ini)</p>
                        <p class="text-2xl font-black text-[#26201B]">{{ $recentReports->sum('jumlah_panen') }} <span class="text-sm font-bold text-[#8E6E4E]">Kg</span></p>
                    </div>
                </div>

                {{-- Card Stat 2 --}}
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs flex items-center gap-4">
                    <div class="w-12 h-12 bg-[#A0653D]/10 rounded-xl flex items-center justify-center text-[#A0653D]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#8E6E4E] font-black uppercase tracking-widest">Laporan Aktif</p>
                        <p class="text-2xl font-black text-[#26201B]">{{ $recentReports->count() }} <span class="text-sm font-bold text-[#8E6E4E]">Batch</span></p>
                    </div>
                </div>

                {{-- Card Pie Chart (Statis untuk UI Demo) --}}
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs md:row-span-2">
                    <h3 class="text-sm font-black text-[#6B4E36] uppercase tracking-widest mb-4">Rasio Kualitas Panen</h3>
                    <div class="flex flex-col items-center justify-center h-full pb-4">
                        <div class="relative w-40 h-40 rounded-full border-[16px] border-[#4F6146] shadow-inner flex items-center justify-center" style="border-right-color: #FACC15; border-bottom-color: #EF4444; transform: rotate(45deg);">
                            <div class="w-full h-full rounded-full bg-[#FBF8F1] border-4 border-[#FBF8F1] flex items-center justify-center" style="transform: rotate(-45deg);">
                                <span class="text-xs font-black text-[#8E6E4E] text-center">Bagus<br><span class="text-xl text-[#26201B]">60%</span></span>
                            </div>
                        </div>
                        <div class="mt-6 flex flex-wrap justify-center gap-3">
                            <span class="flex items-center text-xs font-bold text-[#362C24]"><span class="w-3 h-3 bg-[#4F6146] rounded-full mr-1.5"></span>Bagus</span>
                            <span class="flex items-center text-xs font-bold text-[#362C24]"><span class="w-3 h-3 bg-[#FACC15] rounded-full mr-1.5"></span>Cukup</span>
                            <span class="flex items-center text-xs font-bold text-[#362C24]"><span class="w-3 h-3 bg-[#EF4444] rounded-full mr-1.5"></span>Layu</span>
                        </div>
                    </div>
                </div>

                {{-- Tabel Riwayat Laporan Singkat --}}
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs md:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-sm font-black text-[#6B4E36] uppercase tracking-widest">Aktivitas Panen Terbaru</h3>
                        <a href="{{ route('petugas.laporan-panen.index') }}" class="text-xs font-bold text-[#4F6146] hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-[#C9B896]/40 text-[#8E6E4E] text-xs font-black uppercase tracking-widest">
                                    <th class="pb-2">Tanggal</th>
                                    <th class="pb-2">Jumlah</th>
                                    <th class="pb-2">Kualitas</th>
                                    <th class="pb-2 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#C9B896]/20">
                                @forelse($recentReports->take(4) as $report)
                                <tr class="hover:bg-[#F6F1E6]/40 transition">
                                    <td class="py-3 font-bold text-[#362C24]">{{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}</td>
                                    <td class="py-3 font-black text-[#4F6146]">{{ $report->jumlah_panen }} Kg</td>
                                    <td class="py-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black border uppercase tracking-wider
                                            {{ $report->kualitas_panen === 'Kualitas Bagus' ? 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30' : ($report->kualitas_panen === 'Kualitas Cukup' ? 'bg-yellow-100 text-yellow-800 border-yellow-300' : 'bg-red-100 text-red-800 border-red-300') }}">
                                            {{ $report->kualitas_panen }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right">
                                        @if($report->status_validasi === 'valid')
                                            <span class="text-[10px] font-black uppercase tracking-wider text-green-700 bg-green-100 px-2 py-1 rounded-md">Valid</span>
                                            @if($report->kualitas_panen === 'Kualitas Buruk/Layu')
                                                <div class="text-[9px] text-[#A0653D] font-bold mt-1 tracking-tight">→ Rendang</div>
                                            @endif
                                        @elseif($report->status_validasi === 'invalid')
                                            <span class="text-[10px] font-black uppercase tracking-wider text-red-700 bg-red-100 px-2 py-1 rounded-md">Invalid</span>
                                        @else
                                            <span class="text-[10px] font-black uppercase tracking-wider text-yellow-700 bg-yellow-100 px-2 py-1 rounded-md">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-xs text-[#8E6E4E] font-medium italic">Belum ada panen bulan ini.</td>
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

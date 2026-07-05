<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Dashboard Petugas Harian') }}
            </h2>
            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">
                Kumbung Jamur
            </span>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r shadow-sm flex items-center justify-between" role="alert">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <div>
                            <p class="font-extrabold text-sm">Laporan Terkirim!</p>
                            <p class="text-xs">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- === STATS CARDS UNTUK PETUGAS (BULAN INI) === --}}
            @php
                $myTotalHarvest = \App\Models\ProductionReport::where('user_id', auth()->id())->where('status_validasi', 'valid')->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->sum('jumlah_panen');
                $myPendingCount = \App\Models\ProductionReport::where('user_id', auth()->id())->where('status_validasi', 'pending')->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->count();
                $myApprovedCount = \App\Models\ProductionReport::where('user_id', auth()->id())->where('status_validasi', 'valid')->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->count();
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card Total Panen Anda -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/65 p-6 flex items-center space-x-4 hover:shadow-md transition duration-200">
                    <div class="p-3.5 rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Hasil Panen Anda (Bulan Ini)</p>
                        <h4 class="text-2xl font-black text-slate-800 mt-0.5">{{ number_format($myTotalHarvest, 1) }} <span class="text-sm font-bold text-slate-400">Kg</span></h4>
                    </div>
                </div>

                <!-- Card Laporan Pending -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/65 p-6 flex items-center space-x-4 hover:shadow-md transition duration-200">
                    <div class="p-3.5 rounded-xl bg-amber-50 text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Laporan Menunggu (Bulan Ini)</p>
                        <h4 class="text-2xl font-black text-slate-800 mt-0.5">{{ $myPendingCount }} <span class="text-sm font-bold text-slate-400">Laporan</span></h4>
                    </div>
                </div>

                <!-- Card Laporan Valid -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/65 p-6 flex items-center space-x-4 hover:shadow-md transition duration-200">
                    <div class="p-3.5 rounded-xl bg-blue-50 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Laporan Disetujui (Bulan Ini)</p>
                        <h4 class="text-2xl font-black text-slate-800 mt-0.5">{{ $myApprovedCount }} <span class="text-sm font-bold text-slate-400">Laporan</span></h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">

                {{-- === TABEL RIWAYAT LAPORAN === --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/65">
                    <div class="p-6">
                        {{-- Header Tabel --}}
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 mb-6 border-b border-slate-100">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                                </div>
                                <h3 class="text-base font-extrabold text-slate-800 font-heading">Laporan Panen Bulan Ini</h3>
                            </div>
                          
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-slate-100">
                            <table class="min-w-full divide-y divide-slate-150">
                                <thead>
                                    <tr class="bg-slate-50">
                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Berat (Kg)</th>
                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kondisi</th>
                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Validasi</th>
                                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100">
                                    @forelse ($recentReports as $report)
                                        <tr class="hover:bg-slate-50/70 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-800">
                                                {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-slate-900">
                                                {{ number_format($report->jumlah_panen, 1) }} Kg
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full border
                                                    {{ $report->kondisi === 'Bagus' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                                       ($report->kondisi === 'Cukup' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200') }}">
                                                    {{ $report->kondisi }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($report->status_validasi === 'pending')
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                        ⏳ Menunggu Validasi
                                                    </span>
                                                @elseif ($report->status_validasi === 'valid')
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                        ✓ Valid
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                        ✕ Invalid
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                                {{ $report->catatan ?? '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="w-12 h-12 bg-slate-50 border border-slate-200 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                </div>
                                                <p class="text-sm font-extrabold text-slate-700">Belum ada laporan produksi.</p>
                                                <p class="text-xs text-slate-400 mt-1">Gunakan tombol diatas untuk mulai menginput data panen harian.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- View All Reports Link --}}
                        @if ($recentReports->isNotEmpty())
                            <div class="mt-6 text-center border-t border-slate-100 pt-4">
                                <a href="{{ route('petugas.laporan-panen.index') }}" class="inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700 transition">
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

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Dashboard Ketua KUPS') }}
            </h2>
            {{-- <div class="flex items-center space-x-3">
                <a href="{{ route('ketua.reports.export.pdf') }}" class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-white text-sm font-semibold rounded-md hover:opacity-95">Cetak PDF</a>
                <a href="{{ route('ketua.reports.export.excel') }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-sm font-semibold rounded-md hover:opacity-95">Export Excel</a>
                <span class="bg-blue-55 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">Laporan Eksekutif</span>
            </div> --}}
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- === KARTU STATISTIK RINGKASAN === --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card Total Produksi --}}
                <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-3xl shadow-md p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
                    <div class="absolute -right-6 -bottom-6 opacity-10">
                        <svg class="w-36 h-36" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="text-emerald-100 text-xs font-black uppercase tracking-widest">Total Produksi Valid</p>
                    <p class="text-4xl font-black mt-2.5">{{ number_format($totalProduksi, 1) }} <span class="text-2xl font-bold">Kg</span></p>
                    <p class="text-emerald-100/80 text-xs mt-4 font-medium">Akumulasi seluruh panen terverifikasi KUPS.</p>
                </div>

                {{-- Card Rata-rata Panen --}}
                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl shadow-md p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
                    <div class="absolute -right-6 -bottom-6 opacity-10">
                        <svg class="w-36 h-36" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L10 10.586 13.586 7H12z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="text-blue-100 text-xs font-black uppercase tracking-widest">Rata-Rata Panen Harian</p>
                    <p class="text-4xl font-black mt-2.5">{{ number_format($rataRataPanen, 1) }} <span class="text-2xl font-bold">Kg</span></p>
                    <p class="text-blue-100/80 text-xs mt-4 font-medium">Tingkat produktivitas rata-rata harian kumbung.</p>
                </div>

                {{-- Card Total Laporan Valid --}}
                <div class="bg-gradient-to-br from-violet-600 to-purple-700 rounded-3xl shadow-md p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
                    <div class="absolute -right-6 -bottom-6 opacity-10">
                        <svg class="w-36 h-36" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="text-purple-100 text-xs font-black uppercase tracking-widest">Laporan Panen Valid</p>
                    <p class="text-4xl font-black mt-2.5">{{ $totalLaporanValid }} <span class="text-2xl font-bold">Laporan</span></p>
                    <p class="text-purple-100/80 text-xs mt-4 font-medium">Jumlah laporan panen terverifikasi sistem.</p>
                </div>

            </div>

            {{-- === GRAFIK PRODUKSI BULANAN === --}}
            <div class="bg-white shadow-sm rounded-2xl border border-slate-200/60 p-6">
                <div class="pb-4 mb-4 border-b border-slate-100 flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-800">Tren Hasil Produksi Jamur Tiram Bulanan (Kg)</h3>
                </div>
                <div class="relative h-80 w-full">
                    <canvas id="productionChart"></canvas>
                </div>
            </div>

            {{-- === LOG LAPORAN TERBARU === --}}
            <div class="bg-white shadow-sm rounded-2xl border border-slate-200/60 p-6">
                <div class="pb-4 mb-5 border-b border-slate-100 flex items-center space-x-2">
                    <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-800">Aktivitas Laporan Panen Terbaru</h3>
                </div>

                <div class="overflow-x-auto rounded-xl border border-slate-100">
                    <table class="min-w-full divide-y divide-slate-150">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Panen</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Petugas</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Berat Bersih</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kondisi Jamur</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Laporan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse ($recentReports as $report)
                                <tr class="hover:bg-slate-50/70 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-800">
                                        {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2.5">
                                            <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px] flex items-center justify-center uppercase">
                                                {{ substr($report->user->name, 0, 2) }}
                                            </div>
                                            <span class="text-sm font-semibold text-slate-700">{{ $report->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-slate-900">
                                        {{ number_format($report->jumlah_panen, 1) }} Kg
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-full border
                                            {{ $report->kondisi === 'Bagus' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                               ($report->kondisi === 'Cukup' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200') }}">
                                            Kondisi: {{ $report->kondisi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($report->status_validasi === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                ⏳ Menunggu
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="w-12 h-12 bg-slate-50 border border-slate-200 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <p class="text-sm font-extrabold text-slate-700">Belum Ada Riwayat Laporan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js via CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('productionChart').getContext('2d');

            // Background gradient for chart area
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Total Hasil Panen (Kg)',
                        data: {!! json_encode($chartValues) !!},
                        borderColor: '#10b981', // Emerald 500
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.35,
                        fill: true,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2.5,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { weight: 'bold', family: 'Inter', size: 12 },
                                color: '#475569'
                            }
                        },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Berat (Kg)', font: { weight: 'bold', family: 'Inter' }, color: '#475569' },
                            grid: { color: 'rgba(0,0,0,0.04)' },
                            ticks: { font: { family: 'Inter' } }
                        },
                        x: {
                            title: { display: true, text: 'Periode Bulan', font: { weight: 'bold', family: 'Inter' }, color: '#475569' },
                            grid: { display: false },
                            ticks: { font: { family: 'Inter' } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>

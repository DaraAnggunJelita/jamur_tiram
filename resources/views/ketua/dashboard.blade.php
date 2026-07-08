<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Dashboard Ketua KUPS') }}
            </h2>
            <span class="bg-[#E6DAC2] text-[#6B4E36] text-xs font-black px-3 py-1 rounded-full border border-[#C9B896]/60 font-mono-data tracking-wide">
                Laporan Eksekutif
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- === KARTU STATISTIK RINGKASAN === --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card Total Produksi --}}
                <div class="bg-gradient-to-br from-[#26201B] to-[#37452F] rounded-3xl shadow-xl p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
                    <div class="absolute -right-6 -bottom-6 opacity-[0.06]">
                        <span class="text-[8rem]">🍄</span>
                    </div>
                    <p class="text-[#7C9169] text-[9px] font-black uppercase tracking-widest font-mono-data">Total Produksi Valid</p>
                    <p class="text-4xl font-black mt-2.5 font-mono-data">{{ number_format($totalProduksi, 1) }} <span class="text-2xl font-bold text-[#7C9169]">Kg</span></p>
                    <p class="text-[#C9B896]/70 text-xs mt-4 font-medium">Akumulasi seluruh panen terverifikasi KUPS.</p>
                </div>

                {{-- Card Rata-rata Panen --}}
                <div class="bg-gradient-to-br from-[#362C24] to-[#6B4E36] rounded-3xl shadow-xl p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
                    <div class="absolute -right-6 -bottom-6 opacity-[0.06]">
                        <span class="text-[8rem]">📊</span>
                    </div>
                    <p class="text-[#E6DAC2] text-[9px] font-black uppercase tracking-widest font-mono-data">Rata-Rata Panen Harian</p>
                    <p class="text-4xl font-black mt-2.5 font-mono-data">{{ number_format($rataRataPanen, 1) }} <span class="text-2xl font-bold text-[#C9B896]">Kg</span></p>
                    <p class="text-[#C9B896]/70 text-xs mt-4 font-medium">Tingkat produktivitas rata-rata harian kumbung.</p>
                </div>

                {{-- Card Total Laporan Valid --}}
                <div class="bg-gradient-to-br from-[#4F6146] to-[#37452F] rounded-3xl shadow-xl p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
                    <div class="absolute -right-6 -bottom-6 opacity-[0.06]">
                        <span class="text-[8rem]">✅</span>
                    </div>
                    <p class="text-[#E6DAC2] text-[9px] font-black uppercase tracking-widest font-mono-data">Laporan Panen Valid</p>
                    <p class="text-4xl font-black mt-2.5 font-mono-data">{{ $totalLaporanValid }} <span class="text-2xl font-bold text-[#7C9169]">Laporan</span></p>
                    <p class="text-[#C9B896]/70 text-xs mt-4 font-medium">Jumlah laporan panen terverifikasi sistem.</p>
                </div>

            </div>

            {{-- === GRAFIK PRODUKSI BULANAN === --}}
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-6">
                <div class="pb-4 mb-4 border-b border-[#C9B896]/20 flex items-center space-x-2">
                    <div class="w-8 h-8 bg-[#4F6146]/10 rounded-lg flex items-center justify-center text-[#4F6146]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Tren Hasil Produksi Jamur Tiram Bulanan (Kg)</h3>
                </div>
                <div class="relative h-80 w-full">
                    <canvas id="productionChart"></canvas>
                </div>
            </div>

            {{-- === LOG LAPORAN TERBARU === --}}
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-6">
                <div class="pb-4 mb-5 border-b border-[#C9B896]/20 flex items-center space-x-2">
                    <div class="w-8 h-8 bg-[#6B4E36]/10 rounded-lg flex items-center justify-center text-[#6B4E36]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Aktivitas Laporan Panen Terbaru</h3>
                </div>

                <div class="overflow-x-auto rounded-xl border border-[#C9B896]/30">
                    <table class="min-w-full divide-y divide-[#C9B896]/20">
                        <thead class="bg-[#F6F1E6]/50">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Tanggal Panen</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Petugas</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Berat Bersih</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Kondisi Jamur</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Status Laporan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#C9B896]/15 text-[#362C24]">
                            @forelse ($recentReports as $report)
                                <tr class="hover:bg-[#F6F1E6]/30 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#26201B] font-mono-data">
                                        {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2.5">
                                            <div class="w-7 h-7 rounded-full bg-[#4F6146]/15 text-[#37452F] font-black text-[10px] flex items-center justify-center uppercase font-mono-data">
                                                {{ substr($report->user->name, 0, 2) }}
                                            </div>
                                            <span class="text-sm font-bold text-[#362C24]">{{ $report->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#4F6146] font-mono-data">
                                        {{ number_format($report->jumlah_panen, 1) }} Kg
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2.5 py-1 text-[10px] font-black rounded-full border uppercase tracking-wider font-mono-data
                                            {{ $report->kondisi === 'Bagus' ? 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30' :
                                               ($report->kondisi === 'Cukup' ? 'bg-[#C9B896]/20 text-[#6B4E36] border-[#C9B896]/40' : 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20') }}">
                                            Kondisi: {{ $report->kondisi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($report->status_validasi === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#C9B896]/20 text-[#6B4E36] border border-[#C9B896]/40 animate-pulse font-mono-data">
                                                ⏳ Menunggu
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="w-12 h-12 bg-[#F6F1E6] border border-[#C9B896]/40 text-[#8E6E4E] rounded-xl flex items-center justify-center mx-auto mb-3 text-xl shadow-2xs">
                                            📋
                                        </div>
                                        <p class="text-sm font-black text-[#26201B] font-heading">Belum Ada Riwayat Laporan</p>
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

            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(79, 97, 70, 0.25)');
            gradient.addColorStop(1, 'rgba(79, 97, 70, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Total Hasil Panen (Kg)',
                        data: {!! json_encode($chartValues) !!},
                        borderColor: '#4F6146',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.35,
                        fill: true,
                        pointBackgroundColor: '#4F6146',
                        pointBorderColor: '#FBF8F1',
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
                                color: '#6B4E36'
                            }
                        },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Berat (Kg)', font: { weight: 'bold', family: 'Inter' }, color: '#6B4E36' },
                            grid: { color: 'rgba(201,184,150,0.2)' },
                            ticks: { font: { family: 'Inter' }, color: '#6B4E36' }
                        },
                        x: {
                            title: { display: true, text: 'Periode Bulan', font: { weight: 'bold', family: 'Inter' }, color: '#6B4E36' },
                            grid: { display: false },
                            ticks: { font: { family: 'Inter' }, color: '#6B4E36' }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>

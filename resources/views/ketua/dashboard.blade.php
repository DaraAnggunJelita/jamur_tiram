@extends('layouts.app')

@section('content')
<div class="py-6 bg-[#F3F5F4] min-h-screen text-[#374151]">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">

        {{-- === PAGE HEADER === --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-4 rounded-xl border border-gray-200/80 shadow-2xs">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider mb-1 border border-emerald-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Panel Eksekutif KUPS
                </div>
                <h1 class="text-base font-bold text-[#064E3B] tracking-tight">Dashboard Ketua KUPS</h1>
                <p class="text-xs text-gray-500 font-medium">Ringkasan produktivitas, alur produksi baglog, dan validasi pelaporan panen.</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('ketua.reports.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold shadow-xs transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak Laporan
                </a>
                <a href="{{ route('ketua.verifikasi.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold transition duration-150 border border-gray-200">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Verifikasi Data
                </a>
            </div>
        </div>

        {{-- === KARTU STATISTIK RINGKASAN === --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- 1. Total Produksi Berhasil --}}
            <div class="bg-white rounded-xl p-4 border border-gray-200/80 shadow-2xs flex items-center gap-3.5 hover:border-emerald-500/30 transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                </div>
                <div>
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">Produksi Valid</span>
                    <span class="text-xl font-black text-[#064E3B]">{{ number_format($totalProduksi, 1) }} <span class="text-xs font-extrabold text-gray-500">Kg</span></span>
                    <p class="text-[10px] text-emerald-600 font-bold mt-0.5">Panen bagus & cukup</p>
                </div>
            </div>

            {{-- 2. Panen Gagal / Layu --}}
            <div class="bg-white rounded-xl p-4 border border-gray-200/80 shadow-2xs flex items-center gap-3.5 hover:border-amber-500/30 transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 border border-amber-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">Panen Gagal/Layu</span>
                    <span class="text-xl font-black text-gray-800">{{ number_format($totalPanenGagal, 1) }} <span class="text-xs font-extrabold text-gray-500">Kg</span></span>
                    <p class="text-[10px] text-amber-600 font-bold mt-0.5">Panen rusak/dialihkan</p>
                </div>
            </div>

            {{-- 3. Rata-rata Panen --}}
            <div class="bg-white rounded-xl p-4 border border-gray-200/80 shadow-2xs flex items-center gap-3.5 hover:border-blue-500/30 transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">Rata-Rata Harian</span>
                    <span class="text-xl font-black text-gray-800">{{ number_format($rataRataPanen, 1) }} <span class="text-xs font-extrabold text-gray-500">Kg</span></span>
                    <p class="text-[10px] text-blue-600 font-bold mt-0.5">Produktivitas harian</p>
                </div>
            </div>

            {{-- 4. Total Laporan Valid --}}
            <div class="bg-white rounded-xl p-4 border border-gray-200/80 shadow-2xs flex items-center gap-3.5 hover:border-purple-500/30 transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 border border-purple-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">Laporan Valid</span>
                    <span class="text-xl font-black text-[#064E3B]">{{ $totalLaporanValid }} <span class="text-xs font-extrabold text-gray-500">Entri</span></span>
                    <p class="text-[10px] text-purple-600 font-bold mt-0.5">Total entri terverifikasi</p>
                </div>
            </div>
        </div>

        {{-- === STATUS ALUR PRODUKSI BAGLOG (PIPELINE) === --}}
        <div class="bg-white rounded-xl border border-gray-200/80 p-4 shadow-2xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 mb-3 border-b border-gray-100 gap-1">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <h3 class="text-xs font-black text-[#064E3B] uppercase tracking-wider">Status Alur Produksi Baglog (Pipeline)</h3>
                </div>
                <span class="text-[11px] text-gray-400 font-semibold">Pantau pergerakan stok dari mentah hingga siap panen di kubung</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                {{-- 1: Stok Mentah --}}
                <div class="p-3 rounded-xl bg-gray-50 border border-gray-200/60 flex flex-col justify-between hover:bg-gray-100/60 transition duration-150">
                    <div>
                        <span class="text-[10px] font-extrabold text-gray-500 uppercase tracking-wide block">1. Stok Mentah</span>
                        <span class="text-lg font-black text-gray-800 mt-1 block">{{ $pipelineStokBaglog }} <span class="text-[11px] font-semibold text-gray-500">Bungkus</span></span>
                    </div>
                    <span class="text-[10px] text-gray-400 mt-2 block font-medium">Belum diserilisasi</span>
                </div>

                {{-- 2: Pendinginan --}}
                <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-200/70 flex flex-col justify-between hover:bg-amber-100/60 transition duration-150">
                    <div>
                        <span class="text-[10px] font-extrabold text-amber-700 uppercase tracking-wide block">2. Pendinginan</span>
                        <span class="text-lg font-black text-amber-900 mt-1 block">{{ $pipelinePendinginan }} <span class="text-[11px] font-semibold text-amber-700">Batch</span></span>
                    </div>
                    <span class="text-[10px] text-amber-700 mt-2 font-bold block">⏳ Masih proses diam</span>
                </div>

                {{-- 3: Siap Inokulasi --}}
                <div class="p-3 rounded-xl bg-blue-50/70 border border-blue-200/70 flex flex-col justify-between hover:bg-blue-100/60 transition duration-150">
                    <div>
                        <span class="text-[10px] font-extrabold text-blue-700 uppercase tracking-wide block">3. Siap Inokulasi</span>
                        <span class="text-lg font-black text-blue-900 mt-1 block">{{ $pipelineSiapInokulasi }} <span class="text-[11px] font-semibold text-blue-700">Batch</span></span>
                    </div>
                    <span class="text-[10px] text-blue-600 mt-2 block font-bold">✓ Siap suntik bibit</span>
                </div>

                {{-- 4: Masa Inkubasi --}}
                <div class="p-3 rounded-xl bg-indigo-50/70 border border-indigo-200/70 flex flex-col justify-between hover:bg-indigo-100/60 transition duration-150">
                    <div>
                        <span class="text-[10px] font-extrabold text-indigo-700 uppercase tracking-wide block">4. Masa Inkubasi</span>
                        <span class="text-lg font-black text-indigo-900 mt-1 block">{{ $pipelineInkubasi }} <span class="text-[11px] font-semibold text-indigo-700">Batch</span></span>
                    </div>
                    <span class="text-[10px] text-indigo-600 mt-2 block font-bold">🔍 Dalam pemantauan</span>
                </div>

                {{-- 5: Siap Panen --}}
                <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200/90 flex flex-col justify-between hover:bg-emerald-100/60 transition duration-150 col-span-2 sm:col-span-1">
                    <div>
                        <span class="text-[10px] font-extrabold text-emerald-800 uppercase tracking-wide flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-ping"></span>
                            5. Siap Panen
                        </span>
                        <span class="text-lg font-black text-emerald-950 mt-1 block">{{ $pipelineSiapPanen }} <span class="text-[11px] font-semibold text-emerald-700">Batch</span></span>
                    </div>
                    <span class="text-[10px] text-emerald-700 mt-2 font-black block">🍄 Pertumbuhan 100%</span>
                </div>
            </div>
        </div>

        {{-- === GRAFIK PRODUKSI & TABEL AKTIVITAS TERBARU === --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Kolom Kiri (2 Span): Grafik Produksi Bulanan --}}
            <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200/80 p-4 shadow-2xs flex flex-col justify-between">
                <div class="pb-3 mb-3 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center font-bold text-xs border border-emerald-100">
                            📈
                        </div>
                        <div>
                            <h3 class="text-xs font-black text-[#064E3B] uppercase tracking-wider">Tren Hasil Produksi Jamur Tiram</h3>
                            <p class="text-[10px] text-gray-400 font-medium">Perbandingan panen berhasil vs gagal setiap bulannya (Kg)</p>
                        </div>
                    </div>
                </div>
                <div class="relative w-full" style="height: 270px;">
                    <canvas id="productionChart"></canvas>
                </div>
            </div>

            {{-- Kolom Kanan (1 Span): Aktivitas Laporan Terbaru --}}
            <div class="bg-white rounded-xl border border-gray-200/80 p-4 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="pb-3 mb-3 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center font-bold text-xs border border-blue-100">
                                🕒
                            </div>
                            <div>
                                <h3 class="text-xs font-black text-[#064E3B] uppercase tracking-wider">Laporan Terbaru</h3>
                                <p class="text-[10px] text-gray-400 font-medium">Aktivitas pencatatan oleh petugas</p>
                            </div>
                        </div>
                        <a href="{{ route('ketua.reports.index') }}" class="text-[11px] text-[#059669] hover:underline font-bold">Lihat Semua →</a>
                    </div>

                    <div class="space-y-2.5 overflow-y-auto" style="max-height: 270px;">
                        @forelse ($recentReports as $report)
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50/70 hover:bg-gray-100/70 transition border border-gray-100 text-xs">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100/80 text-emerald-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                    {{ substr($report->user->name, 0, 2) }}
                                </div>
                                <div>
                                    <span class="font-bold text-gray-800 block leading-tight">{{ $report->user->name }}</span>
                                    <span class="text-[10px] text-gray-400 font-medium">{{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMM Y') }}</span>
                                </div>
                            </div>

                            <div class="text-right">
                                <span class="text-xs font-black text-[#059669] block">{{ (float)($report->jumlah_panen) }} Kg</span>
                                @if ($report->status_validasi === 'valid')
                                    <span class="text-[9px] font-black text-emerald-700 bg-emerald-100 px-1.5 py-0.5 rounded border border-emerald-200 inline-block mt-0.5">✓ Valid</span>
                                @elseif ($report->status_validasi === 'pending')
                                    <span class="text-[9px] font-bold text-amber-700 bg-amber-100 px-1.5 py-0.5 rounded border border-amber-200 animate-pulse inline-block mt-0.5">⏳ Menunggu</span>
                                @else
                                    <span class="text-[9px] font-bold text-red-700 bg-red-100 px-1.5 py-0.5 rounded border border-red-200 inline-block mt-0.5">✕ Invalid</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="py-12 text-center">
                            <p class="text-xs font-bold text-gray-500">Belum ada riwayat laporan</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">Data panen akan muncul di sini</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

{{-- Chart.js via CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('productionChart').getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 260);
        gradient.addColorStop(0, 'rgba(5, 150, 105, 0.2)');
        gradient.addColorStop(1, 'rgba(5, 150, 105, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [
                    {
                        label: 'Panen Berhasil (Kg)',
                        data: {!! json_encode($chartValuesBerhasil) !!},
                        borderColor: '#059669',
                        backgroundColor: gradient,
                        borderWidth: 2.5,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#059669',
                        pointBorderColor: '#FFFFFF',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Panen Gagal/Layu (Kg)',
                        data: {!! json_encode($chartValuesGagal) !!},
                        borderColor: '#F59E0B',
                        backgroundColor: 'rgba(245, 158, 11, 0.05)',
                        borderWidth: 2,
                        borderDash: [4, 4],
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#F59E0B',
                        pointBorderColor: '#FFFFFF',
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            font: { weight: 'bold', family: 'inherit', size: 11 },
                            color: '#374151',
                            boxWidth: 12,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#1F2937',
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 11 },
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(229, 231, 235, 0.6)' },
                        ticks: {
                            font: { family: 'inherit', size: 10 },
                            color: '#6B7280',
                            stepSize: 10
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'inherit', size: 10, weight: '600' },
                            color: '#4B5563'
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

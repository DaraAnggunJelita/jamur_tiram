<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Dashboard Ketua KUPS') }}
 </h2>
 <span class="bg-[#E6DAC2] text-[#047857] text-xs font-bold px-3 py-1 rounded-full border border-[#E5E7EB]/60">
 Laporan Eksekutif
 </span>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- === KARTU STATISTIK RINGKASAN === --}}
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

 {{-- Card Total Produksi --}}
 <div class="bg-gradient-to-br from-[#064E3B] to-[#047857] rounded-3xl shadow-xl p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
 <div class="absolute -right-6 -bottom-6 opacity-[0.06]">
 <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
 </div>
 <p class="text-[#34D399] text-[9px] font-bold">Total Produksi Valid (Berhasil)</p>
 <p class="text-4xl font-bold mt-2.5">{{ number_format($totalProduksi, 1) }} <span class="text-2xl font-bold text-[#34D399]">Kg</span></p>
 <p class="text-[#E5E7EB]/70 text-xs mt-4 font-medium">Akumulasi panen bagus/cukup yang terverifikasi.</p>
 </div>

 {{-- Card Panen Gagal --}}
 <div class="bg-gradient-to-br from-[#F59E0B] to-[#047857] rounded-3xl shadow-xl p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
 <div class="absolute -right-6 -bottom-6 opacity-[0.1]">
 <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
 </div>
 <p class="text-[#F3F5F4]/80 text-[9px] font-bold">Total Panen Gagal/Layu</p>
 <p class="text-4xl font-bold mt-2.5">{{ number_format($totalPanenGagal, 1) }} <span class="text-2xl font-bold text-[#F3F5F4]/80">Kg</span></p>
 <p class="text-[#F3F5F4]/70 text-xs mt-4 font-medium">Akumulasi panen rusak yang dialihkan.</p>
 </div>

 {{-- Card Rata-rata Panen --}}
 <div class="bg-gradient-to-br from-[#374151] to-[#047857] rounded-3xl shadow-xl p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
 <div class="absolute -right-6 -bottom-6 opacity-[0.06]">
 <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
 </div>
 <p class="text-[#E6DAC2] text-[9px] font-bold">Rata-Rata Panen Harian</p>
 <p class="text-4xl font-bold mt-2.5">{{ number_format($rataRataPanen, 1) }} <span class="text-2xl font-bold text-[#E5E7EB]">Kg</span></p>
 <p class="text-[#E5E7EB]/70 text-xs mt-4 font-medium">Tingkat produktivitas rata-rata harian kumbung.</p>
 </div>

 {{-- Card Total Laporan Valid --}}
 <div class="bg-gradient-to-br from-[#059669] to-[#047857] rounded-3xl shadow-xl p-6 text-white relative overflow-hidden transform hover:-translate-y-1 transition duration-300">
 <div class="absolute -right-6 -bottom-6 opacity-[0.06]">
 <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
 </div>
 <p class="text-[#E6DAC2] text-[9px] font-bold">Laporan Panen Valid</p>
 <p class="text-4xl font-bold mt-2.5">{{ $totalLaporanValid }} <span class="text-2xl font-bold text-[#34D399]">Laporan</span></p>
 <p class="text-[#E5E7EB]/70 text-xs mt-4 font-medium">Jumlah laporan panen terverifikasi sistem.</p>
 </div>

 </div>

 </div>

 {{-- 1.5 RINGKASAN LAPORAN PROSES PRODUKSI (PIPELINE WIDGETS) --}}
 <div class="mb-6">
 <h3 class="text-sm font-bold text-[#047857] mb-4">Ringkasan Laporan Proses Produksi (Pipeline)</h3>
 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
 
 {{-- Widget 1: Stok Baglog Mentah --}}
 <div class="bg-white border border-[#E5E7EB]/50 rounded-xl p-4 shadow-sm flex flex-col justify-between">
 <div>
 <div class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Stok Mentah</div>
 <div class="text-2xl font-black text-gray-700">{{ $pipelineStokBaglog }}</div>
 </div>
 <div class="text-xs text-gray-400 font-medium mt-2 leading-tight">Baglog belum disterilisasi</div>
 </div>

 {{-- Widget 2: Baglog Masa Pendinginan --}}
 <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 shadow-sm flex flex-col justify-between">
 <div>
 <div class="text-[10px] font-bold text-amber-600 uppercase tracking-wider mb-1">Masa Pendinginan</div>
 <div class="text-2xl font-black text-amber-700">{{ $pipelinePendinginan }}</div>
 </div>
 <div class="text-[10px] text-amber-600 font-bold mt-2 leading-tight flex items-start gap-1">
 <span>⚠️</span>
 <span>Belum Layak Inokulasi (Masih Panas)</span>
 </div>
 </div>

 {{-- Widget 3: Baglog Siap Inokulasi --}}
 <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 shadow-sm flex flex-col justify-between">
 <div>
 <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1">Siap Inokulasi</div>
 <div class="text-2xl font-black text-emerald-700">{{ $pipelineSiapInokulasi }}</div>
 </div>
 <div class="text-xs text-emerald-600 font-medium mt-2 leading-tight">Batch siap disuntik bibit</div>
 </div>

 {{-- Widget 4: Baglog Masa Inkubasi --}}
 <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-4 shadow-sm flex flex-col justify-between">
 <div>
 <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-1">Masa Inkubasi</div>
 <div class="text-2xl font-black text-indigo-700">{{ $pipelineInkubasi }}</div>
 </div>
 <div class="text-xs text-indigo-600 font-medium mt-2 leading-tight">Sedang dipantau</div>
 </div>

 {{-- Widget 5: Alarm Siap Panen --}}
 <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 shadow-sm flex flex-col justify-between">
 <div>
 <div class="text-[10px] font-bold text-rose-600 uppercase tracking-wider mb-1 flex items-center gap-1">
 <svg class="w-3.5 h-3.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
 <span>Siap Panen</span>
 </div>
 <div class="text-2xl font-black text-rose-700">{{ $pipelineSiapPanen }}</div>
 </div>
 <div class="text-[10px] text-rose-600 font-bold mt-2 leading-tight">Inkubasi 100% / >40 Hari</div>
 </div>

 </div>
 </div>

 {{-- === GRAFIK PRODUKSI BULANAN === --}}
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-6">
 <div class="pb-4 mb-4 border-b border-[#E5E7EB]/20 flex items-center space-x-2">
 <div class="w-8 h-8 bg-[#059669]/10 rounded-lg flex items-center justify-center text-[#059669]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
 </div>
 <h3 class="text-base font-bold text-[#064E3B]">Tren Hasil Produksi Jamur Tiram Bulanan (Kg)</h3>
 </div>
 <div class="relative h-80 w-full">
 <canvas id="productionChart"></canvas>
 </div>
 </div>

 {{-- === LOG LAPORAN TERBARU === --}}
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-6">
 <div class="pb-4 mb-5 border-b border-[#E5E7EB]/20 flex items-center space-x-2">
 <div class="w-8 h-8 bg-[#047857]/10 rounded-lg flex items-center justify-center text-[#047857]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
 </div>
 <h3 class="text-base font-bold text-[#064E3B]">Aktivitas Laporan Panen Terbaru</h3>
 </div>

 <div class="overflow-x-auto rounded-xl border border-[#E5E7EB]/30">
 <table class="min-w-full divide-y divide-[#E5E7EB]/20">
 <thead class="bg-[#F3F5F4]/50">
 <tr>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Tanggal Panen</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Petugas</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Berat (Kg)</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Grade A/B</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Status Laporan</th>
 </tr>
 </thead>
 <tbody class="bg-white divide-y divide-[#E5E7EB]/15 text-[#374151]">
 @forelse ($recentReports as $report)
 <tr class="hover:bg-[#F3F5F4]/30 transition duration-150">
 <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#064E3B]">
 {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
 </td>
 <td class="px-6 py-4 whitespace-nowrap">
 <div class="flex items-center space-x-2.5">
 <div class="w-7 h-7 rounded-full bg-[#059669]/15 text-[#047857] font-bold text-[10px] flex items-center justify-center">
 {{ substr($report->user->name, 0, 2) }}
 </div>
 <span class="text-sm font-bold text-[#374151]">{{ $report->user->name }}</span>
 </div>
 </td>
 <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#059669]">
 {{ number_format($report->jumlah_panen, 1) }} Kg
 </td>
 <td class="px-6 py-4 whitespace-nowrap">
 <span class="inline-flex px-2.5 py-1 text-[10px] font-bold rounded-full border bg-gray-100 text-gray-800 border-gray-300">
 A: {{ $report->berat_grade_a }} | B: {{ $report->berat_grade_b }}
 </span>
 </td>
 <td class="px-6 py-4 whitespace-nowrap">
 @if ($report->status_validasi ==='pending')
 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#E5E7EB]/20 text-[#047857] border border-[#E5E7EB]/40 animate-pulse">
 Menunggu
 </span>
 @elseif ($report->status_validasi ==='valid')
 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#34D399]/15 text-[#047857] border border-[#34D399]/30">
 Valid
 </span>
 @else
 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#F59E0B]/10 text-[#F59E0B] border border-[#F59E0B]/20">
 Invalid
 </span>
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center">
 <div class="w-12 h-12 bg-[#F3F5F4] border border-[#E5E7EB]/40 text-[#6B7280] rounded-xl flex items-center justify-center mx-auto mb-3 text-xl shadow-2xs">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
 </div>
 <p class="text-sm font-bold text-[#064E3B]">Belum Ada Riwayat Laporan</p>
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
 gradient.addColorStop(0,'rgba(79, 97, 70, 0.25)');
 gradient.addColorStop(1,'rgba(79, 97, 70, 0.0)');

 new Chart(ctx, {
 type:'line',
 data: {
 labels: {!! json_encode($chartLabels) !!},
 datasets: [
 {
 label:'Total Hasil Panen Berhasil (Kg)',
 data: {!! json_encode($chartValuesBerhasil) !!},
 borderColor:'#059669',
 backgroundColor: gradient,
 borderWidth: 3,
 tension: 0.35,
 fill: true,
 pointBackgroundColor:'#059669',
 pointBorderColor:'#FFFFFF',
 pointBorderWidth: 2.5,
 pointRadius: 5,
 pointHoverRadius: 8,
 },
 {
 label:'Total Hasil Panen Gagal/Layu (Kg)',
 data: {!! json_encode($chartValuesGagal) !!},
 borderColor:'#F59E0B',
 backgroundColor:'rgba(160, 101, 61, 0.1)',
 borderWidth: 3,
 tension: 0.35,
 fill: true,
 pointBackgroundColor:'#F59E0B',
 pointBorderColor:'#FFFFFF',
 pointBorderWidth: 2.5,
 pointRadius: 5,
 pointHoverRadius: 8,
 }
 ]
 },
 options: {
 responsive: true,
 maintainAspectRatio: false,
 plugins: {
 legend: {
 position:'top',
 labels: {
 font: { weight:'bold', family:'Inter', size: 12 },
 color:'#047857'
 }
 },
 tooltip: { mode:'index', intersect: false }
 },
 scales: {
 y: {
 beginAtZero: true,
 title: { display: true, text:'Berat (Kg)', font: { weight:'bold', family:'Inter' }, color:'#047857' },
 grid: { color:'rgba(201,184,150,0.2)' },
 ticks: { font: { family:'Inter' }, color:'#047857' }
 },
 x: {
 title: { display: true, text:'Periode Bulan', font: { weight:'bold', family:'Inter' }, color:'#047857' },
 grid: { display: false },
 ticks: { font: { family:'Inter' }, color:'#047857' }
 }
 }
 }
 });
 });
 </script>
</x-app-layout>

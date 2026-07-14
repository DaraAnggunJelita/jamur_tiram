<x-app-layout>
 <x-slot name="header">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Dashboard Petugas') }}
 </h2>
 </x-slot>

 <div class="py-12 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- 0. TIMELINE TASK REMINDER (BUKA KAPAS) --}}
 @if(isset($inokulasiBukaKapas) && $inokulasiBukaKapas->count() > 0)
 @foreach($inokulasiBukaKapas as $inokulasi)
 <div class="bg-amber-100 border-l-4 border-amber-500 rounded-r-xl shadow-md p-5 mb-6">
 <div class="flex items-center justify-between">
 <div class="flex items-start">
 <div class="flex-shrink-0 mt-0.5">
 <svg class="h-6 w-6 text-amber-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
 </svg>
 </div>
 <div class="ml-3">
 <h3 class="text-sm font-bold text-amber-800">Pengingat Jadwal Buka Kapas</h3>
 <p class="mt-1 text-sm text-amber-900 font-medium">
 📢 PERINTAH TUGAS: Batch {{ $inokulasi->sterilisasi->baglog->kode_batch ??'Unknown' }} di Rak - sudah 40 hari masa inkubasi (Miselium 100%). Waktunya membuka tutup kapas baglog karena sudah siap memasuki fase panen!
 </p>
 </div>
 </div>
 <form action="{{ route('inokulasi.buka-kapas', $inokulasi->id) }}" method="POST" class="ml-4 flex-shrink-0">
 @csrf
 <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-lg shadow-md transition transform hover:-translate-y-0.5">
 Selesai Dikerjakan
 </button>
 </form>
 </div>
 </div>
 @endforeach
 @endif

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
 <h3 class="text-sm font-bold text-red-800">Pusat Peringatan Dini (EWS) Aktif!</h3>
 <div class="mt-2 text-sm text-red-700 space-y-2">
 @foreach($peringatanAktif as $peringatan)
 <div class="flex justify-between items-center bg-white/50 p-3 rounded-lg">
 <p class="font-semibold">{{ $peringatan->pesan }}</p>
 <form action="{{ route('petugas.peringatan.resolve', $peringatan->id) }}" method="POST">
 @csrf
 <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-md shadow transition">
 Selesai Ditindaklanjuti
 </button>
 </form>
 </div>
 @endforeach
 </div>
 </div>
 </div>
 </div>
 @else
 <div class="bg-[#34D399]/10 border border-[#34D399]/30 rounded-xl p-4 mb-6 flex items-center gap-3">
 <div class="w-8 h-8 rounded-full bg-[#34D399]/20 flex items-center justify-center text-[#059669]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
 </div>
 <p class="text-sm font-bold text-[#047857]">EWS Aman. Tidak ada peringatan kritis di kumbung saat ini.</p>
 </div>
 @endif

 {{-- 1.1 NOTIFIKASI BATCH STERILISASI BERISIKO --}}
 @if(isset($sterilisasiBerisiko) && $sterilisasiBerisiko->count() > 0)
 @foreach($sterilisasiBerisiko as $steril)
 <div class="bg-amber-50 border-l-4 border-amber-400 rounded-r-xl shadow-md p-4 mb-6">
 <div class="flex items-start">
 <div class="flex-shrink-0 mt-0.5">
 <svg class="h-6 w-6 text-amber-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
 </svg>
 </div>
 <div class="ml-3 w-full">
 <h3 class="text-sm font-bold text-amber-800">Tindakan Diperlukan: Batch Sterilisasi Berisiko</h3>
 <p class="mt-1 text-sm text-amber-700 font-medium">
 ⚠️ Pemberitahuan: Batch <span class="font-bold">{{ $steril->baglog->kode_batch ??'N/A' }}</span> terdeteksi <span class="font-bold uppercase text-amber-800">Berisiko</span>. Silakan lakukan pengecekan fisik dan lakukan pengukusan ulang lewat menu Sterilisasi Baglog.
 </p>
 <div class="mt-3">
 <a href="{{ route('sterilisasi.index') }}" class="inline-flex px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-lg shadow-sm transition transform hover:-translate-y-0.5">
 Pergi ke Menu Sterilisasi
 </a>
 </div>
 </div>
 </div>
 </div>
 @endforeach
 @endif

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

 {{-- Widget 3: Baglog Siap Inokulasi (Clickable) --}}
 <a href="{{ route('inokulasi.create') }}" class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 shadow-sm flex flex-col justify-between hover:bg-emerald-100 hover:border-emerald-300 transition cursor-pointer transform hover:-translate-y-1">
 <div>
 <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1 flex items-center justify-between">
 <span>Siap Inokulasi</span>
 <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
 </div>
 <div class="text-2xl font-black text-emerald-700">{{ $pipelineSiapInokulasi }}</div>
 </div>
 <div class="text-xs text-emerald-600 font-medium mt-2 leading-tight">Batch siap disuntik bibit</div>
 </a>

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

 {{-- 2. RINGKASAN STATISTIK & PIE CHART --}}
 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
 
 {{-- Card Stat 1 --}}
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs flex items-center gap-4">
 <div class="w-12 h-12 bg-[#059669]/10 rounded-xl flex items-center justify-center text-[#059669]">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
 </div>
 <div>
 <p class="text-xs text-[#6B7280] font-bold">Total Panen (Bulan Ini)</p>
 <p class="text-2xl font-bold text-[#064E3B]">{{ $reportsBulanIni->sum('jumlah_panen') }} <span class="text-sm font-bold text-[#6B7280]">Kg</span></p>
 </div>
 </div>

 {{-- Card Stat 2 --}}
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs flex items-center gap-4">
 <div class="w-12 h-12 bg-[#F59E0B]/10 rounded-xl flex items-center justify-center text-[#F59E0B]">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
 </div>
 <div>
 <p class="text-xs text-[#6B7280] font-bold">Laporan Aktif</p>
 <p class="text-2xl font-bold text-[#064E3B]">{{ $reportsBulanIni->count() }} <span class="text-sm font-bold text-[#6B7280]">Batch</span></p>
 </div>
 </div>

 {{-- Card Pie Chart (Dinamis dari Hasil Panen) --}}
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs md:row-span-2">
 <h3 class="text-sm font-bold text-[#047857] mb-4">Rasio Kualitas Panen (Bulan Ini)</h3>
 <div class="flex flex-col items-center justify-center h-full pb-4">
 @if($persentaseA > 0 || $persentaseB > 0)
 <div class="relative w-40 h-40 rounded-full shadow-inner flex items-center justify-center" style="background: conic-gradient(#059669 0% {{ $persentaseA }}%, #F59E0B {{ $persentaseA }}% 100%);">
 <div class="w-32 h-32 rounded-full bg-[#FFFFFF] flex items-center justify-center">
 <span class="text-xs font-bold text-[#6B7280] text-center">Grade A<br><span class="text-xl text-[#064E3B]">{{ $persentaseA }}%</span></span>
 </div>
 </div>
 <div class="mt-6 flex flex-wrap justify-center gap-4">
 <span class="flex items-center text-xs font-bold text-[#374151]"><span class="w-3 h-3 bg-[#059669] rounded-full mr-1.5"></span>Grade A (Bagus)</span>
 <span class="flex items-center text-xs font-bold text-[#374151]"><span class="w-3 h-3 bg-[#F59E0B] rounded-full mr-1.5"></span>Grade B (Kurang)</span>
 </div>
 @else
 <div class="text-center text-[#9CA3AF] text-sm italic w-full h-40 flex items-center justify-center border-2 border-dashed border-[#E5E7EB] rounded-full">Belum ada panen bulan ini</div>
 @endif
 </div>
 </div>

 {{-- Tabel Riwayat Laporan Singkat --}}
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs md:col-span-2">
 <div class="flex justify-between items-center mb-4">
 <h3 class="text-sm font-bold text-[#047857]">Aktivitas Panen Terbaru</h3>
 <a href="{{ route('petugas.laporan-panen.index') }}" class="text-xs font-bold text-[#059669] hover:underline">Lihat Semua &rarr;</a>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm border-collapse">
 <thead>
 <tr class="border-b border-[#E5E7EB]/40 text-[#6B7280] text-xs font-bold">
 <th class="pb-2">Tanggal</th>
 <th class="pb-2">Jumlah</th>
 <th class="pb-2">Grade A/B</th>
 <th class="pb-2 text-right">Status</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/20">
 @forelse($recentReports->take(5) as $report)
 <tr class="hover:bg-[#F3F5F4]/40 transition">
 <td class="py-3 font-bold text-[#374151]">{{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}</td>
 <td class="py-3 font-bold text-[#059669]">{{ $report->jumlah_panen }} Kg</td>
 <td class="py-3">
 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border bg-gray-100 text-gray-800 border-gray-300">
 A: {{ $report->berat_grade_a }} | B: {{ $report->berat_grade_b }}
 </span>
 </td>
 <td class="py-3 text-right">
 @if($report->status_validasi ==='valid')
 <span class="text-[10px] font-bold text-green-700 bg-green-100 px-2 py-1 rounded-md">Valid</span>
 @if($report->berat_grade_b > 0)
 <div class="text-[9px] text-[#F59E0B] font-bold mt-1">→ B ke Rendang</div>
 @endif
 @elseif($report->status_validasi ==='invalid')
 <span class="text-[10px] font-bold text-red-700 bg-red-100 px-2 py-1 rounded-md">Invalid</span>
 @else
 <span class="text-[10px] font-bold text-yellow-700 bg-yellow-100 px-2 py-1 rounded-md">Pending</span>
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="py-4 text-center text-xs text-[#6B7280] font-medium italic">Belum ada riwayat panen terbaru.</td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>

        {{-- 3. RIWAYAT INPUT LAPORAN LAINNYA --}}
        <div class="mt-2 bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs">
            <h3 class="text-sm font-bold text-[#047857] mb-4">Riwayat Input Laporan Lainnya (Terbaru)</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Baglog --}}
                <div class="bg-[#F3F5F4]/70 p-4 rounded-xl border border-[#E5E7EB]/50">
                    <h4 class="text-xs font-bold text-[#374151] mb-3 flex items-center justify-between">
                        <span>Baglog</span>
                        <span class="text-[10px] bg-[#059669] text-white px-2 py-0.5 rounded-full">{{ $recentBaglogs->count() }}</span>
                    </h4>
                    <div class="space-y-2">
                        @forelse($recentBaglogs as $baglog)
                            <div class="bg-white p-2.5 rounded-lg shadow-sm text-xs border border-gray-100 hover:border-gray-300 transition">
                                <div class="font-bold text-[#064E3B] truncate">{{ $baglog->kode_batch }}</div>
                                <div class="flex justify-between mt-1 text-[#6B7280]">
                                    <span>{{ \Carbon\Carbon::parse($baglog->tanggal_pembuatan)->format('d M') }}</span>
                                    <span class="font-medium text-[#059669]">{{ $baglog->jumlah_baglog }} pcs</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-xs text-center text-[#9CA3AF] py-3 italic border border-dashed border-gray-300 rounded-lg">Belum ada input</div>
                        @endforelse
                    </div>
                </div>

                {{-- Sterilisasi --}}
                <div class="bg-[#F3F5F4]/70 p-4 rounded-xl border border-[#E5E7EB]/50">
                    <h4 class="text-xs font-bold text-[#374151] mb-3 flex items-center justify-between">
                        <span>Sterilisasi</span>
                        <span class="text-[10px] bg-[#059669] text-white px-2 py-0.5 rounded-full">{{ $recentSterilisasi->count() }}</span>
                    </h4>
                    <div class="space-y-2">
                        @forelse($recentSterilisasi as $sterilisasi)
                            <div class="bg-white p-2.5 rounded-lg shadow-sm text-xs border border-gray-100 hover:border-gray-300 transition">
                                <div class="font-bold text-[#064E3B] truncate">Batch: {{ $sterilisasi->baglog->kode_batch ?? '-' }}</div>
                                <div class="flex justify-between mt-1 text-[#6B7280]">
                                    <span>{{ \Carbon\Carbon::parse($sterilisasi->tanggal)->format('d M') }}</span>
                                    <span class="font-medium text-[#059669]">{{ $sterilisasi->jumlah_berhasil }} pcs</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-xs text-center text-[#9CA3AF] py-3 italic border border-dashed border-gray-300 rounded-lg">Belum ada input</div>
                        @endforelse
                    </div>
                </div>

                {{-- Inokulasi --}}
                <div class="bg-[#F3F5F4]/70 p-4 rounded-xl border border-[#E5E7EB]/50">
                    <h4 class="text-xs font-bold text-[#374151] mb-3 flex items-center justify-between">
                        <span>Inokulasi (Bibit)</span>
                        <span class="text-[10px] bg-[#059669] text-white px-2 py-0.5 rounded-full">{{ $recentInokulasi->count() }}</span>
                    </h4>
                    <div class="space-y-2">
                        @forelse($recentInokulasi as $inokulasi)
                            <div class="bg-white p-2.5 rounded-lg shadow-sm text-xs border border-gray-100 hover:border-gray-300 transition">
                                <div class="font-bold text-[#064E3B] truncate">Batch: {{ $inokulasi->sterilisasi->baglog->kode_batch ?? '-' }}</div>
                                <div class="flex justify-between mt-1 text-[#6B7280]">
                                    <span>{{ \Carbon\Carbon::parse($inokulasi->tanggal)->format('d M') }}</span>
                                    <span class="font-medium text-[#059669]">{{ $inokulasi->jumlah_berhasil }} pcs</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-xs text-center text-[#9CA3AF] py-3 italic border border-dashed border-gray-300 rounded-lg">Belum ada input</div>
                        @endforelse
                    </div>
                </div>

                {{-- Monitoring --}}
                <div class="bg-[#F3F5F4]/70 p-4 rounded-xl border border-[#E5E7EB]/50">
                    <h4 class="text-xs font-bold text-[#374151] mb-3 flex items-center justify-between">
                        <span>Monitoring Kumbung</span>
                        <span class="text-[10px] bg-[#059669] text-white px-2 py-0.5 rounded-full">{{ $recentMonitoring->count() }}</span>
                    </h4>
                    <div class="space-y-2">
                        @forelse($recentMonitoring as $monitoring)
                            <div class="bg-white p-2.5 rounded-lg shadow-sm text-xs border border-gray-100 hover:border-gray-300 transition">
                                <div class="font-bold text-[#064E3B] truncate">Batch: {{ $monitoring->inokulasi->sterilisasi->baglog->kode_batch ?? $monitoring->inokulasi_id }}</div>
                                <div class="flex justify-between mt-1 text-[#6B7280]">
                                    <span>{{ \Carbon\Carbon::parse($monitoring->tanggal)->format('d M') }}</span>
                                    <span class="font-medium text-[#059669]">Siram: {{ $monitoring->jumlah_penyiraman }}x</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-xs text-center text-[#9CA3AF] py-3 italic border border-dashed border-gray-300 rounded-lg">Belum ada input</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

 </div>
 </div>
</x-app-layout>

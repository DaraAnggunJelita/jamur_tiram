<x-app-layout>
 <x-slot name="header">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
 <div>
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Dashboard Administrator') }}
 </h2>
 <p class="text-xs text-[#047857] mt-0.5 font-medium">Kelola verifikasi pasokan masuk dan otentikasi data KUPS Harapan Asri</p>
 </div>
 <div class="flex items-center self-start sm:self-center">
 <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-[#047857] to-[#059669] text-white text-[10px] font-bold px-3.5 py-1.5 rounded-xl shadow-md shadow-[#059669]/20">
 <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
 Sistem Validasi Utama
 </span>
 </div>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen px-4 sm:px-6 lg:px-8 font-sans text-[#064E3B]">
 <div class="max-w-7xl mx-auto">

 {{-- Action Notification System --}}
 @if (session('success'))
 <div class="mb-8 bg-gradient-to-r from-[#047857] to-[#064E3B] text-white p-4 rounded-xl shadow-xl shadow-[#064E3B]/10 border border-[#34D399]/30 flex items-center justify-between transition animate-fadeIn" role="alert">
 <div class="flex items-center space-x-3">
 <div class="w-8 h-8 bg-[#059669] rounded-lg flex items-center justify-center text-white shadow-md">
 <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
 </div>
 <div>
 <p class="font-bold text-sm">Konfirmasi Berhasil</p>
 <p class="text-xs text-[#E6DAC2] font-light mt-0.5">{{ session('success') }}</p>
 </div>
 </div>
 </div>
 @endif

 {{-- === SECTION 1: METRIC DASHBOARD CARDS === --}}
 <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
 <!-- Card Antrian Tertunda -->
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/60 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-[#047857]/5 hover:border-[#6B7280] transition duration-300">
 <div class="w-12 h-12 rounded-xl bg-[#F59E0B] text-white flex items-center justify-center shadow-lg shadow-[#F59E0B]/20 text-lg">
 <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'/></svg>
 </div>
 <div>
 <p class="text-[10px] text-[#F59E0B] font-bold">Antrian Tertunda</p>
 <h4 class="text-2xl font-bold text-[#064E3B] mt-0.5">{{ $pendingReports->count() }} <span class="text-xs font-bold text-[#6B7280]/70 font-sans">Berkas</span></h4>
 </div>
 </div>

 <!-- Card Total Berat Tunggu -->
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/60 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-[#059669]/5 hover:border-[#059669] transition duration-300">
 <div class="w-12 h-12 rounded-xl bg-[#059669] text-white flex items-center justify-center shadow-lg shadow-[#059669]/20 text-lg">
 <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'/></svg>
 </div>
 <div>
 <p class="text-[10px] text-[#059669] font-bold">Total Berat Tunggu</p>
 <h4 class="text-2xl font-bold text-[#064E3B] mt-0.5">{{ number_format($pendingReports->sum('jumlah_panen'), 1) }} <span class="text-xs font-bold text-[#6B7280]/70 font-sans">Kg</span></h4>
 </div>
 </div>

 <!-- Card Selesai Diverifikasi -->
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/60 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-[#047857]/5 hover:border-[#047857] transition duration-300">
 <div class="w-12 h-12 rounded-xl bg-[#047857] text-white flex items-center justify-center shadow-lg shadow-[#047857]/20 text-lg">
 ✓
 </div>
 <div>
 <p class="text-[10px] text-[#047857] font-bold">Selesai Diverifikasi</p> <h4 class="text-2xl font-bold text-[#064E3B] mt-0.5">{{ \App\Models\ProductionReport::whereIn('status_validasi', ['valid','invalid','dibatalkan'])->count() }} <span class="text-xs font-bold text-[#6B7280]/70 font-sans">Laporan</span></h4>
 </div>
 </div>
 </div>

 {{-- === SECTION 2: GRID SYSTEM FOR LOGS AND ACTIONS === --}}
 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

 {{-- Left & Center Column: Validation Queue List --}}
 <div class="bg-[#FFFFFF] overflow-hidden shadow-xs border border-[#E5E7EB]/40 rounded-2xl lg:col-span-2">
 <div class="p-6">
 <div class="flex items-center justify-between pb-5 mb-6 border-b border-[#E5E7EB]/30">
 <div class="flex items-center space-x-3">
 <span class="relative flex h-3 w-3">
 <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#F59E0B] opacity-75"></span>
 <span class="relative inline-flex rounded-full h-3 w-3 bg-[#F59E0B]"></span>
 </span>
 <h3 class="text-base font-bold text-[#064E3B]">Antrian Validasi Pasokan Masuk</h3>
 </div>
 <span class="bg-[#E6DAC2] text-[#047857] border border-[#E5E7EB]/50 text-[10px] font-bold px-3 py-1 rounded-lg">
 {{ $pendingReports->count() }} Perlu Validasi
 </span>
 </div>

 <div class="space-y-4">
 @forelse ($pendingReports as $report)
 <div class="bg-[#F3F5F4]/50 border border-[#E5E7EB]/40 rounded-xl p-5 hover:border-[#059669]/60 hover:bg-[#FFFFFF] transition duration-200">
 <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
 <div class="space-y-3 flex-1">
 <div class="flex flex-wrap items-center gap-2">
 <span class="bg-gradient-to-r from-[#047857] to-[#059669] text-white text-[11px] font-bold px-3 py-1 rounded-lg shadow-xs">
 {{ number_format($report->jumlah_panen, 1) }} Kg
 </span>
 <span class="px-2.5 py-1 text-[10px] font-bold rounded-lg border shadow-2xs bg-gray-100 text-gray-800 border-gray-300">
 Grade A: {{ number_format($report->berat_grade_a, 1) }} | Grade B: {{ number_format($report->berat_grade_b, 1) }}
 </span>
 </div>
 <div>
 <p class="text-base font-bold text-[#064E3B] leading-tight">{{ $report->user->name }}</p>
 <p class="text-xs text-[#6B7280] font-bold mt-0.5">
 Tanggal Distribusi Panen: {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
 </p>
 </div>

 @if($report->catatan)
 <div class="text-xs text-[#374151] bg-[#FFFFFF] px-4 py-3 rounded-lg border border-[#E5E7EB]/30 font-normal italic leading-relaxed">
 "{{ $report->catatan }}"
 </div>
 @endif
 </div>

 <div class="flex items-center gap-2 self-end md:self-start pt-2 md:pt-0">
 <form action="{{ route('admin.reports.validate', $report->id) }}" method="POST">
 @csrf
 <input type="hidden" name="status" value="valid">
 <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-[10px] font-bold text-white bg-[#059669] hover:bg-[#047857] rounded-xl transition duration-150 transform hover:-translate-y-0.5 shadow-md shadow-[#059669]/10">
 <span>Terima</span>
 </button>
 </form>
 <form action="{{ route('admin.reports.validate', $report->id) }}" method="POST">
 @csrf
 <input type="hidden" name="status" value="invalid">
 <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-[10px] font-bold text-white bg-[#F59E0B] hover:bg-black rounded-xl transition duration-150 transform hover:-translate-y-0.5 shadow-md shadow-[#F59E0B]/10">
 <span>Tolak</span>
 </button>
 </form>
 </div>
 </div>
 </div>
 @empty
 <div class="text-center py-20 bg-[#F3F5F4]/30 rounded-xl border border-dashed border-[#E5E7EB]/60">
 <div class="w-12 h-12 bg-[#34D399]/10 rounded-xl border border-[#34D399]/20 text-[#059669] flex items-center justify-center mx-auto mb-3 text-xl">
 <svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg>
 </div>
 <p class="text-sm font-bold text-[#064E3B]">Antrian Kosong</p>
 <p class="text-xs text-[#6B7280] mt-1 max-w-xs mx-auto font-medium">Seluruh laporan dari petugas kumbung telah divalidasi ke sistem utama.</p>
 </div>
 @endforelse
 </div>
 </div>
 </div>

 {{-- Right Column: History Logs --}}
 <div class="bg-[#FFFFFF] overflow-hidden shadow-xs border border-[#E5E7EB]/40 rounded-2xl lg:col-span-1">
 <div class="p-6">
 <div class="pb-4 mb-5 border-b border-[#E5E7EB]/30 flex items-center space-x-2">
 <div class="w-7 h-7 bg-[#E6DAC2]/50 border border-[#E5E7EB]/30 rounded-lg flex items-center justify-center text-[#047857] font-bold text-xs">
 <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'/></svg>
 </div>
 <h3 class="text-xs font-bold text-[#064E3B]">Log Riwayat Audit</h3>
 </div>

 <div class="space-y-3 overflow-y-auto max-h-[520px] pr-1">
 @forelse ($processedReports as $report)
 <div class="p-4 border border-[#E5E7EB]/20 rounded-xl bg-[#F3F5F4]/40 hover:bg-white hover:border-[#E5E7EB]/50 hover:shadow-sm transition duration-200 space-y-2.5">
 <div class="flex items-center justify-between">
 <span class="text-[10px] text-[#6B7280] font-bold">
 {{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}
 </span>
 <span class="px-2.5 py-0.5 text-[9px] font-bold rounded-md shadow-2xs {{ $report->status_validasi === 'valid' ? 'bg-[#059669] text-white' : ($report->status_validasi === 'dibatalkan' ? 'bg-gray-200 text-gray-700' : 'bg-[#F59E0B] text-white') }}">
 {{ ucfirst($report->status_validasi) }}
 </span>
 </div>
 <div>
 <p class="text-sm font-bold text-[#064E3B] leading-tight">{{ $report->user->name }}</p>
 <p class="text-xs text-[#047857] mt-0.5 font-bold">Total: {{ number_format($report->jumlah_panen, 1) }} Kg <span class="text-[10px] font-sans text-[#6B7280]">(A: {{ $report->berat_grade_a }} | B: {{ $report->berat_grade_b }})</span></p>
 </div>
 <div class="pt-2 border-t border-[#E5E7EB]/20 flex items-center space-x-1 text-[10px] text-[#6B7280] font-bold">
 <span class="truncate">Validator: {{ $report->validator->name ??'Admin' }}</span>
 </div>
 </div>
 @empty
 <div class="text-center py-16 text-[#6B7280]">
 <p class="text-2xl block mb-1"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg></p>
 <p class="text-xs font-bold text-[#047857]">Belum ada riwayat terekam.</p>
 </div>
 @endforelse
 </div>
 </div>
 </div>

 </div>
 
 {{-- === SECTION 3: ANALISIS DAN AKTIVITAS PANEN TERBARU === --}}
 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
 
 {{-- Left Column: Rasio Kualitas --}}
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/40 p-6 shadow-xs flex flex-col justify-between hover:shadow-sm transition">
 <div class="flex items-center justify-between pb-4 border-b border-[#E5E7EB]/20">
 <div class="flex items-center space-x-2">
 <div class="w-8 h-8 bg-[#059669]/10 rounded-lg flex items-center justify-center text-[#059669]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
 </div>
 <h3 class="text-sm font-bold text-[#064E3B]">Rasio Kualitas (Bulan Ini)</h3>
 </div>
 </div>
 
 <div class="flex flex-col items-center justify-center flex-1 py-4">
 @if($persentaseA > 0 || $persentaseB > 0)
 <div class="relative w-36 h-36 rounded-full shadow-inner flex items-center justify-center" style="background: conic-gradient(#059669 0% {{ $persentaseA }}%, #F59E0B {{ $persentaseA }}% 100%);">
 <div class="w-24 h-24 bg-[#FFFFFF] rounded-full flex flex-col items-center justify-center shadow-md">
 <span class="text-[10px] text-[#6B7280] font-bold">Total</span>
 <span class="text-lg font-black text-[#064E3B] leading-none">{{ $reportsBulanIni->count() }}</span>
 </div>
 </div>
 @else
 <div class="w-32 h-32 rounded-full border-4 border-dashed border-[#E5E7EB]/70 flex items-center justify-center">
 <span class="text-[10px] font-bold text-[#6B7280] text-center px-4">Belum ada<br>panen</span>
 </div>
 @endif
 </div>

 <div class="space-y-2 border-t border-[#E5E7EB]/20 pt-4">
 <div class="flex items-center justify-between text-xs">
 <div class="flex items-center space-x-2">
 <span class="w-2.5 h-2.5 rounded-full bg-[#059669]"></span>
 <span class="text-[#374151] font-bold">Grade A (Bagus)</span>
 </div>
 <span class="font-bold text-[#064E3B]">{{ $persentaseA }}%</span>
 </div>
 <div class="flex items-center justify-between text-xs">
 <div class="flex items-center space-x-2">
 <span class="w-2.5 h-2.5 rounded-full bg-[#F59E0B]"></span>
 <span class="text-[#374151] font-bold">Grade B (Layu)</span>
 </div>
 <span class="font-bold text-[#064E3B]">{{ $persentaseB }}%</span>
 </div>
 </div>
 </div>

 {{-- Right Column: Aktivitas Panen Terbaru --}}
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/40 p-6 shadow-xs lg:col-span-2">
 <div class="flex items-center justify-between pb-4 border-b border-[#E5E7EB]/20 mb-4">
 <div class="flex items-center space-x-2">
 <div class="w-8 h-8 bg-[#047857]/10 rounded-lg flex items-center justify-center text-[#047857]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
 </div>
 <h3 class="text-sm font-bold text-[#064E3B]">Aktivitas Panen Terbaru</h3>
 </div>
 </div>

 <div class="space-y-3">
 @forelse ($recentReports as $report)
 <div class="flex items-center justify-between p-3 rounded-xl border border-[#E5E7EB]/30 hover:bg-[#F3F5F4]/30 transition">
 <div class="flex items-center space-x-4">
 <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#059669]/10 to-[#047857]/10 flex items-center justify-center text-[#059669] font-bold border border-[#059669]/20">
 {{ \Carbon\Carbon::parse($report->tanggal)->format('d') }}
 </div>
 <div>
 <p class="text-xs font-bold text-[#064E3B]">{{ $report->user->name }}</p>
 <p class="text-[10px] text-[#6B7280] font-medium">{{ \Carbon\Carbon::parse($report->tanggal)->format('M Y') }}</p>
 </div>
 </div>
 <div class="text-right">
 <p class="text-sm font-bold text-[#059669]">{{ number_format($report->jumlah_panen, 1) }} Kg</p>
 <span class="inline-block mt-0.5 px-2 py-0.5 text-[9px] font-bold rounded-md shadow-2xs {{ $report->status_validasi === 'valid' ? 'bg-[#059669] text-white' : ($report->status_validasi === 'dibatalkan' ? 'bg-gray-200 text-gray-700' : ($report->status_validasi === 'pending' ? 'bg-[#F59E0B] text-white' : 'bg-red-500 text-white')) }}">
 {{ ucfirst($report->status_validasi) }}
 </span>
 </div>
 </div>
 @empty
 <div class="text-center py-8 text-[#6B7280]">
 <p class="text-xs font-bold text-[#047857]">Belum ada aktivitas panen tercatat.</p>
 </div>
 @endforelse
 </div>
 </div>

 </div>

 </div>
 </div>
</x-app-layout>


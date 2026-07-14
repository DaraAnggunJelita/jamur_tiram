@extends('layouts.app')

@section('content')
<div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- === PAGE HEADER === --}}
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
 <div>
 <h1 class="text-2xl font-bold text-[#064E3B]">Laporan Panen</h1>
 <p class="text-[#6B7280] text-sm mt-1 font-medium">Rekapitulasi seluruh laporan panen KUPS Harapan Asri</p>
 </div>
 {{-- Download Buttons --}}
 <div class="flex items-center gap-3">
 {{-- PDF Button --}}
 <a href="{{ route('ketua.reports.export.pdf') }}"
 id="btn-download-pdf"
 class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#F59E0B] hover:bg-[#8E5530] text-white text-xs font-bold rounded-xl shadow-md shadow-[#F59E0B]/20 hover:shadow-lg hover:-translate-y-0.5 transform transition-all duration-200">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
 d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
 </svg>
 Download PDF
 </a>
 {{-- Excel Button --}}
 <a href="{{ route('ketua.reports.export.excel') }}"
 id="btn-download-excel"
 class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl shadow-md shadow-[#059669]/20 hover:shadow-lg hover:-translate-y-0.5 transform transition-all duration-200">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
 d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
 </svg>
 Download Excel
 </a>
 {{-- Preview Button --}}
 <a href="{{ route('ketua.reports.print') }}" target="_blank"
 class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#E6DAC2]/60 hover:bg-[#E6DAC2] text-[#047857] text-xs font-bold rounded-xl border border-[#E5E7EB]/60 transition-all duration-200">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
 d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
 </svg>
 Preview
 </a>
 </div>
 </div>

 {{-- === STAT CARDS === --}}
 <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/40 p-5 shadow-xs flex items-center gap-4">
 <div class="w-12 h-12 bg-[#34D399]/15 text-[#059669] rounded-xl flex items-center justify-center shrink-0">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
 </svg>
 </div>
 <div>
 <p class="text-[9px] font-bold text-[#6B7280]">Laporan Valid</p>
 <p class="text-2xl font-bold text-[#064E3B] mt-0.5">{{ $totalValid }}</p>
 </div>
 </div>
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/40 p-5 shadow-xs flex items-center gap-4">
 <div class="w-12 h-12 bg-[#E5E7EB]/20 text-[#047857] rounded-xl flex items-center justify-center shrink-0">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
 </svg>
 </div>
 <div>
 <p class="text-[9px] font-bold text-[#6B7280]">Menunggu Validasi</p>
 <p class="text-2xl font-bold text-[#064E3B] mt-0.5">{{ $totalPending }}</p>
 </div>
 </div>
 <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/40 p-5 shadow-xs flex items-center gap-4">
 <div class="w-12 h-12 bg-[#059669]/10 text-[#047857] rounded-xl flex items-center justify-center shrink-0">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
 </svg>
 </div>
 <div>
 <p class="text-[9px] font-bold text-[#6B7280]">Total Panen Valid</p>
 <p class="text-2xl font-bold text-[#064E3B] mt-0.5">{{ number_format($totalPanen, 1) }} <span class="text-base font-bold text-[#6B7280]">Kg</span></p>
 </div>
 </div>
 </div>

 {{-- === DATA TABLE === --}}
 <div class="bg-[#FFFFFF] rounded-2xl shadow-xs border border-[#E5E7EB]/40 overflow-hidden">
 <div class="px-6 py-4 border-b border-[#E5E7EB]/20 flex items-center justify-between">
 <h3 class="font-bold text-[#064E3B] text-base">Semua Data Laporan</h3>
 <span class="text-xs text-[#6B7280] font-bold">{{ $reports->count() }} total entri</span>
 </div>
 <div class="overflow-x-auto">
 <table class="min-w-full divide-y divide-[#E5E7EB]/20">
 <thead class="bg-[#F3F5F4]/50">
 <tr>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">No</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Tanggal</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Petugas</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Jumlah (Kg)</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Kondisi</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Status</th>
 </tr>
 </thead>
 <tbody class="bg-white divide-y divide-[#E5E7EB]/15 text-[#374151]">
 @forelse($reports as $i => $r)
 <tr class="hover:bg-[#F3F5F4]/30 transition duration-100">
 <td class="px-6 py-4 text-xs text-[#E5E7EB] font-bold">{{ $i + 1 }}</td>
 <td class="px-6 py-4 text-sm font-bold text-[#064E3B]">
 {{ \Carbon\Carbon::parse($r->tanggal)->isoFormat('D MMM Y') }}
 </td>
 <td class="px-6 py-4 text-sm font-medium text-[#374151]">{{ optional($r->user)->name ?:'-' }}</td>
 <td class="px-6 py-4 text-sm font-bold text-[#059669]">{{ number_format($r->jumlah_panen, 1) }} Kg</td>
 <td class="px-6 py-4 text-sm">
 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold border 
 {{ $r->kualitas_panen ==='Kualitas Bagus' ?'bg-[#34D399]/15 text-[#047857] border-[#34D399]/30' :
 ($r->kualitas_panen ==='Kualitas Cukup' ?'bg-[#E5E7EB]/20 text-[#047857] border-[#E5E7EB]/40' :'bg-[#F59E0B]/10 text-[#F59E0B] border-[#F59E0B]/20') }}">
 {{ $r->kualitas_panen }}
 </span>
 </td>
 <td class="px-6 py-4 text-sm">
 @if ($r->status_validasi ==='valid')
 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#34D399]/15 text-[#047857] border border-[#34D399]/30">✓ Valid</span>
 @elseif ($r->status_validasi ==='pending')
 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#E5E7EB]/20 text-[#047857] border border-[#E5E7EB]/40 animate-pulse"><svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'/></svg> Menunggu</span>
 @else
 <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#F59E0B]/10 text-[#F59E0B] border border-[#F59E0B]/20">✕ Invalid</span>
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class="px-6 py-16 text-center">
 <div class="w-14 h-14 bg-[#F3F5F4] border border-[#E5E7EB]/40 rounded-2xl flex items-center justify-center mx-auto mb-3 text-2xl shadow-2xs">
 <svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'/></svg>
 </div>
 <p class="text-sm font-bold text-[#064E3B]">Belum Ada Data Laporan</p>
 <p class="text-xs text-[#6B7280] mt-1 font-medium">Laporan akan muncul setelah petugas menginputkan data panen.</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>

 </div>
</div>
@endsection


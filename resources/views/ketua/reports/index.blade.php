@extends('layouts.app')

@section('content')
<div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- === PAGE HEADER === --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-[#26201B] tracking-tight font-heading">Laporan Panen</h1>
                <p class="text-[#8E6E4E] text-sm mt-1 font-medium">Rekapitulasi seluruh laporan panen KUPS Harapan Asri</p>
            </div>
            {{-- Download Buttons --}}
            <div class="flex items-center gap-3">
                {{-- PDF Button --}}
                <a href="{{ route('ketua.reports.export.pdf') }}"
                   id="btn-download-pdf"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#A0653D] hover:bg-[#8E5530] text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-md shadow-[#A0653D]/20 hover:shadow-lg hover:-translate-y-0.5 transform transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download PDF
                </a>
                {{-- Excel Button --}}
                <a href="{{ route('ketua.reports.export.excel') }}"
                   id="btn-download-excel"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-md shadow-[#4F6146]/20 hover:shadow-lg hover:-translate-y-0.5 transform transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Excel
                </a>
                {{-- Preview Button --}}
                <a href="{{ route('ketua.reports.print') }}" target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#E6DAC2]/60 hover:bg-[#E6DAC2] text-[#6B4E36] text-xs font-black uppercase tracking-widest rounded-xl border border-[#C9B896]/60 transition-all duration-200">
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
            <div class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/40 p-5 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 bg-[#7C9169]/15 text-[#4F6146] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[9px] font-black text-[#8E6E4E] uppercase tracking-widest font-mono-data">Laporan Valid</p>
                    <p class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ $totalValid }}</p>
                </div>
            </div>
            <div class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/40 p-5 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 bg-[#C9B896]/20 text-[#6B4E36] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[9px] font-black text-[#8E6E4E] uppercase tracking-widest font-mono-data">Menunggu Validasi</p>
                    <p class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ $totalPending }}</p>
                </div>
            </div>
            <div class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/40 p-5 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 bg-[#4F6146]/10 text-[#37452F] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[9px] font-black text-[#8E6E4E] uppercase tracking-widest font-mono-data">Total Panen Valid</p>
                    <p class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ number_format($totalPanen, 1) }} <span class="text-base font-bold text-[#8E6E4E]">Kg</span></p>
                </div>
            </div>
        </div>

        {{-- === DATA TABLE === --}}
        <div class="bg-[#FBF8F1] rounded-2xl shadow-xs border border-[#C9B896]/40 overflow-hidden">
            <div class="px-6 py-4 border-b border-[#C9B896]/20 flex items-center justify-between">
                <h3 class="font-black text-[#26201B] text-base font-heading tracking-tight">Semua Data Laporan</h3>
                <span class="text-xs text-[#8E6E4E] font-bold font-mono-data">{{ $reports->count() }} total entri</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#C9B896]/20">
                    <thead class="bg-[#F6F1E6]/50">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">No</th>
                            <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Tanggal</th>
                            <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Petugas</th>
                            <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Jumlah (Kg)</th>
                            <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Kondisi</th>
                            <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#C9B896]/15 text-[#362C24]">
                        @forelse($reports as $i => $r)
                            <tr class="hover:bg-[#F6F1E6]/30 transition duration-100">
                                <td class="px-6 py-4 text-xs text-[#C9B896] font-bold font-mono-data">{{ $i + 1 }}</td>
                                <td class="px-6 py-4 text-sm font-black text-[#26201B] font-mono-data">
                                    {{ \Carbon\Carbon::parse($r->tanggal)->isoFormat('D MMM Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-[#362C24]">{{ optional($r->user)->name ?: '-' }}</td>
                                <td class="px-6 py-4 text-sm font-black text-[#4F6146] font-mono-data">{{ number_format($r->jumlah_panen, 1) }} Kg</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border font-mono-data
                                        {{ $r->kualitas_panen === 'Kualitas Bagus' ? 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30' :
                                          ($r->kualitas_panen === 'Kualitas Cukup' ? 'bg-[#C9B896]/20 text-[#6B4E36] border-[#C9B896]/40' : 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20') }}">
                                        {{ $r->kualitas_panen }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($r->status_validasi === 'valid')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#7C9169]/15 text-[#37452F] border border-[#7C9169]/30 font-mono-data">✓ Valid</span>
                                    @elseif ($r->status_validasi === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#C9B896]/20 text-[#6B4E36] border border-[#C9B896]/40 animate-pulse font-mono-data"><svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'/></svg> Menunggu</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#A0653D]/10 text-[#A0653D] border border-[#A0653D]/20 font-mono-data">✕ Invalid</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="w-14 h-14 bg-[#F6F1E6] border border-[#C9B896]/40 rounded-2xl flex items-center justify-center mx-auto mb-3 text-2xl shadow-2xs">
                                        <svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'/></svg>
                                    </div>
                                    <p class="text-sm font-black text-[#26201B] font-heading">Belum Ada Data Laporan</p>
                                    <p class="text-xs text-[#8E6E4E] mt-1 font-medium">Laporan akan muncul setelah petugas menginputkan data panen.</p>
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


@extends('layouts.app')

@section('content')
<div class="py-8 bg-[#F3F5F4] min-h-screen text-[#374151]">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- === PAGE HEADER === --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3 font-sans">
                <a href="{{ route('ketua.dashboard') }}"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                    title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <h1 class="text-base font-bold text-[#064E3B] truncate">Cetak Laporan</h1>
            </div>
            {{-- Download Buttons (Sejajar dalam 1 Baris Horizontal) --}}
            <div class="flex flex-row flex-nowrap items-center gap-2 shrink-0 overflow-x-auto pb-1 md:pb-0">
                {{-- Excel Button --}}
                <a href="{{ route('ketua.reports.export.excel', request()->query()) }}"
                    id="btn-download-excel"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl shadow-xs transition duration-150 shrink-0 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Excel
                </a>
                {{-- PDF Button --}}
                <a href="{{ route('ketua.reports.export.pdf', request()->query()) }}"
                    id="btn-download-pdf"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[#F59E0B] hover:bg-[#8E5530] text-white text-xs font-bold rounded-xl shadow-xs transition duration-150 shrink-0 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>

        {{-- === KOTAK FILTER PERIODE === --}}
        <div class="bg-[#FFFFFF] rounded-2xl border border-[#E5E7EB]/70 p-5 shadow-2xs">
            <div class="flex items-center gap-2 mb-3.5">
                <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                <h3 class="text-xs font-extrabold text-[#064E3B] uppercase tracking-wider">Filter Periode Laporan</h3>
            </div>

            <form method="GET" action="{{ route('ketua.reports.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-4 items-end">
                {{-- Pencarian --}}
                <div id="wrapper_search">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Cari Petugas</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Pilih/ketik nama..." list="petugas-list" autocomplete="off"
                           class="w-full text-xs font-bold rounded-xl border-gray-300 shadow-2xs focus:border-[#059669] focus:ring focus:ring-[#059669]/20" />
                    <datalist id="petugas-list">
                        @foreach($petugasList as $p)
                            <option value="{{ $p->name }}"></option>
                        @endforeach
                    </datalist>
                </div>

                {{-- Pilihan Periode --}}
                <div>
                    {{-- <label class="block text-xs font-bold text-gray-700 mb-1">Tipe Periode</label> --}}
                    <select name="tipe" id="filter_tipe" onchange="toggleFilterFields()" class="w-full text-xs font-bold rounded-xl border-gray-300 shadow-2xs focus:border-[#059669] focus:ring focus:ring-[#059669]/20">
                        <option value="semua" {{ ($tipe ?? 'semua') == 'semua' ? 'selected' : '' }}>Semua Data</option>
                        <option value="mingguan" {{ ($tipe ?? '') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="bulanan" {{ ($tipe ?? '') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ ($tipe ?? '') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                    </select>
                </div>

                {{-- Pilihan Minggu (Khusus Mingguan) --}}
                <div id="wrapper_minggu" class="{{ ($tipe ?? 'semua') === 'mingguan' ? '' : 'hidden' }}">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Pilih Minggu Ke-</label>
                    <select name="minggu" id="filter_minggu" class="w-full text-xs font-bold rounded-xl border-gray-300 shadow-2xs focus:border-[#059669] focus:ring focus:ring-[#059669]/20">
                        <option value="1" {{ ($minggu ?? 1) == 1 ? 'selected' : '' }}>Minggu Ke-1 (Tgl 1 - 7)</option>
                        <option value="2" {{ ($minggu ?? 1) == 2 ? 'selected' : '' }}>Minggu Ke-2 (Tgl 8 - 14)</option>
                        <option value="3" {{ ($minggu ?? 1) == 3 ? 'selected' : '' }}>Minggu Ke-3 (Tgl 15 - 21)</option>
                        <option value="4" {{ ($minggu ?? 1) == 4 ? 'selected' : '' }}>Minggu Ke-4 (Tgl 22 - 28)</option>
                        <option value="5" {{ ($minggu ?? 1) == 5 ? 'selected' : '' }}>Minggu Ke-5 (Tgl 29 - Akhir)</option>
                    </select>
                </div>

                {{-- Pilihan Bulan (Mingguan & Bulanan) --}}
                <div id="wrapper_bulan" class="{{ in_array(($tipe ?? 'semua'), ['mingguan', 'bulanan']) ? '' : 'hidden' }}">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Pilih Bulan</label>
                    <select name="bulan" id="filter_bulan" class="w-full text-xs font-bold rounded-xl border-gray-300 shadow-2xs focus:border-[#059669] focus:ring focus:ring-[#059669]/20">
                        @php
                            $namesBulan = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
                        @endphp
                        @foreach($namesBulan as $num => $monthName)
                            <option value="{{ $num }}" {{ ($bulan ?? now()->month) == $num ? 'selected' : '' }}>{{ $monthName }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilihan Tahun --}}
                <div id="wrapper_tahun" class="{{ ($tipe ?? 'semua') === 'semua' ? 'hidden' : '' }}">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Pilih Tahun</label>
                    <select name="tahun" id="filter_tahun" class="w-full text-xs font-bold rounded-xl border-gray-300 shadow-2xs focus:border-[#059669] focus:ring focus:ring-[#059669]/20">
                        @for($y = 2024; $y <= 2030; $y++)
                            <option value="{{ $y }}" {{ ($tahun ?? now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center gap-2">
                    <button type="submit" class="w-full px-4 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-extrabold rounded-xl shadow-xs transition duration-150 cursor-pointer">
                        Tampilkan
                    </button>
                    @if(($tipe ?? 'semua') !== 'semua' || request()->filled('search'))
                        <a href="{{ route('ketua.reports.index') }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition duration-150 text-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- === STAT CARDS === --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl border border-[#E5E7EB]/60 p-4 shadow-2xs flex items-center gap-3.5">
                <div class="w-11 h-11 bg-[#34D399]/15 text-[#059669] rounded-xl flex items-center justify-center shrink-0 border border-emerald-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-[#6B7280] uppercase">Laporan Valid</p>
                    <p class="text-xl font-black text-[#064E3B] mt-0.5">{{ $totalValid }} <span class="text-xs font-normal text-gray-500">Entri</span></p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-[#E5E7EB]/60 p-4 shadow-2xs flex items-center gap-3.5">
                <div class="w-11 h-11 bg-[#E5E7EB]/30 text-[#047857] rounded-xl flex items-center justify-center shrink-0 border border-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-[#6B7280] uppercase">Menunggu Validasi</p>
                    <p class="text-xl font-black text-[#064E3B] mt-0.5">{{ $totalPending }} <span class="text-xs font-normal text-gray-500">Entri</span></p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-[#E5E7EB]/60 p-4 shadow-2xs flex items-center gap-3.5">
                <div class="w-11 h-11 bg-[#059669]/10 text-[#047857] rounded-xl flex items-center justify-center shrink-0 border border-emerald-200/50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-[#6B7280] uppercase">Total Panen Valid</p>
                    <p class="text-xl font-black text-[#064E3B] mt-0.5">{{ number_format($totalPanen, 1) }} <span class="text-xs font-bold text-[#6B7280]">Kg</span></p>
                </div>
            </div>
        </div>

        {{-- === DATA TABLE === --}}
        <div class="bg-white rounded-xl shadow-2xs border border-[#E5E7EB]/70 overflow-hidden">
            <div class="px-5 py-3.5 border-b border-[#E5E7EB]/40 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h3 class="font-extrabold text-[#064E3B] text-sm">{{ $judulPeriode ?? 'Semua Data Laporan' }}</h3>
                    {{-- <p class="text-[11px] text-gray-400 font-medium">Menampilkan riwayat pencatatan hasil panen jamur tiram.</p> --}}
                </div>
                <span class="text-xs text-[#047857] font-extrabold px-3 py-1 bg-emerald-50 rounded-lg border border-emerald-100 self-start sm:self-auto">{{ $reports->count() }} total entri</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#E5E7EB]/20 text-xs">
                    <thead class="bg-[#F3F5F4]/70">
                        <tr>
                            <th class="px-5 py-3 text-left font-bold text-[#047857] uppercase">No</th>
                            <th class="px-5 py-3 text-left font-bold text-[#047857] uppercase">Tanggal</th>
                            <th class="px-5 py-3 text-left font-bold text-[#047857] uppercase">Petugas</th>
                            <th class="px-5 py-3 text-left font-bold text-[#047857] uppercase">Jumlah (Kg)</th>
                            <th class="px-5 py-3 text-left font-bold text-[#047857] uppercase">Distribusi Grade</th>
                            <th class="px-5 py-3 text-left font-bold text-[#047857] uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#E5E7EB]/20 text-[#374151]">
                        @forelse($reports as $i => $r)
                        <tr class="hover:bg-[#F3F5F4]/30 transition duration-100">
                            <td class="px-5 py-3 text-gray-400 font-bold">{{ $i + 1 }}</td>
                            <td class="px-5 py-3 font-extrabold text-[#064E3B]">
                                {{ \Carbon\Carbon::parse($r->tanggal)->isoFormat('D MMM Y') }}
                            </td>
                            <td class="px-5 py-3 font-bold text-gray-800">{{ optional($r->user)->name ?: '-' }}</td>
                            <td class="px-5 py-3 font-black text-[#059669] text-sm">{{ (float)($r->jumlah_panen) }} Kg</td>
                            <td class="px-5 py-3">
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[11px] font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                    <span class="text-emerald-700">A: {{ (float)($r->berat_grade_a) }} Kg</span>
                                    <span>•</span>
                                    <span class="text-amber-700">B: {{ (float)($r->berat_grade_b) }} Kg</span>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                @if ($r->status_validasi === 'valid')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-black bg-emerald-100 text-emerald-800 border border-emerald-200">✓ Valid</span>
                                @elseif ($r->status_validasi === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200 animate-pulse">⏳ Menunggu</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-red-100 text-red-800 border border-red-200">✕ Invalid</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center">
                                <div class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-2 text-lg shadow-2xs">
                                    📋
                                </div>
                                <p class="text-xs font-bold text-gray-700">Tidak Ada Data Laporan pada Periode Ini</p>
                                <p class="text-[11px] text-gray-400 mt-0.5 font-medium">Silakan ubah filter periode di atas atau reset untuk melihat semua data.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 px-2">
                {{ $reports->links() }}
            </div>
        </div>

    </div>
</div>

<script>
    function toggleFilterFields() {
        const tipe = document.getElementById('filter_tipe').value;
        const wrapperMinggu = document.getElementById('wrapper_minggu');
        const wrapperBulan = document.getElementById('wrapper_bulan');
        const wrapperTahun = document.getElementById('wrapper_tahun');

        if (tipe === 'semua') {
            wrapperMinggu.classList.add('hidden');
            wrapperBulan.classList.add('hidden');
            wrapperTahun.classList.add('hidden');
        } else if (tipe === 'tahunan') {
            wrapperMinggu.classList.add('hidden');
            wrapperBulan.classList.add('hidden');
            wrapperTahun.classList.remove('hidden');
        } else if (tipe === 'bulanan') {
            wrapperMinggu.classList.add('hidden');
            wrapperBulan.classList.remove('hidden');
            wrapperTahun.classList.remove('hidden');
        } else if (tipe === 'mingguan') {
            wrapperMinggu.classList.remove('hidden');
            wrapperBulan.classList.remove('hidden');
            wrapperTahun.classList.remove('hidden');
        }
    }
</script>
@endsection

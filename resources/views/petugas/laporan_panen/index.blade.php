<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Kelola Laporan Hasil Panen') }}
 </h2>
 <span class="bg-[#E6DAC2] text-[#047857] text-xs font-bold px-3 py-1 rounded-full border border-[#E5E7EB]/60">
 Pencatatan Produksi
 </span>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- Alert Notifikasi Sukses --}}
 @if (session('success'))
 <div class="bg-[#34D399]/10 border-l-4 border-[#059669] text-[#047857] p-4 rounded-r shadow-2xs flex items-center space-x-3 font-sans" role="alert">
 <svg class="w-5 h-5 text-[#059669] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
 <div>
 <p class="font-bold text-sm">Berhasil!</p>
 <p class="text-xs font-medium">{{ session('success') }}</p>
 </div>
 </div>
 @endif

 @if (session('error'))
 <div class="bg-[#F59E0B]/10 border-l-4 border-[#F59E0B] text-[#F59E0B] p-4 rounded-r shadow-2xs flex items-center space-x-3 font-sans" role="alert">
 <svg class="w-5 h-5 text-[#F59E0B] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
 <div>
 <p class="font-bold text-sm">Gagal!</p>
 <p class="text-xs font-medium">{{ session('error') }}</p>
 </div>
 </div>
 @endif

 {{-- === TABEL RIWAYAT LAPORAN === --}}
 <div class="bg-[#FFFFFF] overflow-hidden shadow-xs rounded-2xl border border-[#E5E7EB]/40">
 <div class="p-6">
 {{-- Header Tabel --}}
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 mb-6 border-b border-[#E5E7EB]/20">
 <div class="flex items-center space-x-2.5">
 <div class="w-8 h-8 bg-[#059669]/10 rounded-lg flex items-center justify-center text-[#059669]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
 </div>
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Semua Riwayat Laporan Panen</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Daftar lengkap laporan produksi jamur yang Anda kirimkan.</p>
 </div>
 </div>
 <a href="{{ route('petugas.laporan-panen.create') }}"
 class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
 Input Hasil Panen
 </a>
 </div>

 {{-- Form Filter & Pencarian --}}
 <form method="GET" action="{{ route('petugas.laporan-panen.index') }}" class="flex flex-col sm:flex-row items-center gap-4 mb-6">
 <div class="w-full sm:w-1/2">
 <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan petugas..." class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 500);">
 </div>
 <div class="w-full sm:w-1/3">
 <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" title="Pilih Tanggal" onchange="this.form.submit()">
 </div>
 <div class="w-full sm:w-auto flex items-center gap-2">
 <button type="submit" class="p-2.5 bg-[#059669] text-white rounded-xl hover:bg-[#047857] transition shadow-md shadow-[#059669]/10" title="Filter">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
 </button>
 <a href="{{ route('petugas.laporan-panen.index') }}" class="p-2.5 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition shadow-md" title="Reset">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
 </a>
 </div>
 </form>

 <div class="space-y-6">
 @forelse ($inokulasis as $inokulasi)
 <div class="bg-white overflow-hidden shadow-xs rounded-2xl border border-[#E5E7EB]/40">
 <div class="p-6 bg-[#F3F5F4]/30 border-b border-[#E5E7EB]/40 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
 <div class="flex items-center space-x-3">
 <div class="w-10 h-10 bg-[#059669]/10 rounded-xl flex items-center justify-center text-[#059669]">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
 </div>
 <div>
 <h4 class="text-sm font-bold text-[#064E3B]">Batch: {{ $inokulasi->sterilisasi->baglog->kode_batch ?? 'Unknown' }}</h4>
 <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] text-[#6B7280]">
 <span title="Tanggal Inokulasi (Bibit Disuntikkan)"><strong class="text-[#064E3B]">Disuntik:</strong> {{ \Carbon\Carbon::parse($inokulasi->tanggal)->isoFormat('D MMM Y') }}</span>
 <span class="hidden sm:inline text-gray-300">|</span>
 <span title="Estimasi 40 hari setelah disuntik (Buka Kapas/Mulai Panen)"><strong class="text-amber-600">Est. Mulai Panen:</strong> {{ \Carbon\Carbon::parse($inokulasi->tanggal)->addDays(40)->isoFormat('D MMM Y') }}</span>
 <span class="hidden sm:inline text-gray-300">|</span>
 <span title="Estimasi 5x panen (jarak 1-2 hari per panen)"><strong class="text-red-600">Est. Afkir:</strong> {{ \Carbon\Carbon::parse($inokulasi->tanggal)->addDays(50)->isoFormat('D MMM Y') }}</span>
 </div>
 </div>
 </div>
 <div class="flex items-center gap-2">
 @php
 $validReportsCount = $inokulasi->productionReports->where('status_validasi', '!=', 'dibatalkan')->count();
 @endphp
 <span class="bg-[#059669] text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md shadow-[#059669]/10">
 {{ $validReportsCount }} / 5 Panen
 </span>
 @if ($validReportsCount < 5)
 <a href="{{ route('petugas.laporan-panen.create') }}" class="text-xs text-[#059669] font-bold hover:underline">
 + Tambah Laporan
 </a>
 @else
 <span class="flex items-center gap-1">
 <span class="text-[10px] bg-red-100 text-red-700 px-2 py-1 rounded-full font-bold">Afkir</span>
 <span class="text-[10px] text-gray-500 font-bold italic">Selesai Panen</span>
 </span>
 @endif
 </div>
 </div>
 <div class="overflow-x-auto">
 <table class="min-w-full divide-y divide-[#E5E7EB]/20">
 <thead class="bg-gray-50/50">
 <tr>
 <th class="px-6 py-3 text-left text-[11px] font-bold text-[#047857] uppercase tracking-wider">Siklus</th>
 <th class="px-6 py-3 text-left text-[11px] font-bold text-[#047857] uppercase tracking-wider">Tanggal</th>
 <th class="px-6 py-3 text-center text-[11px] font-bold text-[#047857] uppercase tracking-wider">Grade A</th>
 <th class="px-6 py-3 text-center text-[11px] font-bold text-[#047857] uppercase tracking-wider">Grade B</th>
 <th class="px-6 py-3 text-center text-[11px] font-bold text-[#047857] uppercase tracking-wider">Total</th>
 <th class="px-6 py-3 text-center text-[11px] font-bold text-[#047857] uppercase tracking-wider">Status</th>
 <th class="px-6 py-3 text-center text-[11px] font-bold text-[#047857] uppercase tracking-wider">Aksi</th>
 </tr>
 </thead>
 <tbody class="bg-white divide-y divide-[#E5E7EB]/15 text-[#374151]">
 @foreach ($inokulasi->productionReports as $report)
 <tr class="hover:bg-[#F3F5F4]/30 transition duration-150">
 <td class="px-6 py-3 whitespace-nowrap text-xs font-bold text-[#059669]">
 Ke-{{ $report->siklus_panen }}
 </td>
 <td class="px-6 py-3 whitespace-nowrap text-xs font-medium text-[#064E3B]">
 {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMM Y') }}
 </td>
 <td class="px-6 py-3 whitespace-nowrap text-center text-xs font-bold text-green-700">
 {{ number_format($report->berat_grade_a, 1) }} Kg
 </td>
 <td class="px-6 py-3 whitespace-nowrap text-center text-xs font-bold text-red-700">
 {{ number_format($report->berat_grade_b, 1) }} Kg
 </td>
 <td class="px-6 py-3 whitespace-nowrap text-center text-xs font-bold text-[#059669]">
 {{ number_format($report->jumlah_panen, 1) }} Kg
 </td>
 <td class="px-6 py-3 whitespace-nowrap text-center">
 @if ($report->status_validasi ==='pending')
 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#E5E7EB]/20 text-[#047857] border border-[#E5E7EB]/40 animate-pulse">
 Menunggu
 </span>
 @elseif ($report->status_validasi ==='valid')
 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#34D399]/15 text-[#047857] border border-[#34D399]/30">
 Valid
 </span>
 @elseif ($report->status_validasi ==='dibatalkan')
 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500 border border-gray-300">
 Dibatalkan
 </span>
 @else
 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#F59E0B]/10 text-[#F59E0B] border border-[#F59E0B]/20">
 Invalid
 </span>
 @endif
 </td>
 <td class="px-6 py-3 whitespace-nowrap text-center text-xs font-bold">
 @if ($report->status_validasi ==='pending')
 <div class="flex items-center justify-center space-x-2">
 <a href="{{ route('petugas.laporan-panen.edit', $report->id) }}"
 class="inline-flex items-center px-2 py-1 bg-[#E6DAC2]/40 hover:bg-[#E6DAC2]/80 text-[#047857] rounded-lg transition duration-150" title="Edit">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
 </a>
 <form action="{{ route('petugas.laporan-panen.destroy', $report->id) }}" method="POST"
 onsubmit="return confirm('Apakah Anda yakin ingin membatalkan laporan ini? Data akan tersimpan sebagai log audit.');"
 class="inline-block m-0">
 @csrf
 @method('DELETE')
 <button type="submit"
 class="inline-flex items-center px-2 py-1 bg-[#F59E0B]/10 hover:bg-[#F59E0B] hover:text-white text-[#F59E0B] rounded-lg transition duration-150 cursor-pointer" title="Batalkan">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
 </button>
 </form>
 </div>
 @else
 <span class="text-[#E5E7EB] text-[10px] italic font-medium">Terkunci</span>
 @endif
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 </div>
 @empty
 <div class="bg-white p-12 text-center rounded-2xl shadow-xs border border-[#E5E7EB]/40">
 <div class="w-16 h-16 bg-[#F3F5F4] border border-[#E5E7EB]/40 text-[#6B7280] rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl shadow-2xs">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
 </div>
 <p class="text-base font-bold text-[#064E3B]">Belum ada riwayat laporan produksi.</p>
 <p class="text-xs text-[#6B7280] mt-1">Klik "Input Hasil Panen" di atas untuk mulai melaporkan.</p>
 </div>
 @endforelse
 </div>

 {{-- Pagination --}}
 <div class="mt-8">
 {{ $inokulasis->links() }}
 </div>
 </div>
 </div>

 </div>
 </div>
</x-app-layout>

<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Verifikasi Laporan Panen') }}
 </h2>
 <span class="bg-[#E6DAC2] text-[#047857] text-xs font-bold px-3 py-1 rounded-full border border-[#E5E7EB]/60">
 Wewenang Ketua KUPS
 </span>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 @if (session('success'))
 <div class="bg-[#34D399]/10 border-l-4 border-[#059669] text-[#047857] p-4 rounded-r shadow-2xs flex items-center space-x-3 font-sans" role="alert">
 <svg class="w-5 h-5 text-[#059669] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
 <div>
 <p class="font-bold text-sm">Berhasil!</p>
 <p class="text-xs font-medium">{{ session('success') }}</p>
 </div>
 </div>
 @endif

 <div class="bg-[#FFFFFF] overflow-hidden shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-6">
 <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#E5E7EB]/20">
 <div class="w-8 h-8 bg-[#10B981]/10 rounded-lg flex items-center justify-center text-[#10B981]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
 </div>
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Antrean Laporan Petugas</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Tinjau dan validasi hasil pencatatan panen sebelum dimasukkan ke rekapitulasi utama.</p>
 </div>
 </div>

 <div class="overflow-x-auto rounded-xl border border-[#E5E7EB]/30">
 <table class="min-w-full divide-y divide-[#E5E7EB]/20">
 <thead class="bg-[#F3F5F4]/50">
 <tr>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Tanggal & Petugas</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Berat (Kg)</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Kondisi & Distribusi</th>
 <th class="px-6 py-3.5 text-center text-xs font-bold text-[#047857]">Aksi Validasi</th>
 </tr>
 </thead>
 <tbody class="bg-white divide-y divide-[#E5E7EB]/15 text-[#374151]">
 @forelse ($reports as $report)
 <tr class="hover:bg-[#F3F5F4]/30 transition duration-150 {{ $report->status_validasi !=='pending' ?'opacity-70 bg-gray-50' :'' }}">
 <td class="px-6 py-4 whitespace-nowrap">
 <div class="text-sm font-bold text-[#064E3B]">
 {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
 </div>
 <div class="text-xs font-medium text-[#6B7280] mt-1 flex items-center">
 <span class="mr-1">
 <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
 </span> {{ $report->user->name ??'Petugas' }}
 </div>
 </td>
 <td class="px-6 py-4 whitespace-nowrap">
 <span class="text-sm font-bold text-[#059669] bg-[#059669]/10 px-2.5 py-1 rounded-md border border-[#059669]/20">
 {{ number_format($report->jumlah_panen, 1) }} Kg
 </span>
 <div class="text-xs text-[#6B7280] font-medium mt-1">
 Grade A: {{ number_format($report->berat_grade_a, 1) }} Kg | Grade B: {{ number_format($report->berat_grade_b, 1) }} Kg
 </div>
 </td>
 <td class="px-6 py-4 whitespace-nowrap">
 <div class="flex flex-col space-y-2">
 <span class="inline-flex w-max items-center px-2.5 py-1 text-[10px] font-bold rounded-full border bg-[#34D399]/15 text-[#047857] border-[#34D399]/30">
 [Grade A] ➔ Pasar Segar
 </span>
 @if($report->berat_grade_b > 0)
 <span class="inline-flex w-max items-center px-2.5 py-1 text-[10px] font-bold rounded-full border bg-[#F59E0B]/10 text-[#F59E0B] border-[#F59E0B]/20">
 [Grade B] ➔ Olahan Rendang
 </span>
 @endif
 </div>
 </td>
 <td class="px-6 py-4 text-center">
 @if($report->status_validasi ==='pending')
 <div class="flex items-center justify-center space-x-2">
 <form action="{{ route('ketua.verifikasi.process', $report->id) }}" method="POST" class="inline">
 @csrf
 <input type="hidden" name="status_validasi" value="valid">
 <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg shadow-md transition duration-150 cursor-pointer">
 <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Setujui
 </button>
 </form>
 
 <form action="{{ route('ketua.verifikasi.process', $report->id) }}" method="POST" class="inline">
 @csrf
 <input type="hidden" name="status_validasi" value="invalid">
 <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg shadow-md transition duration-150 cursor-pointer">
 <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Tolak
 </button>
 </form>
 </div>
 @else
 <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold 
 {{ $report->status_validasi ==='valid' ?'bg-green-100 text-green-700' :'bg-red-100 text-red-700' }}">
 {{ ucfirst($report->status_validasi) }}
 </span>
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-12 text-center">
 <p class="text-sm font-bold text-[#064E3B]">Tidak ada laporan.</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>
</x-app-layout>

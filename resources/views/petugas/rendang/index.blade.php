<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Alokasi Kuliner Rendang Jamur') }}
 </h2>
 <span class="bg-[#F59E0B]/10 text-[#F59E0B] text-xs font-bold px-3 py-1 rounded-full border border-[#F59E0B]/30">
 Pengolahan Pasca Panen
 </span>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- Kartu Info --}}
 <div class="bg-gradient-to-r from-[#FFFFFF] to-[#F3F5F4] border border-[#E5E7EB]/50 rounded-2xl p-6 shadow-sm flex items-center justify-between">
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Daftar Jamur Kurang Optimal (Layu / Patah)</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-1">Data ini merupakan hasil sortir otomatis dari Pencatatan Panen untuk diolah menjadi produk bernilai tambah (Value Added Product) berupa Rendang Jamur.</p>
 </div>
 <div class="w-12 h-12 bg-[#F59E0B]/10 rounded-xl flex items-center justify-center text-[#F59E0B] shadow-inner shrink-0">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
 </div>
 </div>

 {{-- Tabel Daftar --}}
 <div class="bg-[#FFFFFF] overflow-hidden shadow-xs rounded-2xl border border-[#E5E7EB]/40">
 <div class="p-6">
 <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#E5E7EB]/20">
 <div class="w-8 h-8 bg-[#F59E0B]/10 rounded-lg flex items-center justify-center text-[#F59E0B]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
 </div>
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Riwayat Alokasi Bahan Baku Rendang</h3>
 </div>
 </div>
 </div>

 {{-- Form Filter & Pencarian --}}
 <form method="GET" action="{{ route('rendang.index') }}" class="flex flex-col sm:flex-row items-center gap-4 mb-6">
 <div class="w-full sm:w-1/2">
 <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan penyetor..." class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 500);">
 </div>
 <div class="w-full sm:w-1/3">
 <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" title="Pilih Tanggal" onchange="this.form.submit()">
 </div>
 <div class="w-full sm:w-auto flex items-center gap-2">
 <button type="submit" class="p-2.5 bg-[#059669] text-white rounded-xl hover:bg-[#047857] transition shadow-md shadow-[#059669]/10" title="Filter">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
 </button>
 <a href="{{ route('rendang.index') }}" class="p-2.5 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition shadow-md" title="Reset">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
 </a>
 </div>
 </form>

 <div class="overflow-x-auto rounded-xl border border-[#E5E7EB]/30">
 <table class="min-w-full divide-y divide-[#E5E7EB]/20">
 <thead class="bg-[#F3F5F4]/50">
 <tr>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Tanggal Masuk</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Petugas Penyetor</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Berat Bahan (Kg)</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Keterangan</th>
 </tr>
 </thead>
 <tbody class="bg-white divide-y divide-[#E5E7EB]/15 text-[#374151]">
 @forelse($panenBuruk as $panen)
 <tr class="hover:bg-[#F3F5F4]/30 transition duration-150">
 <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#064E3B]">
 {{ \Carbon\Carbon::parse($panen->tanggal)->isoFormat('D MMMM Y') }}
 </td>
 <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#6B7280]">
 {{ $panen->user->name ??'Petugas' }}
 </td>
 <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#F59E0B]">
 {{ number_format($panen->berat_grade_b, 1) }} Kg
 </td>
 <td class="px-6 py-4 whitespace-nowrap">
 <span class="inline-flex items-center px-2.5 py-1 bg-[#F59E0B]/10 text-[#F59E0B] text-[10px] font-bold rounded-full border border-[#F59E0B]/20">
 Pengolahan Kuliner Rendang
 </span>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-12 text-center">
 <div class="w-12 h-12 bg-[#F3F5F4] border border-[#E5E7EB]/40 text-[#6B7280] rounded-xl flex items-center justify-center mx-auto mb-3 text-xl shadow-2xs">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
 </div>
 <p class="text-sm font-bold text-[#064E3B]">Belum ada alokasi jamur rendang.</p>
 <p class="text-xs text-[#6B7280] mt-1 font-medium">Panen dengan kualitas buruk/layu akan otomatis tercatat di sini.</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>

 <div class="mt-4">
 {{ $panenBuruk->links() }}
 </div>
 </div>
 </div>

 </div>
 </div>
</x-app-layout>

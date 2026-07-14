<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <div class="flex items-center gap-3">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition duration-150 shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Input Batch Baglog Baru') }}
 </h2>
 </div>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">

 <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#E5E7EB]/20">
 <div class="w-8 h-8 bg-[#059669]/10 rounded-lg flex items-center justify-center text-[#059669]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
 </div>
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Data Pembuatan Baglog</h3>
 <p class="text-xs text-[#6B7280] font-medium">Catat batch baru baglog dengan relasi sumber bibit.</p>
 </div>
 </div>

 <form method="POST" action="{{ route('baglog.store') }}" class="space-y-5">
 @csrf


 {{-- Kode Batch --}}
 <div>
 <label for="kode_batch" class="block text-xs font-bold text-[#047857] mb-1.5">Kode Batch</label>
 <input type="text" id="kode_batch" name="kode_batch"
 placeholder="Contoh: BATCH-01" value="{{ old('kode_batch') }}" required
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium placeholder-[#6B7280]/50 @error('kode_batch') border-[#F59E0B] @enderror">
 @error('kode_batch')
 <p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>
 @enderror
 </div>

 {{-- Tanggal Pembuatan --}}
 <div>
 <label for="tanggal_pembuatan" class="block text-xs font-bold text-[#047857] mb-1.5">Tanggal Pembuatan</label>
 <input type="date" id="tanggal_pembuatan" name="tanggal_pembuatan"
 value="{{ old('tanggal_pembuatan', date('Y-m-d')) }}" required
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium @error('tanggal_pembuatan') border-[#F59E0B] @enderror">
 @error('tanggal_pembuatan')
 <p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>
 @enderror
 </div>


 {{-- Jumlah Baglog --}}
 <div>
 <label for="jumlah_baglog" class="block text-xs font-bold text-[#047857] mb-1.5">Jumlah Baglog Dibuat</label>
 <input type="number" id="jumlah_baglog" name="jumlah_baglog"
 placeholder="Contoh: 1500" value="{{ old('jumlah_baglog') }}" required min="1"
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium placeholder-[#6B7280]/50 @error('jumlah_baglog') border-[#F59E0B] @enderror">
 @error('jumlah_baglog')
 <p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>
 @enderror
 </div>

 <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end gap-3">
 <a href="{{ route('baglog.index') }}"
 class="px-5 py-2.5 text-sm font-bold text-[#6B7280] hover:text-[#064E3B] transition">
 Batal
 </a>
 <button type="submit"
 class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 cursor-pointer">
 Simpan Data Batch
 </button>
 </div>
 </form>

 </div>
 

 </div>
 </div>
</x-app-layout>

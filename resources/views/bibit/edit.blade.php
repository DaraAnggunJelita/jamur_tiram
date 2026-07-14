<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center gap-3 font-sans">
 <button onclick="history.back()" 
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Edit Stok Bibit Baru') }}
 </h2>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen font-sans">
 <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

 {{-- Form Card --}}
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
 <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#E5E7EB]/20">
 <div class="w-8 h-8 bg-[#34D399]/10 rounded-lg flex items-center justify-center text-[#059669]">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
 </div>
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Formulir Edit Stok Bibit</h3>
 <p class="text-xs text-[#6B7280] font-medium">Ubah data stok bibit (Kode: {{ $bibit->kode_bibit }}).</p>
 </div>
 </div>

 <form method="POST" action="{{ route('bibit.update', $bibit->id) }}" class="space-y-5">
 @csrf
 @method('PUT')

 <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
 {{-- Kode Bibit --}}
 <div class="md:col-span-2">
 <label for="kode_bibit" class="block text-xs font-bold text-[#047857] mb-1.5">Kode Bibit (Otomatis/Manual)</label>
 <input type="text" id="kode_bibit" name="kode_bibit" 
 value="{{ old('kode_bibit', $bibit->kode_bibit) }}" required 
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-bold @error('kode_bibit') border-[#F59E0B] @enderror">
 @error('kode_bibit')
 <p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>
 @enderror
 </div>

 {{-- Asal Bibit --}}
 <div class="md:col-span-2">
 <label for="asal_bibit" class="block text-xs font-bold text-[#047857] mb-1.5">Asal Bibit</label>
 <input type="text" id="asal_bibit" name="asal_bibit" 
 value="{{ old('asal_bibit', $bibit->asal_bibit) }}" required 
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium placeholder-[#6B7280]/50 @error('asal_bibit') border-[#F59E0B] @enderror">
 @error('asal_bibit')
 <p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>
 @enderror
 </div>

 {{-- Tanggal Masuk --}}
 <div>
 <label for="tanggal_masuk" class="block text-xs font-bold text-[#047857] mb-1.5">Tanggal Masuk</label>
 <input type="date" id="tanggal_masuk" name="tanggal_masuk" 
 value="{{ old('tanggal_masuk', $bibit->tanggal_masuk) }}" required
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium @error('tanggal_masuk') border-[#F59E0B] @enderror">
 @error('tanggal_masuk')
 <p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>
 @enderror
 </div>

 {{-- Jumlah Botol --}}
 <div>
 <label for="jumlah" class="block text-xs font-bold text-[#047857] mb-1.5">Jumlah Botol</label>
 <input type="number" id="jumlah" name="jumlah" min="1"
 value="{{ old('jumlah', $bibit->jumlah) }}" required 
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-bold placeholder-[#6B7280]/50 @error('jumlah') border-[#F59E0B] @enderror">
 @error('jumlah')
 <p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>
 @enderror
 </div>
 </div>

 <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end gap-3">
 <button type="submit" 
 class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 cursor-pointer">
 Simpan Perubahan
 </button>
 </div>
 </form>
 </div>
 
 </div>
 </div>
</x-app-layout>

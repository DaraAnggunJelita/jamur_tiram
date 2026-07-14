<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center gap-3 font-sans">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Input Stok Bibit F2') }}
 </h2>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen">
 <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
 <form method="POST" action="{{ route('bibit.store') }}" class="space-y-6">
 @csrf
 <div>
 <label for="kode_bibit" class="block text-xs font-bold text-[#047857] mb-1">Kode Bibit</label>
 <input type="text" name="kode_bibit" id="kode_bibit" value="{{ old('kode_bibit') }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('kode_bibit')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="asal_bibit" class="block text-xs font-bold text-[#047857] mb-1">Asal Bibit</label>
 <input type="text" name="asal_bibit" id="asal_bibit" value="{{ old('asal_bibit') }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('asal_bibit')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="tanggal_masuk" class="block text-xs font-bold text-[#047857] mb-1">Tanggal Masuk</label>
 <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('tanggal_masuk')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="jumlah" class="block text-xs font-bold text-[#047857] mb-1">Jumlah Botol</label>
 <input type="number" name="jumlah" id="jumlah" min="1" value="{{ old('jumlah') }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('jumlah')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end">
 <button type="submit" class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-sm font-extrabold rounded-xl shadow-md transition">
 Simpan Data Bibit
 </button>
 </div>
 </form>
 </div>
 </div>
 </div>
</x-app-layout>

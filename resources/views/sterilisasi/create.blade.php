<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center gap-3 font-sans">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Input Sterilisasi Baglog') }}
 </h2>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen">
 <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
 <form method="POST" action="{{ route('sterilisasi.store') }}" class="space-y-6">
 @csrf
 <div>
 <label for="baglog_id" class="block text-xs font-bold text-[#047857] mb-1">Batch Baglog</label>
 <select name="baglog_id" id="baglog_id" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 <option value="">-- Pilih Batch Baglog --</option>
 @foreach($baglogs as $b)
 <option value="{{ $b->id }}" {{ old('baglog_id') == $b->id ?'selected' :'' }}>Batch #{{ $b->kode_batch }} ({{ $b->jumlah_baglog }} Pcs)</option>
 @endforeach
 </select>
 @error('baglog_id')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="tanggal" class="block text-xs font-bold text-[#047857] mb-1">Tanggal Sterilisasi</label>
 <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('tanggal')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="durasi_pengukusan" class="block text-xs font-bold text-[#047857] mb-1">Durasi Pengukusan (Jam)</label>
 <input type="number" name="durasi_pengukusan" id="durasi_pengukusan" min="1" value="{{ old('durasi_pengukusan') }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('durasi_pengukusan')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="kondisi_air" class="block text-xs font-bold text-[#047857] mb-1">Kondisi Air di Drum</label>
 <select name="kondisi_air" id="kondisi_air" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 <option value="Aman" {{ old('kondisi_air') =='Aman' ?'selected' :'' }}>Aman</option>
 <option value="Menipis" {{ old('kondisi_air') =='Menipis' ?'selected' :'' }}>Menipis</option>
 <option value="Habis" {{ old('kondisi_air') =='Habis' ?'selected' :'' }}>Habis</option>
 </select>
 @error('kondisi_air')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="kestabilan_api" class="block text-xs font-bold text-[#047857] mb-1">Kestabilan Api</label>
 <select name="kestabilan_api" id="kestabilan_api" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 <option value="Stabil-Besar" {{ old('kestabilan_api') =='Stabil-Besar' ?'selected' :'' }}>Stabil-Besar</option>
 <option value="Mengecil" {{ old('kestabilan_api') =='Mengecil' ?'selected' :'' }}>Mengecil</option>
 <option value="Padam" {{ old('kestabilan_api') =='Padam' ?'selected' :'' }}>Padam</option>
 </select>
 @error('kestabilan_api')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 
 <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end">
 <button type="submit" class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-sm font-extrabold rounded-xl shadow-md transition">
 Simpan Sterilisasi
 </button>
 </div>
 </form>
 </div>
 </div>
 </div>
</x-app-layout>

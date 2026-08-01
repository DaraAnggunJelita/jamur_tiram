<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center gap-3 font-sans">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-base text-[#064E3B] leading-tight">
 {{ __('Edit Data Sterilisasi Baglog') }}
 </h2>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen">
 <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
            
            @if(session('success'))
            <div class="mb-6 p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-sm font-bold shadow-2xs">
                {{ session('success') }}
            </div>
            @endif

 <form method="POST" action="{{ route('sterilisasi.update', $sterilisasi->id) }}" class="space-y-6">
 @csrf
 @method('PUT')
  <div>
  <label class="block text-xs font-bold text-[#047857] mb-1">Stok Bibit & Alokasi Baglog</label>
  @php $selected = $sterilisasi->bibit; @endphp
  <input type="text" value="Bibit {{ $selected->kode_bibit ?? 'F2' }} ({{ (float)($selected->banyak_baglog ?? 0) }} Baglog - {{ $selected->user->name ?? 'Tanpa Petugas' }})" readonly class="block w-full rounded-xl border-[#E5E7EB]/60 bg-gray-100 py-2.5 px-4 text-[#374151] font-bold shadow-sm focus:outline-none cursor-not-allowed">
  <input type="hidden" name="bibit_id" value="{{ $sterilisasi->bibit_id }}">
  </div>
 <div>
 <label for="tanggal" class="block text-xs font-bold text-[#047857] mb-1">Tanggal Sterilisasi</label>
 <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($sterilisasi->tanggal)->format('Y-m-d')) }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('tanggal')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 <div>
 <label for="durasi_pengukusan" class="block text-xs font-bold text-[#047857] mb-1">Durasi Pengukusan (Jam)</label>
 <input type="number" name="durasi_pengukusan" id="durasi_pengukusan" min="1" value="{{ old('durasi_pengukusan', $sterilisasi->durasi_pengukusan) }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 @error('durasi_pengukusan')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>
 
 <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end">
 <button type="submit" class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-sm font-extrabold rounded-xl shadow-md transition">
 Update Sterilisasi
 </button>
 </div>
 </form>
 </div>
 </div>
 </div>
</x-app-layout>

<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center gap-3 font-sans">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-base text-[#064E3B] leading-tight">
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
  <label class="block text-xs font-bold text-[#047857] mb-1">Stok Bibit & Alokasi Baglog</label>
  <select name="bibit_id" class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
    @foreach($bibits as $bibit)
      <option value="{{ $bibit->id }}" {{ old('bibit_id', $bibits->first()->id ?? '') == $bibit->id ? 'selected' : '' }}>
        Bibit {{ $bibit->kode_bibit ?? 'F2' }} ({{ (float)($bibit->banyak_baglog ?? 0) }} Baglog - {{ $bibit->user->name ?? 'Tanpa Petugas' }})
      </option>
    @endforeach
  </select>
  @error('bibit_id')
    <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
  @enderror
  </div>

  {{-- Peringatan Keterlambatan Sterilisasi --}}
  @php 
      $selected = $bibits->firstWhere('id', old('bibit_id', request('bibit_id')));
  @endphp
  @if($selected)
  @php
      $tglAlokasiSelected = \Carbon\Carbon::parse($selected->tanggal_masuk ?? $selected->created_at);
      $selisihHariSelected = (int) $tglAlokasiSelected->diffInDays(now());
  @endphp
  @if($selisihHariSelected > 5)
  <div class="bg-amber-50 border border-amber-400 rounded-xl p-4 flex items-start gap-3 shadow-xs">
      <div class="w-9 h-9 bg-amber-400/15 rounded-xl flex items-center justify-center text-amber-700 shrink-0">
          <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
      </div>
      <div>
          <p class="text-xs font-extrabold text-amber-900 uppercase tracking-wider">⚠️ Peringatan: Alokasi Terlambat!</p>
          <p class="text-xs text-amber-800 font-medium mt-0.5">
              Bibit ini dialokasikan sejak <span class="font-extrabold">{{ $tglAlokasiSelected->format('d M Y') }}</span>, sudah
              <span class="font-extrabold text-red-700">{{ $selisihHariSelected }} hari yang lalu</span> — melebihi batas rekomendasi 5 hari.
              Segera sterilisasi untuk mencegah penurunan kualitas bibit.
          </p>
      </div>
  </div>
  @endif
  @endif

  <div>
  <label for="tanggal" class="block text-xs font-bold text-[#047857] mb-1">Tanggal Sterilisasi</label>
  <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
  @error('tanggal')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
  <label for="durasi_pengukusan" class="block text-xs font-bold text-[#047857] mb-1">Durasi Pengukusan (Jam)</label>
  <input type="number" name="durasi_pengukusan" id="durasi_pengukusan" value="8" readonly class="block w-full rounded-xl border-[#E5E7EB]/60 bg-gray-100 py-2.5 px-4 text-[#374151] font-bold shadow-sm focus:outline-none cursor-not-allowed">
  <p class="text-[11px] text-[#6B7280] font-medium mt-1">*Durasi pengukusan disetting tetap 8 jam sesuai standar SOP sterilisasi baglog.</p>
  @error('durasi_pengukusan')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
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

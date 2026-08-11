<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center gap-3 font-sans">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-base text-[#064E3B] leading-tight">
 {{ __('Input Inokulasi') }}
 </h2>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen">
 <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
 
 @if($errors->has('error'))
 <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl text-sm font-bold shadow-2xs flex items-start gap-3">
 <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
 <span>{{ $errors->first('error') }}</span>
 </div>
 @endif

 <div id="warning-banner" class="hidden mb-6 p-4 bg-[#F59E0B]/10 border border-[#F59E0B]/30 text-[#F59E0B] rounded-xl text-sm font-bold shadow-2xs flex items-start gap-3">
 <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
 <span>⚠️ Baglog belum layak untuk disuntikkan bibit karena suhu media masih terlalu panas. Harap tunggu hingga media dingin (1-2 hari setelah sterilisasi).</span>
 </div>

 <div id="warning-banner-lama" class="hidden mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl text-sm font-bold shadow-2xs flex items-start gap-3">
 <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
 <span>⚠️ Jeda inokulasi maksimal adalah 2 hari setelah sterilisasi. Media ini mungkin sudah tidak steril/ideal.</span>
 </div>
 <form method="POST" action="{{ route('inokulasi.store') }}" class="space-y-6">
 @csrf
  <div>
  <label class="block text-xs font-bold text-[#047857] mb-1">Batch Sterilisasi</label>
  @if($sterilisasis->count() > 0)
      <select id="sterilisasi_id" name="sterilisasi_id" class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669] text-[#374151] font-bold">
          <option value="">-- Pilih Batch Sterilisasi --</option>
          @foreach($sterilisasis as $steril)
              <option value="{{ $steril->id }}" data-tanggal="{{ $steril->tanggal }}" {{ request('sterilisasi_id') == $steril->id ? 'selected' : '' }}>
                  Sterilisasi #{{ $steril->id }} (Bibit {{ $steril->bibit->kode_bibit ?? 'F2' }}) - {{ (float)($steril->bibit->banyak_baglog ?? 0) }} Baglog - Petugas: {{ $steril->user->name ?? 'Tidak diketahui' }}
              </option>
          @endforeach
      </select>
  @else
      <input type="text" value="Belum ada batch sterilisasi yang siap diinokulasi" readonly class="block w-full rounded-xl border-red-300 bg-red-50 text-red-700 py-2.5 px-4 font-bold shadow-sm cursor-not-allowed">
  @endif
  </div>

  <div>
  <label for="tanggal" class="block text-xs font-bold text-[#047857] mb-1">Tanggal Inokulasi</label>
  <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
  </div>
  <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end">
  <button type="submit" @if($sterilisasis->isEmpty()) disabled @endif class="py-2.5 px-6 @if($sterilisasis->isEmpty()) bg-gray-400 cursor-not-allowed @else bg-[#059669] hover:bg-[#047857] @endif text-white text-sm font-extrabold rounded-xl shadow-md transition">
  Simpan Inokulasi
  </button>
  </div>
  </form>
 </div>
 </div>
 </div>

  <script>
  function checkSterilisasiDate() {
  const sel = document.getElementById('sterilisasi_id');
  const tglInokulasi = document.getElementById('tanggal').value;
  
  if(!sel || !sel.value || !tglInokulasi) {
  document.getElementById('warning-banner').classList.add('hidden');
  document.getElementById('warning-banner-lama').classList.add('hidden');
  return;
  }
  
  const tglSterilisasi = sel.getAttribute('data-tanggal');
  if(!tglSterilisasi) return;
  
  const dSteril = new Date(tglSterilisasi);
  dSteril.setHours(0,0,0,0);
  
  const dInok = new Date(tglInokulasi);
  dInok.setHours(0,0,0,0);
  
  const diffTime = dInok.getTime() - dSteril.getTime();
  const diffDays = Math.round(diffTime / (1000 * 3600 * 24));
  
  if(diffDays < 1) {
  document.getElementById('warning-banner').classList.remove('hidden');
  document.getElementById('warning-banner-lama').classList.add('hidden');
  } else if(diffDays > 2) {
  document.getElementById('warning-banner').classList.add('hidden');
  document.getElementById('warning-banner-lama').classList.remove('hidden');
  } else {
  document.getElementById('warning-banner').classList.add('hidden');
  document.getElementById('warning-banner-lama').classList.add('hidden');
  }
  }

  const tglElem = document.getElementById('tanggal');
  if(tglElem) {
      tglElem.addEventListener('change', checkSterilisasiDate);
  }
  
  // Run check on load in case there's old input
  window.addEventListener('DOMContentLoaded', checkSterilisasiDate);
  </script>
</x-app-layout>

<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <div class="flex items-center gap-3">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <div>
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Investigasi Batch') }} <span class="text-[#6B7280]">#{{ $baglog->kode_batch }}</span>
 </h2>
 </div>
 </div>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
 
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
 <div class="mb-8">
 <h3 class="text-sm font-bold text-[#047857] mb-1">Riwayat Kehidupan Jamur (Traceability)</h3>
 <p class="text-xs font-medium text-[#6B7280]">Menelusuri proses dari hulu (bibit) hingga hilir (panen) untuk analisis penyebab kegagalan/keberhasilan.</p>
 </div>

 {{-- TIMELINE CONTAINER --}}
 <div class="relative border-l-2 border-[#E5E7EB] ml-4 md:ml-6 space-y-8 pb-4">

 {{-- 1. FASE BIBIT & BAGLOG --}}
 <div class="relative pl-8">
 <div class="absolute -left-[17px] top-1 w-8 h-8 bg-blue-100 rounded-full border-4 border-[#FFFFFF] flex items-center justify-center">
 <span class="text-xs"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9'/></svg></span>
 </div>
 <div class="bg-white p-5 rounded-xl border border-[#E5E7EB]/40 shadow-sm">
 <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full mb-2 inline-block">Hulu: Pembibitan</span>
 <h4 class="text-base font-bold text-[#064E3B]">Pembuatan Batch Baglog</h4>
 <p class="text-xs text-[#6B7280] mt-1 mb-3"><span class="font-bold">Tanggal:</span> {{ \Carbon\Carbon::parse($baglog->tanggal_pembuatan)->format('d M Y') }} | <span class="font-bold">Oleh:</span> {{ $baglog->user->name }}</p>
 
 <div class="grid grid-cols-2 gap-4 mt-2 bg-[#F3F5F4]/50 p-3 rounded-lg border border-[#E5E7EB]/20">
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Kode Batch</p>
 <p class="text-sm font-bold text-[#059669]">{{ $baglog->kode_batch }}</p>
 </div>
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Jumlah Baglog</p>
 <p class="text-sm font-bold text-[#059669]">{{ $baglog->jumlah_baglog }} Pcs</p>
 </div>
 </div>
 </div>
 </div>

 {{-- 2. FASE STERILISASI --}}
 @if($sterilisasi)
 <div class="relative pl-8">
 <div class="absolute -left-[17px] top-1 w-8 h-8 {{ $sterilisasi->status_sterilisasi =='berisiko' ?'bg-red-100' :'bg-green-100' }} rounded-full border-4 border-[#FFFFFF] flex items-center justify-center">
 <span class="text-xs"><svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'/></svg></span>
 </div>
 <div class="bg-white p-5 rounded-xl border border-[#E5E7EB]/40 shadow-sm {{ $sterilisasi->status_sterilisasi =='berisiko' ?'ring-2 ring-red-200' :'' }}">
 <div class="flex justify-between items-start">
 <div>
 <span class="text-[10px] font-bold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full mb-2 inline-block">Proses: Sterilisasi</span>
 <h4 class="text-base font-bold text-[#064E3B]">Sterilisasi Pengukusan</h4>
 <p class="text-xs text-[#6B7280] mt-1 mb-3"><span class="font-bold">Tanggal:</span> {{ \Carbon\Carbon::parse($sterilisasi->tanggal)->format('d M Y') }} | <span class="font-bold">Oleh:</span> {{ $sterilisasi->user->name }}</p>
 </div>
 @if($sterilisasi->status_sterilisasi =='berisiko')
 <span class="text-xs font-bold text-red-600 bg-red-100 px-2.5 py-1 rounded-md animate-pulse">Berisiko!</span>
 @else
 <span class="text-xs font-bold text-green-600 bg-green-100 px-2.5 py-1 rounded-md">Aman</span>
 @endif
 </div>
 
 <div class="grid grid-cols-3 gap-2 mt-2 bg-[#F3F5F4]/50 p-3 rounded-lg border border-[#E5E7EB]/20">
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Durasi</p>
 <p class="text-sm font-bold {{ $sterilisasi->durasi_pengukusan < 7 ?'text-red-600' :'text-[#059669]' }}">{{ $sterilisasi->durasi_pengukusan }} Jam</p>
 </div>
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Kondisi Air</p>
 <p class="text-sm font-bold text-[#059669]">{{ $sterilisasi->kondisi_air }}</p>
 </div>
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Api</p>
 <p class="text-sm font-bold {{ $sterilisasi->kestabilan_api !='Stabil-Besar' ?'text-red-600' :'text-[#059669]' }}">{{ $sterilisasi->kestabilan_api }}</p>
 </div>
 </div>
 </div>
 </div>
 @else
 <div class="relative pl-8">
 <div class="absolute -left-[17px] top-1 w-8 h-8 bg-gray-200 rounded-full border-4 border-[#FFFFFF]"></div>
 <p class="text-sm font-bold text-gray-400 py-2">Belum masuk tahap Sterilisasi</p>
 </div>
 @endif

 {{-- 3. FASE INOKULASI --}}
 @if($inokulasi)
 <div class="relative pl-8">
 <div class="absolute -left-[17px] top-1 w-8 h-8 bg-teal-100 rounded-full border-4 border-[#FFFFFF] flex items-center justify-center">
 <span class="text-xs"><svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'/></svg></span>
 </div>
 <div class="bg-white p-5 rounded-xl border border-[#E5E7EB]/40 shadow-sm">
 <span class="text-[10px] font-bold text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full mb-2 inline-block">Proses: Inokulasi</span>
 <h4 class="text-base font-bold text-[#064E3B]">Penyuntikan Bibit</h4>
 <p class="text-xs text-[#6B7280] mt-1 mb-3"><span class="font-bold">Tanggal:</span> {{ \Carbon\Carbon::parse($inokulasi->tanggal)->format('d M Y') }} | <span class="font-bold">Oleh:</span> {{ $inokulasi->user->name }}</p>
 
 <div class="flex flex-wrap gap-6 mt-2 bg-[#F3F5F4]/50 p-3 rounded-lg border border-[#E5E7EB]/20">
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Sumber Bibit</p>
 <p class="text-sm font-bold text-[#059669]">{{ $inokulasi->bibit->kode_bibit ??'-' }} ({{ $inokulasi->jumlah_bibit_terpakai }} Botol)</p>
 </div>
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Berhasil Tumbuh</p>
 <p class="text-sm font-bold text-[#059669]">{{ $inokulasi->jumlah_berhasil }} Pcs</p>
 </div>
 <div>
 <p class="text-[10px] font-bold text-[#6B7280]">Kontaminasi (Gagal)</p>
 <p class="text-sm font-bold text-red-600">{{ $inokulasi->jumlah_kontaminasi }} Pcs</p>
 </div>
 </div>
 </div>
 </div>
 @endif

 {{-- 4. FASE MONITORING KUMBUNG --}}
 @if($monitoring && $monitoring->count() > 0)
 <div class="relative pl-8">
 <div class="absolute -left-[17px] top-1 w-8 h-8 bg-orange-100 rounded-full border-4 border-[#FFFFFF] flex items-center justify-center">
 <span class="text-xs"><svg class='w-4 h-4 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'/></svg></span>
 </div>
 <div class="bg-white p-5 rounded-xl border border-[#E5E7EB]/40 shadow-sm">
 <span class="text-[10px] font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded-full mb-2 inline-block">Tengah: Perawatan Kumbung</span>
 <h4 class="text-base font-bold text-[#064E3B]">Catatan Monitoring Lingkungan</h4>
 
 <div class="mt-3 space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
 @foreach($monitoring as $mon)
 @php
 $isKritis = ($mon->kondisi_udara =='Panas/Gersang' || $mon->kondisi_lantai =='Kering');
 @endphp
 <div class="p-2.5 rounded-lg border {{ $isKritis ?'border-red-200 bg-red-50' :'border-[#E5E7EB]/20 bg-[#F3F5F4]/30' }} flex justify-between items-center">
 <div>
 <p class="text-[11px] font-bold text-[#6B7280]">{{ \Carbon\Carbon::parse($mon->tanggal)->format('d M') }} ({{ $mon->user->name }})</p>
 <p class="text-xs font-bold text-[#374151]">Udara: {{ $mon->kondisi_udara }} | Lantai: {{ $mon->kondisi_lantai }}</p>
 </div>
 <div class="text-right">
 <span class="text-[10px] font-bold text-[#6B7280]">Penyiraman</span>
 <p class="text-sm font-bold {{ $mon->jumlah_penyiraman < 2 ?'text-red-500' :'text-blue-500' }}">{{ $mon->jumlah_penyiraman }}x</p>
 </div>
 </div>
 @endforeach
 </div>
 </div>
 </div>
 @endif

 {{-- 5. FASE PANEN --}}
 @if($panen && $panen->count() > 0)
 <div class="relative pl-8">
 <div class="absolute -left-[17px] top-1 w-8 h-8 bg-green-100 rounded-full border-4 border-[#FFFFFF] flex items-center justify-center">
 <span class="text-xs"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg></span>
 </div>
 <div class="bg-white p-5 rounded-xl border border-[#E5E7EB]/40 shadow-sm border-l-4 border-l-[#059669]">
 <span class="text-[10px] font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded-full mb-2 inline-block">Hilir: Hasil Panen</span>
 <h4 class="text-base font-bold text-[#064E3B]">Distribusi Pascapanen</h4>
 
 @foreach($panen as $p)
 <div class="mt-3 p-3 rounded-lg border {{ $p->berat_grade_b > 0 ?'bg-red-50 border-red-200' :'bg-green-50 border-green-200' }}">
 <div class="flex justify-between items-start mb-2">
 <p class="text-xs font-bold text-[#6B7280]">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</p>
 <p class="text-sm font-bold {{ $p->berat_grade_b > 0 ?'text-red-700' :'text-[#059669]' }}">{{ $p->jumlah_panen }} Kg</p>
 </div>
 <div>
 <p class="text-xs font-bold text-[#064E3B]">Grade A: {{ $p->berat_grade_a }} Kg | Grade B: {{ $p->berat_grade_b }} Kg</p>
 @if($p->berat_grade_b > 0)
 <p class="text-xs font-bold mt-1 text-red-600">→ B ke Pengolahan Kuliner Rendang</p>
 @endif
 </div>
 </div>
 @endforeach
 </div>
 </div>
 @endif

 {{-- END TIMELINE DOT --}}
 <div class="absolute -left-[5px] bottom-0 w-3 h-3 bg-[#E5E7EB] rounded-full"></div>
 </div>

 </div>
 </div>
 </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <div>
                    <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                        {{ __('Investigasi Batch') }} <span class="text-[#8E6E4E]">#{{ $baglog->kode_batch }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">
                <div class="mb-8">
                    <h3 class="text-sm font-black text-[#6B4E36] uppercase tracking-widest mb-1">Riwayat Kehidupan Jamur (Traceability)</h3>
                    <p class="text-xs font-medium text-[#8E6E4E]">Menelusuri proses dari hulu (bibit) hingga hilir (panen) untuk analisis penyebab kegagalan/keberhasilan.</p>
                </div>

                {{-- TIMELINE CONTAINER --}}
                <div class="relative border-l-2 border-[#C9B896] ml-4 md:ml-6 space-y-8 pb-4">

                    {{-- 1. FASE BIBIT & BAGLOG --}}
                    <div class="relative pl-8">
                        <div class="absolute -left-[17px] top-1 w-8 h-8 bg-blue-100 rounded-full border-4 border-[#FBF8F1] flex items-center justify-center">
                            <span class="text-xs"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9'/></svg></span>
                        </div>
                        <div class="bg-white p-5 rounded-xl border border-[#C9B896]/40 shadow-sm">
                            <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 px-2 py-0.5 rounded-full mb-2 inline-block">Hulu: Pembibitan</span>
                            <h4 class="text-base font-black text-[#26201B]">Pembuatan Batch Baglog</h4>
                            <p class="text-xs text-[#8E6E4E] mt-1 mb-3"><span class="font-bold">Tanggal:</span> {{ \Carbon\Carbon::parse($baglog->tanggal_pembuatan)->format('d M Y') }} | <span class="font-bold">Oleh:</span> {{ $baglog->user->name }}</p>
                            
                            <div class="grid grid-cols-2 gap-4 mt-2 bg-[#F6F1E6]/50 p-3 rounded-lg border border-[#C9B896]/20">
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8E6E4E]">Sumber Bibit</p>
                                    <p class="text-sm font-black text-[#4F6146]">{{ $baglog->bibit->kode_bibit }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8E6E4E]">Jumlah Baglog</p>
                                    <p class="text-sm font-black text-[#4F6146]">{{ $baglog->jumlah_baglog }} Pcs</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. FASE STERILISASI --}}
                    @if($sterilisasi)
                    <div class="relative pl-8">
                        <div class="absolute -left-[17px] top-1 w-8 h-8 {{ $sterilisasi->status_sterilisasi == 'berisiko' ? 'bg-red-100' : 'bg-green-100' }} rounded-full border-4 border-[#FBF8F1] flex items-center justify-center">
                            <span class="text-xs"><svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'/></svg></span>
                        </div>
                        <div class="bg-white p-5 rounded-xl border border-[#C9B896]/40 shadow-sm {{ $sterilisasi->status_sterilisasi == 'berisiko' ? 'ring-2 ring-red-200' : '' }}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-[10px] font-black text-purple-600 uppercase tracking-widest bg-purple-50 px-2 py-0.5 rounded-full mb-2 inline-block">Proses: Sterilisasi</span>
                                    <h4 class="text-base font-black text-[#26201B]">Sterilisasi Pengukusan</h4>
                                    <p class="text-xs text-[#8E6E4E] mt-1 mb-3"><span class="font-bold">Tanggal:</span> {{ \Carbon\Carbon::parse($sterilisasi->tanggal)->format('d M Y') }} | <span class="font-bold">Oleh:</span> {{ $sterilisasi->user->name }}</p>
                                </div>
                                @if($sterilisasi->status_sterilisasi == 'berisiko')
                                    <span class="text-xs font-black text-red-600 bg-red-100 px-2.5 py-1 rounded-md animate-pulse">Berisiko!</span>
                                @else
                                    <span class="text-xs font-black text-green-600 bg-green-100 px-2.5 py-1 rounded-md">Aman</span>
                                @endif
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2 mt-2 bg-[#F6F1E6]/50 p-3 rounded-lg border border-[#C9B896]/20">
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8E6E4E]">Durasi</p>
                                    <p class="text-sm font-black {{ $sterilisasi->durasi_pengukusan < 7 ? 'text-red-600' : 'text-[#4F6146]' }}">{{ $sterilisasi->durasi_pengukusan }} Jam</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8E6E4E]">Kondisi Air</p>
                                    <p class="text-sm font-black text-[#4F6146]">{{ $sterilisasi->kondisi_air }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8E6E4E]">Api</p>
                                    <p class="text-sm font-black {{ $sterilisasi->kestabilan_api != 'Stabil-Besar' ? 'text-red-600' : 'text-[#4F6146]' }}">{{ $sterilisasi->kestabilan_api }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="relative pl-8">
                        <div class="absolute -left-[17px] top-1 w-8 h-8 bg-gray-200 rounded-full border-4 border-[#FBF8F1]"></div>
                        <p class="text-sm font-bold text-gray-400 py-2">Belum masuk tahap Sterilisasi</p>
                    </div>
                    @endif

                    {{-- 3. FASE INOKULASI --}}
                    @if($inokulasi)
                    <div class="relative pl-8">
                        <div class="absolute -left-[17px] top-1 w-8 h-8 bg-teal-100 rounded-full border-4 border-[#FBF8F1] flex items-center justify-center">
                            <span class="text-xs"><svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'/></svg></span>
                        </div>
                        <div class="bg-white p-5 rounded-xl border border-[#C9B896]/40 shadow-sm">
                            <span class="text-[10px] font-black text-teal-600 uppercase tracking-widest bg-teal-50 px-2 py-0.5 rounded-full mb-2 inline-block">Proses: Inokulasi</span>
                            <h4 class="text-base font-black text-[#26201B]">Penyuntikan Bibit</h4>
                            <p class="text-xs text-[#8E6E4E] mt-1 mb-3"><span class="font-bold">Tanggal:</span> {{ \Carbon\Carbon::parse($inokulasi->tanggal)->format('d M Y') }} | <span class="font-bold">Oleh:</span> {{ $inokulasi->user->name }}</p>
                            
                            <div class="flex gap-6 mt-2 bg-[#F6F1E6]/50 p-3 rounded-lg border border-[#C9B896]/20">
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8E6E4E]">Berhasil Tumbuh</p>
                                    <p class="text-sm font-black text-[#4F6146]">{{ $inokulasi->jumlah_berhasil }} Pcs</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8E6E4E]">Kontaminasi (Gagal)</p>
                                    <p class="text-sm font-black text-red-600">{{ $inokulasi->jumlah_kontaminasi }} Pcs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- 4. FASE MONITORING KUMBUNG --}}
                    @if($monitoring && $monitoring->count() > 0)
                    <div class="relative pl-8">
                        <div class="absolute -left-[17px] top-1 w-8 h-8 bg-orange-100 rounded-full border-4 border-[#FBF8F1] flex items-center justify-center">
                            <span class="text-xs"><svg class='w-4 h-4 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'/></svg></span>
                        </div>
                        <div class="bg-white p-5 rounded-xl border border-[#C9B896]/40 shadow-sm">
                            <span class="text-[10px] font-black text-orange-600 uppercase tracking-widest bg-orange-50 px-2 py-0.5 rounded-full mb-2 inline-block">Tengah: Perawatan Kumbung</span>
                            <h4 class="text-base font-black text-[#26201B]">Catatan Monitoring Lingkungan</h4>
                            
                            <div class="mt-3 space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($monitoring as $mon)
                                    @php
                                        $isKritis = ($mon->kondisi_udara == 'Panas/Gersang' || $mon->kondisi_lantai == 'Kering');
                                    @endphp
                                    <div class="p-2.5 rounded-lg border {{ $isKritis ? 'border-red-200 bg-red-50' : 'border-[#C9B896]/20 bg-[#F6F1E6]/30' }} flex justify-between items-center">
                                        <div>
                                            <p class="text-[11px] font-bold text-[#8E6E4E]">{{ \Carbon\Carbon::parse($mon->tanggal)->format('d M') }} ({{ $mon->user->name }})</p>
                                            <p class="text-xs font-black text-[#362C24]">Udara: {{ $mon->kondisi_udara }} | Lantai: {{ $mon->kondisi_lantai }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-[10px] font-bold text-[#8E6E4E]">Penyiraman</span>
                                            <p class="text-sm font-black {{ $mon->jumlah_penyiraman < 2 ? 'text-red-500' : 'text-blue-500' }}">{{ $mon->jumlah_penyiraman }}x</p>
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
                        <div class="absolute -left-[17px] top-1 w-8 h-8 bg-green-100 rounded-full border-4 border-[#FBF8F1] flex items-center justify-center">
                            <span class="text-xs"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg></span>
                        </div>
                        <div class="bg-white p-5 rounded-xl border border-[#C9B896]/40 shadow-sm border-l-4 border-l-[#4F6146]">
                            <span class="text-[10px] font-black text-green-700 uppercase tracking-widest bg-green-50 px-2 py-0.5 rounded-full mb-2 inline-block">Hilir: Hasil Panen</span>
                            <h4 class="text-base font-black text-[#26201B]">Distribusi Pascapanen</h4>
                            
                            @foreach($panen as $p)
                                <div class="mt-3 p-3 rounded-lg border {{ $p->kualitas_panen == 'Kualitas Buruk/Layu' ? 'bg-red-50 border-red-200' : 'bg-green-50 border-green-200' }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <p class="text-xs font-bold text-[#8E6E4E]">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</p>
                                        <p class="text-sm font-black {{ $p->kualitas_panen == 'Kualitas Buruk/Layu' ? 'text-red-700' : 'text-[#4F6146]' }}">{{ $p->jumlah_panen }} Kg</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-[#26201B]">Kualitas: {{ $p->kualitas_panen }}</p>
                                        <p class="text-xs font-black mt-1 {{ $p->kualitas_panen == 'Kualitas Buruk/Layu' ? 'text-red-600' : 'text-green-600' }}">→ {{ $p->status_distribusi }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- END TIMELINE DOT --}}
                    <div class="absolute -left-[5px] bottom-0 w-3 h-3 bg-[#C9B896] rounded-full"></div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


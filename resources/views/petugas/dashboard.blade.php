<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div>
                <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                    {{ __('Dashboard Petugas') }}
                </h2>
                <p class="text-xs text-[#6B7280] mt-0.5">Selamat datang, <span class="font-bold text-[#064E3B]">{{ auth()->user()->name }}</span>. Pantau stok bibit dan alur produksi baglog Anda.</p>
            </div>
            <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-lg border border-[#E5E7EB] shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-[#059669]"></span>
                <span class="text-xs font-bold text-[#064E3B]">{{ \Carbon\Carbon::now()->translatedFormat('l, d M Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#374151]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 0. TIMELINE TASK REMINDER (BUKA KAPAS) --}}
            @if(isset($inokulasiBukaKapas) && $inokulasiBukaKapas->count() > 0)
            @foreach($inokulasiBukaKapas as $inokulasi)
            <div class="bg-amber-50 border-l-4 border-amber-500 rounded-r-xl shadow-xs p-4 border border-amber-200/60">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-amber-500/10 rounded-lg flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="h-5 w-5 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-amber-900">Pengingat Jadwal Buka Kapas (Inokulasi #{{ $inokulasi->id }})</h3>
                            <p class="text-[11px] text-amber-800 mt-0.5 font-medium">
                                Batch Bibit <span class="font-bold">{{ $inokulasi->sterilisasi->bibit->kode_bibit ?? 'F2' }}</span> sudah 40 hari masa inkubasi (Miselium 100%). Waktunya membuka tutup kapas baglog!
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('inokulasi.buka-kapas', $inokulasi->id) }}" method="POST" class="shrink-0">
                        @csrf
                        <button type="submit" class="px-3.5 py-1.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-lg shadow-2xs transition">
                            ✓ Selesai Dikerjakan
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            @endif

            {{-- 1. PUSAT PERINGATAN DINI (EWS) --}}
            @if(isset($peringatanAktif) && $peringatanAktif->count() > 0)
            <div class="bg-red-50 border-l-4 border-red-500 rounded-r-xl shadow-xs p-4 border border-red-200">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-red-500/10 rounded-lg flex items-center justify-center text-red-600 shrink-0">
                        <svg class="h-5 w-5 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="w-full">
                        <h3 class="text-xs font-extrabold text-red-800">Pusat Peringatan Dini (EWS) Aktif ({{ $peringatanAktif->count() }} Peringatan)</h3>
                        <div class="mt-2 space-y-2">
                            @foreach($peringatanAktif as $peringatan)
                            <div class="flex justify-between items-center bg-white p-2.5 rounded-lg border border-red-100 shadow-2xs text-xs">
                                <p class="font-bold text-red-700">{{ $peringatan->pesan }}</p>
                                @php
                                    $targetRoute = '#';
                                    if ($peringatan->kategori === 'Sterilisasi') {
                                        $targetRoute = route('sterilisasi.edit', $peringatan->referensi_id);
                                    } elseif ($peringatan->kategori === 'Kumbung') {
                                        $monitoring = $peringatan->referensi;
                                        $inokulasiId = $monitoring ? $monitoring->inokulasi_id : '';
                                        $targetRoute = route('monitoring.create', ['inokulasi_id' => $inokulasiId]);
                                    } elseif ($peringatan->kategori === 'Panen') {
                                        $targetRoute = route('petugas.laporan-panen.create', ['inokulasi_id' => $peringatan->referensi_id]);
                                    }
                                @endphp
                                <a href="{{ $targetRoute }}" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white font-bold rounded-md shadow-2xs transition shrink-0 ml-4">
                                    Tindak Lanjuti
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white border border-[#E5E7EB]/60 rounded-xl p-3.5 flex items-center gap-3 shadow-2xs">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#059669] flex items-center justify-center shrink-0 border border-emerald-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="text-xs font-bold text-[#064E3B]">EWS Aman. <span class="font-normal text-gray-500">Tidak ada peringatan kritis pada parameter kumbung ataupun produksi saat ini.</span></p>
            </div>
            @endif

            {{-- 1.1 NOTIFIKASI BATCH STERILISASI BERISIKO --}}
            @if(isset($sterilisasiBerisiko) && $sterilisasiBerisiko->count() > 0)
            @foreach($sterilisasiBerisiko as $steril)
            <div class="bg-amber-50 border-l-4 border-amber-400 rounded-r-xl shadow-xs p-3.5 border border-amber-200/60 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-lg">⚠️</span>
                    <div>
                        <h3 class="text-xs font-extrabold text-amber-900">Batch Sterilisasi Berisiko</h3>
                        <p class="text-[11px] text-amber-800 font-medium">
                            Sterilisasi <span class="font-bold">#{{ $steril->id }} (Bibit {{ $steril->bibit->kode_bibit ?? 'F2' }})</span> berstatus <span class="font-bold text-red-600">Berisiko</span>. Silakan periksa kondisi fisik baglog.
                        </p>
                    </div>
                </div>
                <a href="{{ route('sterilisasi.index') }}" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-lg transition shrink-0">
                    Menu Sterilisasi
                </a>
            </div>
            @endforeach
            @endif

            {{-- 1.3 STOK BIBIT SAYA (ALOKASI DARI ADMIN - HILANG SETELAH PANEN) --}}
            <div class="bg-gradient-to-r from-[#064E3B] to-[#047857] rounded-2xl p-5 text-white shadow-md border border-emerald-600/30">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 pb-3.5 border-b border-white/15">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/10 text-emerald-200 text-[10px] font-bold uppercase tracking-wider mb-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Alokasi Bibit dari Admin
                        </div>
                        <h3 class="text-lg font-extrabold text-white tracking-tight">Stok Bibit F2 Anda</h3>
                        {{-- <p class="text-xs text-emerald-100 font-medium mt-0.5">
                            Stok bibit yang dialokasikan Admin. <span class="text-amber-200 font-bold">(Otomatis hilang jika baglog sudah memasuki masa panen)</span>.
                        </p> --}}
                    </div>

                    <div class="flex items-center gap-4 bg-white/10 px-4 py-2.5 rounded-xl border border-white/15 shrink-0 text-right sm:text-left">
                        <div>
                            <span class="block text-[10px] font-bold text-emerald-200 uppercase">Diterima</span>
                            <span class="text-base font-extrabold text-white">{{ (float)($totalBibitDiterima ?? 0) }} <span class="text-[11px] font-normal text-emerald-200">Bungkus</span></span>
                        </div>
                        <div class="w-px h-7 bg-white/20"></div>
                        <div>
                            <span class="block text-[10px] font-bold text-amber-200 uppercase">Sisa Siap Pakai</span>
                            <span class="text-lg font-black text-amber-300">{{ (float)($totalBibitSisa ?? 0) }} <span class="text-[11px] font-normal text-emerald-100">Bungkus</span></span>
                        </div>
                    </div>
                </div>

                @if(isset($bibitAlokasi) && $bibitAlokasi->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5">
                    @foreach($bibitAlokasi as $alokasi)
                    @php
                        $hasInokulasi = $alokasi->inokulasis->count() > 0 || $alokasi->sterilisasis->filter(fn($s) => $s->inokulasis->count() > 0)->count() > 0;
                        $hasSterilisasi = $alokasi->sterilisasis->count() > 0;
                    @endphp
                    <div class="bg-white/10 hover:bg-white/15 rounded-xl p-3.5 border border-white/15 transition flex flex-col justify-between shadow-2xs">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="px-2.5 py-0.5 bg-white text-[#064E3B] font-extrabold text-xs rounded-lg shadow-2xs">
                                    {{ $alokasi->kode_bibit ?? 'Bibit F2' }}
                                </span>
                                <span class="text-[11px] text-emerald-200 font-bold">{{ \Carbon\Carbon::parse($alokasi->tanggal_masuk)->format('d M Y') }}</span>
                            </div>

                            <div class="space-y-1 py-1 text-xs">
                                <div class="flex justify-between items-center">
                                    <span class="text-emerald-200">Asal Bibit:</span>
                                    <span class="font-bold text-white">{{ $alokasi->asal_bibit ?? 'Bibit Internal' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-emerald-200">Jumlah Pemberian:</span>
                                    <span class="font-bold text-white">{{ (float)($alokasi->jumlah) }} Bungkus</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-emerald-200">Estimasi Hasil:</span>
                                    <span class="font-bold text-amber-300">{{ (float)($alokasi->banyak_baglog ?? ($alokasi->jumlah * 50)) }} Baglog</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 pt-2.5 border-t border-white/15 flex items-center justify-between text-[11px]">
                            @if($hasInokulasi)
                                <span class="px-2 py-0.5 bg-indigo-500/80 text-white font-bold rounded-md">
                                    Tahap Inkubasi
                                </span>
                            @elseif($hasSterilisasi)
                                <span class="px-2 py-0.5 bg-amber-500/80 text-white font-bold rounded-md">
                                    Tahap Sterilisasi
                                </span>
                            @else
                                <span class="px-2 py-0.5 bg-emerald-400/90 text-[#064E3B] font-extrabold rounded-md">
                                    Stok Mentah
                                </span>
                            @endif

                            <span class="px-2.5 py-0.5 rounded-lg font-black text-xs {{ $alokasi->sisa_stok > 0 ? 'bg-white text-[#064E3B]' : 'bg-red-500/90 text-white' }}">
                                Sisa: {{ (float)($alokasi->sisa_stok) }} Bungkus
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-white/5 border border-white/10 rounded-xl p-6 text-center text-xs font-bold text-emerald-100 italic">
                    Belum ada stok bibit aktif dari Admin (Atau seluruh stok bibit yang Anda kelola telah berhasil masuk masa panen).
                </div>
                @endif
            </div>

            {{-- 1.5 RINGKASAN LAPORAN PROSES PRODUKSI (PIPELINE WIDGETS) --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-extrabold text-[#064E3B]">Alur Proses Produksi Baglog (Pipeline)</h3>
                    <span class="text-[11px] font-bold text-gray-500">Rekapan 5 Tahapan</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">
                    {{-- Widget 1: Stok Baglog Mentah --}}
                    <div class="bg-white border border-[#E5E7EB]/70 rounded-xl p-3.5 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">1. Stok Mentah</span>
                                <span class="text-xs">📦</span>
                            </div>
                            <div class="text-2xl font-extrabold text-gray-800">{{ $pipelineStokBaglog->count() }} <span class="text-[11px] font-medium text-gray-400">Batch</span></div>
                        </div>
                        <div class="mt-2.5 pt-2 border-t border-gray-100 space-y-1">
                            <div class="text-[10px] text-gray-500 font-medium">Belum disterilisasi</div>
                            @if($pipelineStokBaglog->count() > 0)
                            <div class="flex flex-wrap gap-1">
                                @foreach($pipelineStokBaglog->take(2) as $item)
                                <a href="{{ route('sterilisasi.create', ['bibit_id' => $item->id]) }}" class="px-1.5 py-0.5 bg-gray-100 hover:bg-gray-200 text-[10px] font-bold text-gray-700 rounded transition">Bibit {{ $item->kode_bibit ?? 'F2' }}</a>
                                @endforeach
                                @if($pipelineStokBaglog->count() > 2) <span class="text-[10px] text-gray-400 self-center">...+{{ $pipelineStokBaglog->count() - 2 }}</span> @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Widget 2: Baglog Masa Pendinginan --}}
                    <div class="bg-white border border-amber-200 rounded-xl p-3.5 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[11px] font-bold text-amber-600 uppercase tracking-wider">2. Pendinginan</span>
                                <span class="text-xs">♨️</span>
                            </div>
                            <div class="text-2xl font-extrabold text-amber-700">{{ $pipelinePendinginan->count() }} <span class="text-[11px] font-medium text-amber-500">Batch</span></div>
                        </div>
                        <div class="mt-2.5 pt-2 border-t border-amber-100 space-y-1">
                            <div class="text-[10px] text-amber-700 font-bold flex items-center gap-1">
                                <span>⚠️</span><span>Belum Siap Inokulasi</span>
                            </div>
                            @if($pipelinePendinginan->count() > 0)
                            <div class="flex flex-wrap gap-1">
                                @foreach($pipelinePendinginan->take(2) as $item)
                                <a href="{{ route('inokulasi.create', ['sterilisasi_id' => $item->id]) }}" class="px-1.5 py-0.5 bg-amber-100 hover:bg-amber-200 text-[10px] font-bold text-amber-800 rounded transition">Steril #{{ $item->id }}</a>
                                @endforeach
                                @if($pipelinePendinginan->count() > 2) <span class="text-[10px] text-amber-600 self-center">...+{{ $pipelinePendinginan->count() - 2 }}</span> @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Widget 3: Baglog Siap Inokulasi --}}
                    <div class="bg-white border border-emerald-300 rounded-xl p-3.5 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">3. Siap Inokulasi</span>
                                <span class="text-xs">💉</span>
                            </div>
                            <div class="text-2xl font-extrabold text-[#059669]">{{ $pipelineSiapInokulasi->count() }} <span class="text-[11px] font-medium text-emerald-500">Batch</span></div>
                        </div>
                        <div class="mt-2.5 pt-2 border-t border-emerald-100 space-y-1">
                            <div class="text-[10px] text-[#059669] font-bold">Siap disuntik bibit F2</div>
                            @if($pipelineSiapInokulasi->count() > 0)
                            <div class="flex flex-wrap gap-1">
                                @foreach($pipelineSiapInokulasi->take(2) as $item)
                                <a href="{{ route('inokulasi.create', ['sterilisasi_id' => $item->id]) }}" class="px-1.5 py-0.5 bg-[#059669] text-white hover:bg-[#047857] text-[10px] font-bold rounded transition">Steril #{{ $item->id }}</a>
                                @endforeach
                                @if($pipelineSiapInokulasi->count() > 2) <span class="text-[10px] text-emerald-600 self-center">...+{{ $pipelineSiapInokulasi->count() - 2 }}</span> @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Widget 4: Baglog Masa Inkubasi --}}
                    <div class="bg-white border border-indigo-200 rounded-xl p-3.5 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider">4. Inkubasi</span>
                                <span class="text-xs">🌱</span>
                            </div>
                            <div class="text-2xl font-extrabold text-indigo-700">{{ $pipelineInkubasi->count() }} <span class="text-[11px] font-medium text-indigo-500">Batch</span></div>
                        </div>
                        <div class="mt-2.5 pt-2 border-t border-indigo-100 space-y-1">
                            <div class="text-[10px] text-indigo-600 font-medium">Masa pemantauan tumbuh</div>
                            @if($pipelineInkubasi->count() > 0)
                            <div class="flex flex-wrap gap-1">
                                @foreach($pipelineInkubasi->take(2) as $item)
                                <a href="{{ route('monitoring.create', ['inokulasi_id' => $item->id]) }}" class="px-1.5 py-0.5 bg-indigo-100 hover:bg-indigo-200 text-[10px] font-bold text-indigo-700 rounded transition">Inokulasi #{{ $item->id }}</a>
                                @endforeach
                                @if($pipelineInkubasi->count() > 2) <span class="text-[10px] text-indigo-600 self-center">...+{{ $pipelineInkubasi->count() - 2 }}</span> @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Widget 5: Alarm Siap Panen --}}
                    <div class="bg-rose-50/60 border border-rose-300 rounded-xl p-3.5 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-ping"></span> 5. Siap Panen
                                </span>
                                <span class="text-xs">🍄</span>
                            </div>
                            <div class="text-2xl font-extrabold text-rose-700">{{ $pipelineSiapPanen->count() }} <span class="text-[11px] font-medium text-rose-500">Batch</span></div>
                        </div>
                        <div class="mt-2.5 pt-2 border-t border-rose-100 space-y-1">
                            <div class="text-[10px] text-rose-600 font-bold">Miselium 100% / >40 Hari</div>
                            @if($pipelineSiapPanen->count() > 0)
                            <div class="flex flex-wrap gap-1">
                                @foreach($pipelineSiapPanen->take(2) as $item)
                                <a href="{{ route('petugas.laporan-panen.create', ['inokulasi_id' => $item->id]) }}" class="px-1.5 py-0.5 bg-rose-600 text-white hover:bg-rose-700 text-[10px] font-bold rounded transition">Inokulasi #{{ $item->id }}</a>
                                @endforeach
                                @if($pipelineSiapPanen->count() > 2) <span class="text-[10px] text-rose-600 self-center">...+{{ $pipelineSiapPanen->count() - 2 }}</span> @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. STATISTIK PANEN & GRAFIK RASIO KUALITAS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Card Stat 1 --}}
                <div class="bg-white border border-[#E5E7EB]/60 rounded-xl p-4 shadow-2xs flex items-center gap-3.5">
                    <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center text-[#059669] shrink-0 border border-emerald-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-[#6B7280] font-bold uppercase">Total Panen (Bulan Ini)</p>
                        <p class="text-xl font-extrabold text-[#064E3B]">{{ (float)($reportsBulanIni->sum('jumlah_panen')) }} <span class="text-xs font-bold text-[#6B7280]">Kg</span></p>
                    </div>
                </div>

                {{-- Card Stat 2 --}}
                <div class="bg-white border border-[#E5E7EB]/60 rounded-xl p-4 shadow-2xs flex items-center gap-3.5">
                    <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center text-[#F59E0B] shrink-0 border border-amber-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-[#6B7280] font-bold uppercase">Laporan Panen Bulan Ini</p>
                        <p class="text-xl font-extrabold text-[#064E3B]">{{ $reportsBulanIni->count() }} <span class="text-xs font-bold text-[#6B7280]">Batch</span></p>
                    </div>
                </div>

                {{-- Card Pie Chart --}}
                <div class="bg-white border border-[#E5E7EB]/60 rounded-xl p-5 shadow-2xs md:row-span-2 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs font-extrabold text-[#064E3B] uppercase tracking-wider mb-0.5">Rasio Kualitas Panen</h3>
                        <p class="text-[11px] text-[#6B7280]">Perbandingan Grade A vs Grade B (Bulan Ini).</p>
                    </div>

                    <div class="flex flex-col items-center justify-center my-4">
                        @if($persentaseA > 0 || $persentaseB > 0)
                        <div class="relative w-36 h-36 rounded-full shadow-inner flex items-center justify-center" style="background: conic-gradient(#059669 0% {{ $persentaseA }}%, #F59E0B {{ $persentaseA }}% 100%);">
                            <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center shadow-xs">
                                <div class="text-center">
                                    <span class="text-[10px] font-bold text-gray-400 block">Dominan</span>
                                    <span class="text-base font-black {{ $persentaseA >= $persentaseB ? 'text-[#059669]' : 'text-[#F59E0B]' }}">{{ $persentaseA >= $persentaseB ? "A ($persentaseA%)" : "B ($persentaseB%)" }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex items-center justify-center gap-4 text-xs font-bold">
                            <span class="flex items-center text-gray-700"><span class="w-2.5 h-2.5 bg-[#059669] rounded-full mr-1.5"></span>Grade A: {{ $persentaseA }}%</span>
                            <span class="flex items-center text-gray-700"><span class="w-2.5 h-2.5 bg-[#F59E0B] rounded-full mr-1.5"></span>Grade B: {{ $persentaseB }}%</span>
                        </div>
                        @else
                        <div class="text-center text-gray-400 text-xs italic w-full h-36 flex flex-col items-center justify-center border-2 border-dashed border-[#E5E7EB] rounded-xl bg-gray-50/50">
                            <span>Belum ada data panen</span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Tabel Riwayat Laporan Singkat --}}
                <div class="bg-white border border-[#E5E7EB]/60 rounded-xl p-4 shadow-2xs md:col-span-2 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-3 pb-2.5 border-b border-[#E5E7EB]/40">
                            <h3 class="text-xs font-extrabold text-[#064E3B] uppercase tracking-wider">Aktivitas Panen Terbaru</h3>
                            <a href="{{ route('petugas.laporan-panen.index') }}" class="text-xs font-bold text-[#059669] hover:underline">Lihat Semua &rarr;</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="border-b border-[#E5E7EB] text-gray-500 font-bold">
                                        <th class="py-2.5 px-2">Tanggal</th>
                                        <th class="py-2.5 px-2">Total Berat</th>
                                        <th class="py-2.5 px-2">Grade A/B</th>
                                        <th class="py-2.5 px-2 text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#E5E7EB]/30">
                                    @forelse($recentReports->take(4) as $report)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-2.5 px-2 font-bold text-gray-800">
                                            {{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}
                                            <span class="block text-[10px] font-normal text-gray-400">Siklus Ke-{{ $report->siklus_panen }}</span>
                                        </td>
                                        <td class="py-2.5 px-2 font-black text-[#059669]">{{ (float)($report->jumlah_panen) }} Kg</td>
                                        <td class="py-2.5 px-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                                A: {{ (float)($report->berat_grade_a) }} | B: {{ (float)($report->berat_grade_b) }}
                                            </span>
                                        </td>
                                        <td class="py-2.5 px-2 text-right">
                                            @if($report->status_validasi === 'valid')
                                                <span class="inline-flex px-2 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-100 rounded border border-emerald-200">Valid</span>
                                                @if($report->berat_grade_b > 0)
                                                    <div class="text-[9px] text-[#F59E0B] font-bold mt-0.5">→ B ke Rendang</div>
                                                @endif
                                            @elseif($report->status_validasi === 'invalid')
                                                <span class="inline-flex px-2 py-0.5 text-[10px] font-bold text-red-700 bg-red-100 rounded border border-red-200">Invalid</span>
                                            @else
                                                <span class="inline-flex px-2 py-0.5 text-[10px] font-bold text-amber-700 bg-amber-100 rounded border border-amber-200">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-xs text-gray-400 font-medium italic">Belum ada riwayat panen.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <a href="{{ route('petugas.dashboard') }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                title="Kembali ke Dashboard">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Laporan Panen Harian') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen font-sans text-[#064E3B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
            <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-xs font-semibold shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#059669] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-semibold">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white border border-[#E5E7EB]/60 rounded-2xl p-6 shadow-xs overflow-hidden">

                {{-- Header Card --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/40">
                    <div>
                        <h3 class="text-xs font-bold text-[#064E3B] uppercase tracking-wider">Riwayat Laporan Panen</h3>
                        {{-- <p class="text-xs text-[#6B7280] font-medium mt-0.5">Seluruh berkas pencatatan produksi hasil panen jamur.</p> --}}
                    </div>
                    <a href="{{ route('petugas.laporan-panen.create') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 cursor-pointer self-start sm:self-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Input Hasil Panen</span>
                    </a>
                </div>

                {{-- Form Filter --}}
                <form method="GET" action="{{ route('petugas.laporan-panen.index') }}" class="flex flex-col sm:flex-row items-center gap-3 mb-6">

                    {{-- Filter Nama Petugas (hanya tampil untuk Admin/Ketua) --}}
                    @if(auth()->user()->isAdmin())
                    <div class="relative w-full sm:flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#9CA3AF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Ketik nama petugas..."
                            list="petugasSuggestions"
                            autocomplete="off"
                            class="w-full pl-9 pr-3.5 py-2 bg-[#F9FAFB] border border-[#E5E7EB] rounded-xl text-xs font-medium text-[#1F2937] placeholder-[#9CA3AF] focus:bg-white focus:border-[#059669] focus:ring-[#059669]">
                        {{-- Datalist: daftar nama petugas sebagai saran autocomplete --}}
                        <datalist id="petugasSuggestions">
                            @foreach($petugasList as $nama)
                                <option value="{{ $nama }}">
                            @endforeach
                        </datalist>
                    </div>
                    @endif

                    {{-- Filter Batch --}}
                    <div class="w-full sm:flex-1">
                        <select name="inokulasi_id" onchange="this.form.submit()"
                            class="w-full px-3.5 py-2 bg-[#F9FAFB] border border-[#E5E7EB] rounded-xl text-xs font-medium text-[#1F2937] focus:bg-white focus:border-[#059669] focus:ring-[#059669]">
                            <option value="">-- Semua Batch --</option>
                            @foreach($allBatches as $batch)
                                @php
                                    $jenisBibit = ucwords($batch->sterilisasi->bibit->asal_bibit ?? $batch->sterilisasi->bibit->kode_bibit ?? 'Bibit F2');
                                @endphp
                                <option value="{{ $batch->id }}" {{ request('inokulasi_id') == $batch->id ? 'selected' : '' }}>
                                    Batch #{{ $batch->id }} ({{ $jenisBibit }}) - {{ \Carbon\Carbon::parse($batch->tanggal)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Tanggal Panen --}}
                    <div class="relative w-full sm:w-52">
                        <label class="absolute -top-4 left-1 text-[10px] font-semibold text-[#6B7280] hidden sm:block">
                            Filter Tanggal Panen
                        </label>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#9CA3AF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="date" name="date" id="filterDate" value="{{ request('date') }}"
                            title="Klik untuk memilih tanggal panen"
                            class="w-full pl-9 pr-3.5 py-2 bg-[#F9FAFB] border border-[#E5E7EB] rounded-xl text-xs font-medium text-[#1F2937] focus:bg-white focus:border-[#059669] focus:ring-[#059669] cursor-pointer"
                            onchange="this.form.submit()">
                    </div>

                    {{-- Tombol Cari (untuk admin agar bisa submit search) --}}
                    @if(auth()->user()->isAdmin())
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Cari</span>
                    </button>
                    @endif

                    {{-- Tombol Reset --}}
                    @if(request('date') || request('inokulasi_id') || request('search'))
                    <a href="{{ route('petugas.laporan-panen.index') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#4B5563] text-xs font-semibold rounded-xl transition cursor-pointer shrink-0"
                        title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Reset</span>
                    </a>
                    @endif
                </form>


                {{-- Daftar Batch Inokulasi & Laporan Panen --}}
                <div class="space-y-6">
                    @forelse ($inokulasis as $inokulasi)
                    <div class="bg-white rounded-xl border border-[#E5E7EB] overflow-hidden">
                        <div class="p-4 bg-[#F9FAFB] border-b border-[#E5E7EB] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h4 class="text-xs font-bold text-[#064E3B]">
                                    Batch Bibit: {{ $inokulasi->sterilisasi->bibit->kode_bibit ?? 'F2' }} (Inokulasi {{ $inokulasi->id }})
                                </h4>
                                <div class="mt-1 flex flex-wrap items-center gap-x-3 text-[11px] text-[#6B7280]">
                                    <span><strong>Petugas:</strong> {{ $inokulasi->user->name ?? ($inokulasi->productionReports->first()->user->name ?? '-') }}</span>
                                    <span class="hidden sm:inline text-gray-300">|</span>
                                    <span><strong>Disuntik:</strong> {{ \Carbon\Carbon::parse($inokulasi->tanggal)->isoFormat('D MMM Y') }}</span>
                                    <span class="hidden sm:inline text-gray-300">|</span>
                                    <span><strong>Est. Mulai Panen:</strong> {{ \Carbon\Carbon::parse($inokulasi->tanggal)->addDays(50)->isoFormat('D MMM Y') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                @php
                                $validReportsCount = $inokulasi->productionReports->where('status_validasi', '!=', 'dibatalkan')->count();
                                @endphp
                                <span class="bg-[#D1FAE5] text-[#065F46] text-[10px] font-semibold px-2.5 py-1 rounded-full">
                                    {{ $validReportsCount }} / 7 Panen
                                </span>
                                @if ($validReportsCount < 7)
                                <a href="{{ route('petugas.laporan-panen.create') }}" class="text-xs text-[#059669] font-bold hover:underline">
                                    + Tambah Laporan
                                </a>
                                @else
                                <span class="text-[11px] text-[#9CA3AF] italic font-medium">Selesai (7 Siklus Afkir)</span>
                                @endif
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="bg-white border-b border-[#E5E7EB] text-[#4B5563] uppercase tracking-wider text-[11px] font-semibold">
                                        <th class="py-2.5 px-4">Siklus</th>
                                        <th class="py-2.5 px-4">Tanggal</th>
                                        <th class="py-2.5 px-4 text-center">Grade A</th>
                                        <th class="py-2.5 px-4 text-center">Grade B</th>
                                        <th class="py-2.5 px-4 text-center">Total Berat</th>
                                        <th class="py-2.5 px-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#E5E7EB]/50 text-[#374151]">
                                    @foreach ($inokulasi->productionReports as $report)
                                    <tr class="hover:bg-[#F9FAFB] transition duration-150">
                                        <td class="py-3 px-4 font-bold text-[#059669] whitespace-nowrap">
                                            Siklus Ke-{{ $report->siklus_panen }}
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-[#1F2937] whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMM Y') }}
                                        </td>
                                        <td class="py-3 px-4 text-center font-bold text-[#059669] whitespace-nowrap">
                                            {{ number_format($report->berat_grade_a, 1) }} <span class="text-[10px] font-normal text-[#6B7280]">Kg</span>
                                        </td>
                                        <td class="py-3 px-4 text-center font-semibold text-amber-700 whitespace-nowrap">
                                            {{ number_format($report->berat_grade_b, 1) }} <span class="text-[10px] font-normal text-[#6B7280]">Kg</span>
                                        </td>
                                        <td class="py-3 px-4 text-center font-bold text-[#1F2937] whitespace-nowrap">
                                            {{ number_format($report->jumlah_panen, 1) }} <span class="text-[10px] font-normal text-[#6B7280]">Kg</span>
                                        </td>
                                        <td class="py-3 px-4 text-right whitespace-nowrap">
                                            @if ($report->status_validasi === 'pending')
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('petugas.laporan-panen.edit', $report->id) }}"
                                                    class="inline-flex items-center px-2.5 py-1.5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-xs font-semibold rounded-lg border border-[#D1D5DB] transition cursor-pointer">
                                                    Edit
                                                </a>
                                                <form action="{{ route('petugas.laporan-panen.destroy', $report->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus laporan hasil panen ini?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-lg border border-red-200 transition cursor-pointer">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                            @else
                                            <span class="text-[11px] text-[#9CA3AF] font-medium italic">Terkunci</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white p-12 text-center rounded-xl border border-[#E5E7EB]">
                        <div class="w-10 h-10 bg-[#F3F4F6] text-[#9CA3AF] rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <p class="text-xs font-bold text-[#374151]">Belum Ada Riwayat Laporan Produksi</p>
                        <p class="text-xs text-[#6B7280] mt-0.5 font-medium">Klik "Input Hasil Panen" di atas untuk melaporkan hasil panen.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-4 pt-4 border-t border-[#E5E7EB]/40 px-2">
                    {{ $inokulasis->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

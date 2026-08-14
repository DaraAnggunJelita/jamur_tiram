<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <a href="{{ route('petugas.dashboard') }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                title="Kembali ke Dashboard">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Proses Inokulasi & Inkubasi') }}
            </h2>
        </div>
    </x-slot>

    <div x-data="{ showInputModal: null, showDetailModal: false, selectedDetailId: null }" class="py-8 bg-[#F3F5F4] min-h-screen font-sans text-[#064E3B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
            <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-xs font-semibold shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#059669] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('warning'))
            <div class="p-4 bg-yellow-50 border border-yellow-300 text-yellow-800 rounded-xl text-xs font-semibold shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-yellow-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('warning') }}</span>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-semibold">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white border border-[#E5E7EB]/60 rounded-2xl p-6 shadow-xs overflow-hidden">

                {{-- Header Card --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/40">
                    <div>
                        <h2 class="text-base font-bold text-[#064E3B]">Riwayat Inokulasi Bibit</h2>
                        {{-- <p class="text-xs text-[#6B7280] font-medium mt-0.5">Data penanaman bibit pada baglog yang telah disterilisasi.</p> --}}
                    </div>
                    @if(in_array(auth()->user()->role, ['petugas', 'admin']))
                    <a href="{{ route('inokulasi.create') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 cursor-pointer self-start sm:self-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Input Data Inokulasi</span>
                    </a>
                    @endif
                </div>

                {{-- Form Filter & Pencarian --}}
                <form method="GET" action="{{ route('inokulasi.index') }}" class="flex flex-col sm:flex-row items-center gap-3 mb-6">
                    <div class="relative w-full sm:flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#9CA3AF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kode bibit, petugas..."
                            class="w-full pl-9 pr-3.5 py-2 bg-[#F9FAFB] border border-[#E5E7EB] rounded-xl text-xs font-medium text-[#1F2937] placeholder-[#9CA3AF] focus:bg-white focus:border-[#059669] focus:ring-[#059669]">
                    </div>

                    <div class="w-full sm:w-48">
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="w-full px-3.5 py-2 bg-[#F9FAFB] border border-[#E5E7EB] rounded-xl text-xs font-medium text-[#1F2937] focus:bg-white focus:border-[#059669] focus:ring-[#059669]"
                            onchange="this.form.submit()">
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                        <button type="submit"
                            class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span>Cari</span>
                        </button>
                        @if(request('search') || request('date'))
                        <a href="{{ route('inokulasi.index') }}"
                            class="inline-flex items-center justify-center p-2 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#4B5563] rounded-xl transition cursor-pointer" title="Reset Filter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </a>
                        @endif
                    </div>
                </form>

                {{-- Tabel Data --}}
                <div class="overflow-x-auto border border-[#E5E7EB]/60 rounded-xl">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-[#F9FAFB] border-b border-[#E5E7EB] text-[#4B5563] uppercase tracking-wider text-[11px] font-semibold">
                                <th class="py-3 px-4">Tgl Inokulasi</th>
                                <th class="py-3 px-4">Ref. Batch (Sterilisasi)</th>
                                <th class="py-3 px-4 text-center">Berhasil Tumbuh</th>
                                <th class="py-3 px-4 text-center">Gagal / Kontaminasi</th>
                                <th class="py-3 px-4 text-center">Progres Terakhir</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E7EB]/50 text-[#374151]">
                            @forelse($inokulasis as $inok)
                            <tr class="hover:bg-[#F9FAFB] transition duration-150">
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <div class="font-bold text-[#1F2937]">{{ \Carbon\Carbon::parse($inok->tanggal)->isoFormat('D MMM YYYY') }}</div>
                                    <div class="text-[11px] text-[#6B7280] font-medium">{{ $inok->user->name ?? 'Petugas' }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-[#064E3B]">Sterilisasi {{ $inok->sterilisasi_id }}</div>
                                    <div class="text-[11px] text-[#6B7280] font-medium">Bibit F2 {{ ucwords($inok->bibit->asal_bibit ?? $inok->bibit->kode_bibit ?? '-') }} ({{ (float)$inok->jumlah_bibit_terpakai }} Bungkus)</div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-[#059669] whitespace-nowrap">
                                    {{ number_format($inok->jumlah_berhasil) }} / {{ number_format($inok->sterilisasi->bibit->banyak_baglog ?? 0) }} <span class="text-[10px] font-normal text-[#6B7280]">Pcs</span>
                                </td>
                                <td class="py-3.5 px-4 text-center font-semibold whitespace-nowrap">
                                    <span class="{{ $inok->jumlah_kontaminasi > 0 ? 'text-red-600 font-bold' : 'text-[#6B7280]' }}">
                                        {{ number_format($inok->jumlah_kontaminasi) }} Pcs
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    @if($inok->logInkubasis->count() > 0)
                                    @php $lastLog = $inok->logInkubasis->sortByDesc('created_at')->first(); @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        {{ $lastLog->persentase_tumbuh }}%
                                    </span>
                                    <div class="text-[10px] text-[#6B7280] mt-0.5 font-medium">{{ \Carbon\Carbon::parse($lastLog->tanggal_catat)->format('d/m/Y') }}</div>
                                    @else
                                    <span class="text-[11px] text-[#9CA3AF] italic">Belum Ada Progres</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button type="button" @click.prevent="showDetailModal = true; selectedDetailId = {{ $inok->id }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-xs font-semibold rounded-lg border border-[#D1D5DB] transition cursor-pointer gap-1">
                                            <svg class="w-3.5 h-3.5 text-[#6B7280]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            <span>Detail</span>
                                        </button>

                                        @php
                                        $maxProgres = $inok->logInkubasis->max('persentase_tumbuh') ?? 0;
                                        $hasPanen = \App\Models\ProductionReport::where('inokulasi_id', $inok->id)->exists() || $maxProgres == 100;
                                        @endphp

                                        @if($hasPanen)
                                        <span class="inline-flex items-center px-2.5 py-1.5 bg-[#F3F4F6] text-[#9CA3AF] text-xs font-medium rounded-lg border border-[#E5E7EB] italic">
                                            Selesai
                                        </span>
                                        @else
                                        <button type="button" @click="showInputModal = {{ $inok->id }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-semibold rounded-lg transition cursor-pointer">
                                            Pantau
                                        </button>
                                        @if($maxProgres == 0)
                                        <form method="POST" action="{{ route('inokulasi.destroy', $inok->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus data inokulasi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-lg border border-red-200 transition cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                        @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-[#6B7280]">
                                    <div class="w-10 h-10 bg-[#F3F4F6] text-[#9CA3AF] rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <p class="text-xs font-bold text-[#374151]">Belum Ada Riwayat Inokulasi</p>
                                    <p class="text-xs text-[#6B7280] mt-0.5 font-medium">Klik "Input Data Inokulasi" untuk menambahkan data penanaman bibit.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 pt-4 border-t border-[#E5E7EB]/40 px-2">
                    {{ $inokulasis->links() }}
                </div>
            </div>
        </div>

        {{-- MODAL PANTAU & DETAIL --}}
        @foreach($inokulasis as $inok)
        {{-- MODAL PANTAU INKUBASI --}}
        <div x-show="showInputModal == {{ $inok->id }}" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="showInputModal == {{ $inok->id }}" @click="showInputModal = null" class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-xs"></div>
                </div>

                <div x-show="showInputModal == {{ $inok->id }}" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-[#E5E7EB]">
                    <div class="bg-white p-6">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-[#E5E7EB]">
                            <h3 class="text-sm font-bold text-[#064E3B]" id="modal-title">
                                Catat Progres Inkubasi
                            </h3>
                            <button type="button" @click="showInputModal = null" class="text-gray-400 hover:text-gray-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <form action="{{ route('inokulasi.store-log', $inok->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @php
                                $maxProgres = $inok->logInkubasis->max('persentase_tumbuh') ?? 0;
                                $nextTarget = $maxProgres + 25;
                                $daysToAdd = match((int)$nextTarget) {
                                    25 => 10,
                                    50 => 20,
                                    75 => 30,
                                    100 => 40,
                                    default => 10
                                };
                                $autoDate = \Carbon\Carbon::parse($inok->tanggal)->addDays($daysToAdd)->format('Y-m-d');
                            @endphp
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider">Tanggal Cek Fisik</label>
                                    <span class="text-[10px] font-bold text-[#059669] bg-[#34D399]/15 border border-[#059669]/30 px-2 py-0.5 rounded-md">
                                        Rekomendasi H+{{ $daysToAdd }} Inokulasi
                                    </span>
                                </div>
                                <input type="date" name="tanggal_catat" required value="{{ $autoDate }}" class="block w-full rounded-xl border-[#E5E7EB] bg-white text-xs font-semibold py-2.5 px-3.5 text-[#1F2937] focus:border-[#059669] focus:ring-[#059669]">
                                <p class="text-[10px] text-[#6B7280] mt-1 italic">*Sistem memilih otomatis target H+{{ $daysToAdd }} dari tanggal inokulasi ({{ \Carbon\Carbon::parse($inok->tanggal)->format('d/m/Y') }}), dapat disesuaikan manual.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Miselium (%)</label>
                                    <select name="persentase_tumbuh" required class="block w-full rounded-xl border-[#E5E7EB] bg-white text-xs font-semibold py-2.5 px-3.5 text-[#1F2937] focus:border-[#059669] focus:ring-[#059669]">
                                        <option value="25" {{ $nextTarget == 25 ? 'selected' : '' }}>Minggu 1: 25% (Awal)</option>
                                        <option value="50" {{ $nextTarget == 50 ? 'selected' : '' }}>Minggu 2: 50% (Sedang)</option>
                                        <option value="75" {{ $nextTarget == 75 ? 'selected' : '' }}>Minggu 3: 75% (Hampir Penuh)</option>
                                        <option value="100" {{ $nextTarget == 100 ? 'selected' : '' }}>Minggu 4: 100% (Sempurna)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-red-600 uppercase tracking-wider mb-2">Kontaminasi (Pcs)</label>
                                    <input type="number" name="tambah_kontaminasi" min="0" value="0" class="block w-full rounded-xl border-red-200 bg-red-50 text-xs font-semibold py-2.5 px-3.5 text-red-900 focus:border-red-500 focus:ring-red-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Catatan (Opsional)</label>
                                <textarea name="catatan" rows="2" class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-xs font-medium text-[#1F2937] focus:border-[#059669] focus:ring-[#059669]" placeholder="Contoh: Pertumbuhan miselium sehat..."></textarea>
                            </div>
                            <div class="pt-4 border-t border-[#E5E7EB] flex justify-end gap-2">
                                <button type="button" @click="showInputModal = null" class="px-4 py-2 bg-[#F3F4F6] text-[#374151] text-xs font-semibold rounded-xl border border-[#D1D5DB] transition">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl shadow-xs transition">
                                    Simpan Progres
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL DETAIL HISTORI INKUBASI --}}
        <div x-show="showDetailModal && selectedDetailId == {{ $inok->id }}" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="showDetailModal && selectedDetailId == {{ $inok->id }}" @click="showDetailModal = false" class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-xs"></div>
                </div>

                <div x-show="showDetailModal && selectedDetailId == {{ $inok->id }}" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full border border-[#E5E7EB]">
                    <div class="bg-white p-6">
                        <div class="flex justify-between items-center pb-3 mb-4 border-b border-[#E5E7EB]">
                            <h3 class="text-sm font-bold text-[#064E3B]">
                                Histori Pemantauan Inkubasi
                            </h3>
                            <button type="button" @click="showDetailModal = false" class="text-gray-400 hover:text-gray-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            @if($inok->logInkubasis->count() > 0)
                            <div class="relative border-l-2 border-[#059669] ml-2 space-y-4 pb-2">
                                @php $totalLogs = $inok->logInkubasis->count(); @endphp
                                @foreach($inok->logInkubasis->sortByDesc('created_at')->values() as $index => $log)
                                <div class="relative pl-5">
                                    <div class="absolute w-2.5 h-2.5 bg-[#059669] rounded-full -left-[6px] top-1 border-2 border-white"></div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-bold text-[#064E3B]">Minggu ke-{{ $totalLogs - $index }} <span class="text-[10px] text-[#6B7280] font-normal">({{ \Carbon\Carbon::parse($log->tanggal_catat)->format('d M Y') }})</span></span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ $log->persentase_tumbuh }}%
                                        </span>
                                    </div>
                                    @if($log->catatan)
                                    <div class="text-[11px] text-[#4B5563] bg-[#F9FAFB] rounded-lg p-2 mt-1 border border-[#E5E7EB] italic">
                                        "{{ $log->catatan }}"
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-6 text-xs text-[#6B7280] italic">
                                Belum ada riwayat pemantauan untuk batch ini.
                            </div>
                            @endif
                        </div>

                        <div class="pt-4 mt-4 border-t border-[#E5E7EB] flex justify-end">
                            <button type="button" @click="showDetailModal = false" class="px-4 py-2 bg-[#F3F4F6] text-[#374151] text-xs font-semibold rounded-xl border border-[#D1D5DB] transition">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>

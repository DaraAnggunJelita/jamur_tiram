<x-app-layout>
 <div x-data="{ showInputModal: null, showDetailModal: false, selectedDetailId: null }" class="py-12 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 @if(session('success'))
 <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-sm font-bold shadow-2xs">
 {{ session('success') }}
 </div>
 @endif
 
 @if($errors->any())
 <script>
 alert("GAGAL MENYIMPAN!\n\n{{ $errors->first() }}");
 </script>
 <div class="p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl text-sm font-bold shadow-2xs">
 <ul class="list-disc pl-5">
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif

 <div class="grid grid-cols-1 gap-6">
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/20">
 <div>
 <h3 class="text-xl font-bold text-[#064E3B]">Riwayat Inokulasi Bibit</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Data penanaman bibit pada baglog yang telah disterilisasi.</p>
 </div>
 @if(auth()->user()->role ==='petugas')
 <a href="{{ route('inokulasi.create') }}"
 class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
 Input Data Inokulasi
 </a>
 @endif
 </div>

 {{-- Form Filter & Pencarian --}}
 <form method="GET" action="{{ route('inokulasi.index') }}" class="flex flex-col sm:flex-row items-center gap-4 mb-6">
 <div class="w-full sm:w-1/2">
 <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan batch baglog, petugas..." class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 500);">
 </div>
 <div class="w-full sm:w-1/3">
 <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" title="Pilih Tanggal" onchange="this.form.submit()">
 </div>
 <div class="w-full sm:w-auto flex items-center gap-2">
 <button type="submit" class="p-2.5 bg-[#059669] text-white rounded-xl hover:bg-[#047857] transition shadow-md shadow-[#059669]/10" title="Filter">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
 </button>
 <a href="{{ route('inokulasi.index') }}" class="p-2.5 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition shadow-md" title="Reset">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
 </a>
 </div>
 </form>

 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm border-collapse">
 <thead>
 <tr class="border-b border-[#E5E7EB]/40 text-[#047857] text-xs font-bold">
 <th class="py-3 px-4">Tgl Inokulasi</th>
 <th class="py-3 px-4">Ref. Batch (Sterilisasi)</th>
 <th class="py-3 px-4 text-center">Berhasil Tumbuh</th>
 <th class="py-3 px-4 text-center">Gagal / Kontaminasi</th>
 <th class="py-3 px-4 text-center">Progres Terakhir</th>
 <th class="py-3 px-4 text-right">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/20 text-[#374151]">
 @forelse($inokulasis as $inok)
 <tr class="hover:bg-[#F3F5F4]/40 transition duration-150">
 <td class="py-3.5 px-4 font-bold text-[#064E3B] text-xs">{{ \Carbon\Carbon::parse($inok->tanggal)->format('d M Y') }}<br><span class="text-[#6B7280] text-[10px]">{{ $inok->user->name }}</span></td>
 <td class="py-3.5 px-4 font-bold text-[#059669]">Sterilisasi #{{ $inok->sterilisasi_id }}<br><span class="text-[#6B7280] text-[10px] font-bold">Bibit: F2 {{ $inok->bibit->asal_bibit ?? $inok->bibit->kode_bibit ?? '-' }} ({{ $inok->jumlah_bibit_terpakai }} Botol)</span></td>
 <td class="py-3.5 px-4 text-center text-[#059669] font-bold text-xs">{{ number_format($inok->jumlah_berhasil) }} / {{ number_format($inok->sterilisasi->baglog->jumlah_baglog ?? 0) }} Pcs</td>
 <td class="py-3.5 px-4 text-center text-red-600 font-bold text-xs">{{ number_format($inok->jumlah_kontaminasi) }} Pcs</td>
 <td class="py-3.5 px-4 text-center">
 @if($inok->logInkubasis->count() > 0)
 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border bg-blue-100 text-blue-700 border-blue-300">
 {{ $inok->logInkubasis->sortByDesc('created_at')->first()->persentase_tumbuh }}%
 </span>
 <div class="text-[9px] text-[#6B7280] mt-1">{{ \Carbon\Carbon::parse($inok->logInkubasis->sortByDesc('created_at')->first()->tanggal_catat)->format('d/m/Y') }}</div>
 @else
 <span class="text-[10px] text-[#6B7280] italic">Belum ada progres</span>
 @endif
 </td>
 <td class="py-3.5 px-4 text-right">
 <div class="flex flex-col gap-2 items-end">
 <button type="button" @click.prevent="showDetailModal = true; selectedDetailId = {{ $inok->id }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-white border border-[#E5E7EB] hover:bg-gray-50 text-[#374151] text-[10px] font-bold rounded-lg transition duration-150 shadow-xs cursor-pointer w-32 gap-1.5 z-50">
 <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
 Detail Inkubasi
 </button>
 
 @php
 $maxProgres = $inok->logInkubasis->max('persentase_tumbuh') ?? 0;
 $hasPanen = \App\Models\ProductionReport::where('inokulasi_id', $inok->id)->exists() || $maxProgres == 100;
 @endphp
 
 @if($hasPanen)
 <button disabled class="inline-flex items-center justify-center px-3 py-1.5 bg-gray-400 text-white text-[10px] font-bold rounded-lg cursor-not-allowed w-32">
 🔒 Selesai (Masa Panen)
 </button>
 @else
 <button type="button" @click="showInputModal = {{ $inok->id }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-bold rounded-lg transition duration-150 shadow-xs cursor-pointer w-32">
 Pantau Inkubasi
 </button>
 <form method="POST" action="{{ route('inokulasi.destroy', $inok->id) }}" class="inline w-32" onsubmit="return confirm('Yakin ingin menghapus data inokulasi ini?');">
 @csrf
 @method('DELETE')
 <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-[10px] font-bold rounded-lg transition duration-150 shadow-xs cursor-pointer">
 Hapus
 </button>
 </form>
 @endif
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="py-12 text-center text-[#6B7280] font-medium italic">
 Belum ada riwayat inokulasi.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 
 <div class="mt-4">
 {{ $inokulasis->links() }}
 </div>
 </div>
 </div>

 </div>




 {{-- MODAL HISTORI PEMANTAUAN (TIMELINE) --}}
 @foreach($inokulasis as $inok)
 {{-- MODAL PANTAU INKUBASI (PER ROW) --}}
 <div x-show="showInputModal == {{ $inok->id }}" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
 <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
 <div x-show="showInputModal == {{ $inok->id }}" @click="showInputModal = null" class="fixed inset-0 transition-opacity" aria-hidden="true">
 <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
 </div>
 
 <div x-show="showInputModal == {{ $inok->id }}" class="inline-block align-bottom bg-[#FFFFFF] rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-[#E5E7EB]/40">
 <div class="bg-[#FFFFFF] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
 <div class="sm:flex sm:items-start">
 <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
 <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
 </div>
 <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
 <h3 class="text-lg leading-6 font-bold text-[#064E3B]" id="modal-title">
 Catat Progres Inkubasi
 </h3>
 <div class="mt-2">
 <p class="text-sm text-[#6B7280]">
 Masukkan data persentase pertumbuhan miselium untuk minggu ini.
 </p>
 
 <form action="{{ route('inokulasi.store-log', $inok->id) }}" method="POST" class="mt-4 space-y-4">
 @csrf
 <div>
 <label class="block text-xs font-bold text-[#047857] mb-1.5">Tanggal Cek Fisik</label>
 <input type="date" name="tanggal_catat" required value="{{ now()->format('Y-m-d') }}" class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 text-[#374151]">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-xs font-bold text-[#047857] mb-1.5">Miselium (%)</label>
 @php
 $nextTarget = $maxProgres + 25;
 @endphp
 <select name="persentase_tumbuh" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 text-[#374151]">
 <option value="25" {{ $nextTarget == 25 ? 'selected' : '' }}>Minggu 1: Pertumbuhan 25% (Awal)</option>
 <option value="50" {{ $nextTarget == 50 ? 'selected' : '' }}>Minggu 2: Pertumbuhan 50% (Sedang)</option>
 <option value="75" {{ $nextTarget == 75 ? 'selected' : '' }}>Minggu 3: Pertumbuhan 75% (Hampir Penuh)</option>
 <option value="100" {{ $nextTarget == 100 ? 'selected' : '' }}>Minggu 4: Pertumbuhan 100% (Memutih Sempurna)</option>
 </select>
 </div>
 <div>
 <label class="block text-xs font-bold text-red-600 mb-1.5">Baglog Kontaminasi (Pcs)</label>
 <input type="number" name="tambah_kontaminasi" min="0" value="0" class="block w-full rounded-xl border-red-200 bg-red-50 shadow-2xs focus:border-red-500 focus:ring-red-500 text-sm py-2.5 text-[#374151]">
 </div>
 </div>
 <div>
 <label class="block text-xs font-bold text-[#047857] mb-1.5">Catatan (Opsional)</label>
 <textarea name="catatan" rows="2" class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 text-[#374151]" placeholder="Contoh: Ada sedikit embun di dalam plastik..."></textarea>
 </div>
 <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end gap-3">
 <button type="button" @click="showInputModal = null" class="px-4 py-2 text-sm font-bold text-[#6B7280] hover:text-[#064E3B] transition">
 Batal
 </button>
 <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none shadow-md sm:text-sm">
 Simpan Progres Mingguan
 </button>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 <div x-show="showDetailModal && selectedDetailId == {{ $inok->id }}" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
 <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
 <div x-show="showDetailModal && selectedDetailId == {{ $inok->id }}" @click="showDetailModal = false" class="fixed inset-0 transition-opacity" aria-hidden="true">
 <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
 </div>
 
 <div x-show="showDetailModal && selectedDetailId == {{ $inok->id }}" class="inline-block align-bottom bg-[#FFFFFF] rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full border border-[#E5E7EB]/40">
 <div class="bg-[#FFFFFF] px-6 pt-5 pb-6">
 <div class="flex justify-between items-center mb-5 pb-4 border-b border-[#E5E7EB]/30">
 <h3 class="text-lg font-bold text-[#064E3B]">
 Histori Pemantauan Inkubasi
 </h3>
 <button type="button" @click="showDetailModal = false" class="text-gray-400 hover:text-gray-600 transition">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
 </button>
 </div>
 
 <div class="mt-2 space-y-4">
 @if($inok->logInkubasis->count() > 0)
 <div class="relative border-l-2 border-[#34D399] ml-3 space-y-6 pb-2">
 @foreach($inok->logInkubasis->sortBy('created_at') as $log)
 <div class="relative pl-6">
 <div class="absolute w-3 h-3 bg-[#059669] rounded-full -left-[7px] top-1.5 border-2 border-white"></div>
 <div class="flex justify-between items-start mb-1">
 <div class="text-sm font-bold text-[#064E3B]">Minggu ke-{{ $loop->iteration }} <span class="text-xs text-gray-500 font-normal ml-1">({{ \Carbon\Carbon::parse($log->tanggal_catat)->format('d M Y') }})</span></div>
 <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border bg-blue-100 text-blue-700 border-blue-300">
 Progres: {{ $log->persentase_tumbuh }}%
 </span>
 </div>
 <div class="text-xs text-gray-500 font-medium mb-1 flex items-center gap-1">
 <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
 Oleh: {{ $log->user->name ?? 'Petugas' }}
 </div>
 @if($log->catatan)
 <div class="text-xs text-gray-600 bg-gray-50 rounded-lg p-2 mt-2 border border-gray-100 italic">
 "{{ $log->catatan }}"
 </div>
 @endif
 </div>
 @endforeach
 </div>
 @else
 <div class="text-center py-8 text-gray-500 text-sm italic">
 Belum ada riwayat pemantauan untuk batch ini.
 </div>
 @endif
 </div>
 
 <div class="pt-6 mt-2 flex justify-end">
 <button type="button" @click="showDetailModal = false" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition shadow-xs">
 Tutup
 </button>
 </div>
 </div>
 </div>
 </div>
 </div>
 @endforeach

 </div>
 </div>
 
 </div>
 </div>
</x-app-layout>

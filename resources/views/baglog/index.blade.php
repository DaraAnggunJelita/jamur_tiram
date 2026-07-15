<x-app-layout>
 <div class="py-12 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- Notifikasi Sukses --}}
 @if(session('success'))
 <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-sm font-bold shadow-2xs">
 {{ session('success') }}
 </div>
 @endif

 <div class="grid grid-cols-1 gap-6">

 {{-- Card Riwayat Utama --}}
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/20">
 <div>
 <h3 class="text-xl font-bold text-[#064E3B]">Riwayat Pembuatan Baglog</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Daftar batch pembuatan baglog baru.</p>
 </div>
 @if(auth()->user()->role ==='petugas')
 <a href="{{ route('baglog.create') }}"
 class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
 Tambah Batch Baglog
 </a>
 @endif
 </div>

 {{-- Form Filter & Pencarian --}}
 <form method="GET" action="{{ route('baglog.index') }}" class="flex flex-col sm:flex-row items-center gap-4 mb-6">
 <div class="w-full sm:w-1/2">
 <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama, batch, atau kode..." class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 500);">
 </div>
 <div class="w-full sm:w-1/3">
 <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" title="Pilih Tanggal" onchange="this.form.submit()">
 </div>
 <div class="w-full sm:w-auto flex items-center gap-2">
 <button type="submit" class="p-2.5 bg-[#059669] text-white rounded-xl hover:bg-[#047857] transition shadow-md shadow-[#059669]/10" title="Filter">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
 </button>
 <a href="{{ route('baglog.index') }}" class="p-2.5 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition shadow-md" title="Reset">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
 </a>
 </div>
 </form>

 {{-- Struktur Tabel Organik --}}
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm border-collapse">
 <thead>
 <tr class="border-b border-[#E5E7EB]/40 text-[#047857] text-xs font-bold">
 <th class="py-3 px-4">Tgl Pembuatan</th>
 <th class="py-3 px-4">Kode Batch</th>
 <th class="py-3 px-4">Petugas</th>
 <th class="py-3 px-4">Jumlah Baglog</th>
 @if(auth()->user()->role ==='petugas')
 <th class="py-3 px-4 text-right">Aksi</th>
 @endif
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/20 text-[#374151]">
 @forelse($baglogs as $log)
 <tr class="hover:bg-[#F3F5F4]/40 transition duration-150">
 <td class="py-3.5 px-4 font-bold text-[#064E3B] text-xs">{{ \Carbon\Carbon::parse($log->tanggal_pembuatan)->format('d M Y') }}</td>
 <td class="py-3.5 px-4 font-bold text-[#059669]">{{ $log->kode_batch }}</td>
 <td class="py-3.5 px-4 font-medium">{{ $log->user->name }}</td>
 <td class="py-3.5 px-4 text-[#059669] font-bold text-xs">{{ number_format($log->jumlah_baglog) }} Pcs</td>
 @if(auth()->user()->role ==='petugas')
 <td class="py-3.5 px-4 text-right">
 @php
 $hasSterilisasi = \App\Models\Sterilisasi::where('baglog_id', $log->id)->exists();
 @endphp
 @if($hasSterilisasi)
 <span class="text-[10px] text-[#6B7280] font-bold italic">Terkunci (Sudah Sterilisasi)</span>
 @else
 <div class="flex items-center justify-end gap-2">
 <a href="{{ route('baglog.edit', $log->id) }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-[#10B981] hover:bg-[#059669] text-white text-[10px] font-bold rounded-lg transition duration-150 shadow-xs cursor-pointer">
 Edit
 </a>
 <form method="POST" action="{{ route('baglog.destroy', $log->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus data baglog ini?');">
 @csrf
 @method('DELETE')
 <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-[10px] font-bold rounded-lg transition duration-150 shadow-xs cursor-pointer">
 Hapus
 </button>
 </form>
 </div>
 @endif
 </td>
 @endif
 </tr>
 @empty
 <tr>
 <td colspan="{{ auth()->user()->role ==='petugas' ? 5 : 4 }}" class="py-12 text-center text-[#6B7280] font-medium italic">
 Belum ada log batch pembuatan baglog.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 
 <div class="mt-4">
 {{ $baglogs->links() }}
 </div>
 </div>



 </div>

 </div>
 </div>
</x-app-layout>

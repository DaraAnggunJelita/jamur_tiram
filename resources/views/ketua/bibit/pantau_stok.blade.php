<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <a href="{{ route('ketua.dashboard') }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                title="Kembali ke Dashboard">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Pantau Stok Bibit') }}
            </h2>
        </div>
    </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- Notifikasi --}}
 @if(session('success'))
 <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-sm font-bold shadow-2xs">
 {{ session('success') }}
 </div>
 @endif
 @if(session('error'))
 <div class="p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl text-sm font-bold shadow-2xs">
 {{ session('error') }}
 </div>
 @endif

 <div class="grid grid-cols-1 gap-6">

            {{-- Ringkasan Pasokan Global --}}
            @if($batches->isNotEmpty())
            <div class="bg-white rounded-2xl p-5 border border-[#E5E7EB]/70 shadow-2xs">
                <div class="flex items-center gap-2 mb-4 border-b border-[#E5E7EB]/40 pb-3">
                    <div class="w-8 h-8 bg-[#34D399]/15 text-[#059669] rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-xs font-extrabold text-[#064E3B] uppercase tracking-wider">Ringkasan Total Pasokan Global (Utuh)</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    @foreach($batches as $batch)
                    <div class="bg-gray-50 rounded-xl p-3 border border-gray-200">
                        <p class="text-[10px] font-bold text-gray-500 mb-1">
                            {{ \Carbon\Carbon::parse($batch->tanggal_masuk)->isoFormat('D MMM Y') }}
                        </p>
                        <p class="text-[11px] font-extrabold text-[#064E3B] mb-2 truncate" title="{{ $batch->asal_bibit }}">{{ $batch->asal_bibit ?? '-' }}</p>
                        <div class="flex items-center justify-between mt-1">
                            <div>
                                <p class="text-[10px] text-gray-500 font-medium">Total Masuk</p>
                                <p class="text-xs font-bold text-[#059669]">{{ (float)$batch->total_batch }} Bks</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-500 font-medium">Sisa Stok</p>
                                <p class="text-xs font-bold {{ $batch->sisa_batch > 0 ? 'text-[#F59E0B]' : 'text-red-500' }}">{{ (float)$batch->sisa_batch }} Bks</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-[10px] text-gray-500 italic mt-3"> Jumlah awal bibit sebelum dipecah per petugas.</p>
            </div>
            @endif

            <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/20">
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Konfirmasi & Pantau Stok Bibit</h3>
 {{-- <p class="text-xs text-[#6B7280] font-medium mt-0.5">Pemantauan real-time stok bibit yang ada di gudang lapangan.</p> --}}
 </div>
 <form method="GET" class="relative w-full sm:w-64 shrink-0">
 <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari bibit atau petugas..."
 class="w-full pl-9 pr-4 py-2 border border-[#E5E7EB]/80 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#059669]/20 focus:border-[#059669] text-xs font-semibold text-[#064E3B] transition shadow-2xs" />
 <svg class="w-4 h-4 text-[#9CA3AF] absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
 </form>
 </div>

 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm border-collapse">
 <thead>
 <tr class="border-b border-[#E5E7EB]/40 text-[#047857] text-xs font-bold">
 <th class="py-3 px-4">Kode Bibit</th>
 <th class="py-3 px-4">Asal Bibit</th>
 <th class="py-3 px-4">Distribusi (Petugas)</th>
 <th class="py-3 px-4 text-center">Jatah Awal Petugas</th>
 <th class="py-3 px-4 text-center">Jumlah Terpakai</th>
 <th class="py-3 px-4 text-center">Sisa Stok Saat Ini</th>
 <th class="py-3 px-4 text-center">Status</th>
 <th class="py-3 px-4 text-center">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/20 text-[#374151]">
 @forelse($bibits as $bibit)
 <tr class="hover:bg-[#F3F5F4]/40 transition duration-150">
 <td class="py-3.5 px-4 font-bold text-[#059669]">{{ $bibit->kode_bibit }}</td>
 <td class="py-3.5 px-4 font-medium text-[#047857]">{{ $bibit->asal_bibit ??'-' }}</td>
 <td class="py-3.5 px-4 font-medium text-[#047857] text-xs">
     <div class="flex items-center space-x-1.5">
         <svg class="w-4 h-4 text-[#059669]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
         <span>{{ preg_replace('/([^\s])\(/', '$1 (', $bibit->user->name ?? 'Belum Ditentukan') }}</span>
     </div>
 </td>
 <td class="py-3.5 px-4 text-center text-[#059669] font-bold text-xs">{{ (float)($bibit->jumlah) }} Bungkus</td>
 <td class="py-3.5 px-4 text-center text-red-600 font-bold text-xs">{{ (float)($bibit->jumlah - $bibit->sisa_stok) }} Bungkus</td>
 <td class="py-3.5 px-4 text-center text-[#6B7280] font-bold text-xs">{{ (float)($bibit->sisa_stok) }} Bungkus</td>
 <td class="py-3.5 px-4 text-center">
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border
 @if($bibit->status ==='Aktif/Siap Pakai') bg-[#34D399]/15 text-[#047857] border-[#34D399]/30
 @elseif($bibit->status ==='Pending Konfirmasi Admin') bg-amber-100 text-amber-700 border-amber-300
 @else bg-red-100 text-red-700 border-red-300 @endif">
 {{ $bibit->status }}
 </span>
 </td>
 <td class="py-3.5 px-4 text-center whitespace-nowrap">
 <div class="flex items-center justify-center space-x-2">
 @if($bibit->sisa_stok == $bibit->jumlah)
 <a href="{{ route('bibit.edit', $bibit->id) }}"
 class="p-1.5 bg-[#E6DAC2]/40 text-[#047857] hover:bg-[#E6DAC2]/80 border border-[#E5E7EB]/60 rounded-lg transition duration-150 shadow-2xs"
 title="Edit Bibit">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H8v-3.828l9.282-9.282z"/>
 </svg>
 </a>
 <form action="{{ route('bibit.destroy', $bibit->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus stok bibit ini?');" class="inline">
 @csrf
 @method('DELETE')
 <button type="submit"
 class="p-1.5 bg-red-100 text-red-600 hover:bg-red-200 border border-red-200 rounded-lg transition duration-150 shadow-2xs cursor-pointer"
 title="Hapus Bibit">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
 </svg>
 </button>
 </form>
 @else
 <span class="text-[10px] italic text-[#6B7280] font-medium">Terkunci (Terpakai)</span>
 @endif
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="7" class="py-12 text-center text-[#6B7280] font-medium italic">
 Belum ada data stok bibit.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 <div class="mt-4 px-2">
     {{ $bibits->links() }}
 </div>
 </div>
 </div>

 </div>
 </div>
</x-app-layout>

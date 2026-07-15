<x-app-layout>
 <div class="py-12 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
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
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/20">
 <div>
 <h3 class="text-xl font-bold text-[#064E3B]">Konfirmasi & Pantau Stok Bibit</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Pemantauan real-time stok bibit yang ada di gudang lapangan.</p>
 </div>
 </div>

 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm border-collapse">
 <thead>
 <tr class="border-b border-[#E5E7EB]/40 text-[#047857] text-xs font-bold">
 <th class="py-3 px-4">Kode Bibit</th>
 <th class="py-3 px-4">Asal Bibit</th>
 <th class="py-3 px-4 text-center">Total Stok Awal</th>
 <th class="py-3 px-4 text-center">Jumlah Terpakai</th>
 <th class="py-3 px-4 text-center">Sisa Stok Saat Ini</th>
 <th class="py-3 px-4 text-center">Status</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/20 text-[#374151]">
 @forelse($bibits as $bibit)
 <tr class="hover:bg-[#F3F5F4]/40 transition duration-150">
 <td class="py-3.5 px-4 font-bold text-[#059669]">{{ $bibit->kode_bibit }}</td>
 <td class="py-3.5 px-4 font-medium text-[#047857]">{{ $bibit->asal_bibit ??'-' }}</td>
 <td class="py-3.5 px-4 text-center text-[#059669] font-bold text-xs">{{ number_format($bibit->jumlah) }}</td>
 <td class="py-3.5 px-4 text-center text-red-600 font-bold text-xs">{{ number_format($bibit->jumlah - $bibit->sisa_stok) }}</td>
 <td class="py-3.5 px-4 text-center text-[#6B7280] font-bold text-xs">{{ number_format($bibit->sisa_stok) }}</td>
 <td class="py-3.5 px-4 text-center">
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border 
 @if($bibit->status ==='Aktif/Siap Pakai') bg-[#34D399]/15 text-[#047857] border-[#34D399]/30
 @elseif($bibit->status ==='Pending Konfirmasi Admin') bg-amber-100 text-amber-700 border-amber-300
 @else bg-red-100 text-red-700 border-red-300 @endif">
 {{ $bibit->status }}
 </span>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class="py-12 text-center text-[#6B7280] font-medium italic">
 Belum ada data stok bibit.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>

 </div>
 </div>
</x-app-layout>

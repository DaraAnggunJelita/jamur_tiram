<x-app-layout>
 <div class="py-12 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 @if(session('success'))
 <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-sm font-bold shadow-2xs">
 {{ session('success') }}
 </div>
 @endif

 <div class="grid grid-cols-1 gap-6">
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/20">
 <div>
 <h3 class="text-xl font-bold text-[#064E3B]">Log Monitoring Kumbung</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Catatan pengawasan visual harian terhadap suhu/kelembapan ruang kumbung.</p>
 </div>
 @if(auth()->user()->role ==='petugas')
 <a href="{{ route('monitoring.create') }}"
 class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
 Input Monitoring Harian
 </a>
 @endif
 </div>

 {{-- Form Filter & Pencarian --}}
 <form method="GET" action="{{ route('monitoring.index') }}" class="flex flex-col sm:flex-row items-center gap-4 mb-6">
 <div class="w-full sm:w-1/2">
 <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama petugas, id inokulasi..." class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" oninput="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 500);">
 </div>
 <div class="w-full sm:w-1/3">
 <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border-[#E5E7EB] text-sm focus:border-[#059669] focus:ring-[#059669]" title="Pilih Tanggal" onchange="this.form.submit()">
 </div>
 <div class="w-full sm:w-auto flex items-center gap-2">
 <button type="submit" class="p-2.5 bg-[#059669] text-white rounded-xl hover:bg-[#047857] transition shadow-md shadow-[#059669]/10" title="Filter">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
 </button>
 <a href="{{ route('monitoring.index') }}" class="p-2.5 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition shadow-md" title="Reset">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
 </a>
 </div>
 </form>

 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm border-collapse">
 <thead>
 <tr class="border-b border-[#E5E7EB]/40 text-[#047857] text-xs font-bold">
 <th class="py-3 px-4">Tanggal & Petugas</th>
 <th class="py-3 px-4">Ref. Inokulasi</th>
 <th class="py-3 px-4 text-center">Kondisi Udara</th>
 <th class="py-3 px-4 text-center">Kondisi Lantai</th>
 <th class="py-3 px-4 text-center">Jml Penyiraman</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/20 text-[#374151]">
 @forelse($monitorings as $mon)
 <tr class="hover:bg-[#F3F5F4]/40 transition duration-150">
 <td class="py-3.5 px-4 font-bold text-[#064E3B] text-xs">{{ \Carbon\Carbon::parse($mon->tanggal)->format('d M Y') }}<br><span class="text-[#6B7280] text-[10px]">{{ $mon->user->name }}</span></td>
 <td class="py-3.5 px-4 font-bold text-[#059669]">Inokulasi #{{ $mon->inokulasi_id }}</td>
 <td class="py-3.5 px-4 text-center text-xs font-bold">
 @if($mon->kondisi_udara =='Sejuk') <span class="text-blue-600">Sejuk</span>
 @elseif($mon->kondisi_udara =='Hangat') <span class="text-yellow-600">Hangat</span>
 @else <span class="text-red-600 animate-pulse">Panas/Gersang</span> @endif
 </td>
 <td class="py-3.5 px-4 text-center text-xs font-bold">
 @if($mon->kondisi_lantai =='Basah/Lembab') <span class="text-blue-600">Basah/Lembab</span>
 @else <span class="text-red-600 animate-pulse">Kering</span> @endif
 </td>
 <td class="py-3.5 px-4 text-center font-bold text-xs {{ $mon->jumlah_penyiraman < 2 ?'text-red-600' :'text-[#059669]' }}">
 {{ $mon->jumlah_penyiraman }}x Hari Ini
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="py-12 text-center text-[#6B7280] font-medium italic">
 Belum ada riwayat monitoring.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>

 <div class="mt-4">
 {{ $monitorings->links() }}
 </div>
 </div>
 </div>

 </div>
 </div>
</x-app-layout>

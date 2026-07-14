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

 {{-- Card Jadwal Panen Utama --}}
 <div class="bg-[#FFFFFF] border border-[#E5E7EB]/40 rounded-2xl p-6 shadow-xs">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/20">
 <div>
 <h3 class="text-xl font-bold text-[#064E3B]">Agenda & Jadwal Panen Jamur</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Kalender agenda mendatang untuk kesiapan masa panen harian.</p>
 </div>
 @if(auth()->user()->role !=='ketua')
 <a href="{{ route('jadwal-panen.create') }}"
 class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
 Tambah Jadwal
 </a>
 @endif
 </div>

 {{-- List Item Agenda --}}
 <div class="space-y-3">
 @forelse($jadwals as $jadwal)
 <div class="flex items-center gap-4 p-4 rounded-xl border border-[#E5E7EB]/20 bg-[#F3F5F4]/40 hover:bg-[#FFFFFF] hover:border-[#E5E7EB]/50 transition duration-150">

 {{-- Kotak Penanggalan Kalender Kreatif --}}
 <div class="w-12 h-12 rounded-xl bg-[#FFFFFF] border border-[#E5E7EB]/60 flex flex-col items-center justify-center shrink-0 shadow-2xs">
 <span class="text-[9px] font-bold leading-none text-[#047857]">{{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->format('M') }}</span>
 <span class="text-base font-bold leading-none mt-1 text-[#064E3B]">{{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->format('d') }}</span>
 </div>

 {{-- Isi Catatan Agenda --}}
 <div class="flex-1 min-w-0">
 <h4 class="text-sm font-bold text-[#064E3B] flex items-center flex-wrap gap-2">
 <span>Estimasi Panen Jamur Tiram</span>
 @if(\Carbon\Carbon::parse($jadwal->tanggal_estimasi)->isToday())
 <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-bold bg-[#F59E0B] text-[#FFFFFF] shadow-2xs animate-pulse">Hari Ini</span>
 @endif
 </h4>
 <p class="text-xs text-[#047857] font-medium mt-0.5 leading-relaxed truncate">
 {{ $jadwal->catatan ??'Tidak ada catatan khusus lapangan.' }}
 </p>
 </div>

 {{-- Durasi Mundur (Countdown Badge) & Aksi --}}
 <div class="text-right shrink-0 flex items-center gap-3">
 <span class="text-[10px] font-bold px-2.5 py-1 bg-[#E6DAC2]/50 text-[#047857] rounded-lg border border-[#E5E7EB]/40">
 {{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->diffForHumans(null, true) }} lagi
 </span>
 @if(auth()->user()->role !=='ketua')
 <a href="{{ route('jadwal-panen.edit', $jadwal->id) }}" class="text-[#6B7280] hover:text-[#059669] transition" title="Edit Jadwal">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
 </a>
 <form action="{{ route('jadwal-panen.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal panen ini?');" class="inline-block m-0 p-0">
 @csrf
 @method('DELETE')
 <button type="submit" class="text-[#F59E0B] hover:text-red-600 transition" title="Hapus Jadwal">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
 </button>
 </form>
 @endif
 </div>
 </div>
 @empty
 <div class="py-12 text-center text-[#6B7280] font-medium italic">
 Belum ada agenda jadwal panen terdekat yang diatur.
 </div>
 @endif
 </div>
 </div>

 </div>

 </div>
 </div>
</x-app-layout>

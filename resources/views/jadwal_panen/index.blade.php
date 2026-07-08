<x-app-layout>
    <div class="py-12 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="p-4 bg-[#7C9169]/10 border border-[#7C9169]/30 text-[#37452F] rounded-xl text-sm font-bold shadow-2xs">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6">

                {{-- Card Jadwal Panen Utama --}}
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#C9B896]/20">
                        <div>
                            <h3 class="text-xl font-black text-[#26201B] font-heading tracking-tight">Agenda & Jadwal Panen Jamur</h3>
                            <p class="text-xs text-[#8E6E4E] font-medium mt-0.5">Kalender agenda mendatang untuk kesiapan masa panen harian.</p>
                        </div>
                        @if(auth()->user()->role !== 'ketua')
                            <a href="{{ route('jadwal-panen.create') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Tambah Jadwal
                            </a>
                        @endif
                    </div>

                    {{-- List Item Agenda --}}
                    <div class="space-y-3">
                        @forelse($jadwals as $jadwal)
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-[#C9B896]/20 bg-[#F6F1E6]/40 hover:bg-[#FBF8F1] hover:border-[#C9B896]/50 transition duration-150">

                            {{-- Kotak Penanggalan Kalender Kreatif --}}
                            <div class="w-12 h-12 rounded-xl bg-[#FBF8F1] border border-[#C9B896]/60 flex flex-col items-center justify-center shrink-0 shadow-2xs">
                                <span class="text-[9px] font-black uppercase leading-none text-[#6B4E36] tracking-wider font-mono-data">{{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->format('M') }}</span>
                                <span class="text-base font-black leading-none mt-1 text-[#26201B] font-heading">{{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->format('d') }}</span>
                            </div>

                            {{-- Isi Catatan Agenda --}}
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-black text-[#26201B] font-heading flex items-center flex-wrap gap-2">
                                    <span>Estimasi Panen Jamur Tiram</span>
                                    @if(\Carbon\Carbon::parse($jadwal->tanggal_estimasi)->isToday())
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black bg-[#A0653D] text-[#FBF8F1] tracking-widest uppercase shadow-2xs animate-pulse font-mono-data">Hari Ini</span>
                                    @endif
                                </h4>
                                <p class="text-xs text-[#6B4E36] font-medium mt-0.5 leading-relaxed truncate">
                                    {{ $jadwal->catatan ?? 'Tidak ada catatan khusus lapangan.' }}
                                </p>
                            </div>

                            {{-- Durasi Mundur (Countdown Badge) & Aksi --}}
                            <div class="text-right shrink-0 flex items-center gap-3">
                                <span class="text-[10px] font-mono-data font-black px-2.5 py-1 bg-[#E6DAC2]/50 text-[#37452F] rounded-lg border border-[#C9B896]/40 uppercase tracking-wide">
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->diffForHumans(null, true) }} lagi
                                </span>
                                @if(auth()->user()->role !== 'ketua')
                                <a href="{{ route('jadwal-panen.edit', $jadwal->id) }}" class="text-[#8E6E4E] hover:text-[#4F6146] transition" title="Edit Jadwal">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('jadwal-panen.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal panen ini?');" class="inline-block m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#A0653D] hover:text-red-600 transition" title="Hapus Jadwal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="py-12 text-center text-[#8E6E4E] font-medium font-heading italic">
                            Belum ada agenda jadwal panen terdekat yang diatur.
                        </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

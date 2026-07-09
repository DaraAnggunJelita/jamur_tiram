<x-app-layout>
    <div class="py-12 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-[#7C9169]/10 border border-[#7C9169]/30 text-[#37452F] rounded-xl text-sm font-bold shadow-2xs">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6">
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#C9B896]/20">
                        <div>
                            <h3 class="text-xl font-black text-[#26201B] font-heading tracking-tight">Log Monitoring Kumbung</h3>
                            <p class="text-xs text-[#8E6E4E] font-medium mt-0.5">Catatan pengawasan visual harian terhadap suhu/kelembapan ruang kumbung.</p>
                        </div>
                        @if(auth()->user()->role === 'petugas')
                            <a href="{{ route('monitoring.create') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Input Monitoring Harian
                            </a>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-[#C9B896]/40 text-[#6B4E36] text-xs font-black uppercase tracking-widest">
                                    <th class="py-3 px-4 font-heading">Tanggal & Petugas</th>
                                    <th class="py-3 px-4 font-heading">Ref. Inokulasi</th>
                                    <th class="py-3 px-4 font-heading text-center">Kondisi Udara</th>
                                    <th class="py-3 px-4 font-heading text-center">Kondisi Lantai</th>
                                    <th class="py-3 px-4 font-heading text-center">Jml Penyiraman</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#C9B896]/20 text-[#362C24]">
                                @forelse($monitorings as $mon)
                                <tr class="hover:bg-[#F6F1E6]/40 transition duration-150">
                                    <td class="py-3.5 px-4 font-black text-[#26201B] font-mono-data text-xs">{{ \Carbon\Carbon::parse($mon->tanggal)->format('d M Y') }}<br><span class="text-[#8E6E4E] text-[10px]">{{ $mon->user->name }}</span></td>
                                    <td class="py-3.5 px-4 font-black text-[#4F6146]">Inokulasi #{{ $mon->inokulasi_id }}</td>
                                    <td class="py-3.5 px-4 text-center text-xs font-bold">
                                        @if($mon->kondisi_udara == 'Sejuk') <span class="text-blue-600">Sejuk</span>
                                        @elseif($mon->kondisi_udara == 'Hangat') <span class="text-yellow-600">Hangat</span>
                                        @else <span class="text-red-600 animate-pulse">Panas/Gersang</span> @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-center text-xs font-bold">
                                        @if($mon->kondisi_lantai == 'Basah/Lembab') <span class="text-blue-600">Basah/Lembab</span>
                                        @else <span class="text-red-600 animate-pulse">Kering</span> @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-center font-mono-data font-black text-xs {{ $mon->jumlah_penyiraman < 2 ? 'text-red-600' : 'text-[#4F6146]' }}">
                                        {{ $mon->jumlah_penyiraman }}x Hari Ini
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-[#8E6E4E] font-medium font-heading italic">
                                        Belum ada riwayat monitoring.
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

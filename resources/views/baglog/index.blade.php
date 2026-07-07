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

                {{-- Card Riwayat Utama --}}
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#C9B896]/20">
                        <div>
                            <h3 class="text-xl font-black text-[#26201B] font-heading tracking-tight">Riwayat Pengecekan Baglog</h3>
                            <p class="text-xs text-[#8E6E4E] font-medium mt-0.5">Daftar pemantauan kondisi pertumbuhan jamur tiram.</p>
                        </div>
                        @if(auth()->user()->role === 'petugas')
                            <a href="{{ route('baglog.create') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Log Kondisi Kumbung
                            </a>
                        @endif
                    </div>

                    {{-- Struktur Tabel Organik --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-[#C9B896]/40 text-[#6B4E36] text-xs font-black uppercase tracking-widest">
                                    <th class="py-3 px-4 font-heading">Tanggal</th>
                                    <th class="py-3 px-4 font-heading">Petugas</th>
                                    <th class="py-3 px-4 font-heading">Baglog Aktif</th>
                                    <th class="py-3 px-4 font-heading">Kondisi Kumbung</th>
                                    <th class="py-3 px-4 text-center font-heading">Status</th>
                                    @if(auth()->user()->role === 'admin')
                                        <th class="py-3 px-4 text-right font-heading">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#C9B896]/20 text-[#362C24]">
                                @forelse($baglogs as $log)
                                <tr class="hover:bg-[#F6F1E6]/40 transition duration-150">
                                    <td class="py-3.5 px-4 font-black text-[#26201B] font-mono-data text-xs">{{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}</td>
                                    <td class="py-3.5 px-4 font-medium">{{ $log->user->name }}</td>
                                    <td class="py-3.5 px-4 font-mono-data text-[#4F6146] font-black text-xs">{{ number_format($log->jumlah_baglog_aktif) }} Pcs</td>
                                    <td class="py-3.5 px-4 truncate max-w-[200px] font-medium">{{ $log->kondisi_kumbung }}</td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black border uppercase tracking-wider font-mono-data
                                            {{ $log->status_validasi === 'valid'
                                                ? 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30'
                                                : 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20 animate-pulse' }}">
                                            {{ $log->status_validasi }}
                                        </span>
                                    </td>
                                    @if(auth()->user()->role === 'admin')
                                    <td class="py-3.5 px-4 text-right">
                                        @if($log->status_validasi === 'pending')
                                        <form method="POST" action="{{ route('baglog.validate', $log->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-[#4F6146] hover:bg-[#37452F] text-white font-black text-[10px] uppercase tracking-wider px-3 py-1.5 rounded-lg transition duration-150 shadow-xs cursor-pointer">
                                                Validasi
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-xs text-[#8E6E4E] font-bold italic">Selesai</span>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}" class="py-12 text-center text-[#8E6E4E] font-medium font-heading italic">
                                        Belum ada log pengecekan baglog yang diinput di kumbung.
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

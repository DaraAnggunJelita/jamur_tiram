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
                <div class="bg-[#FBF8F1] border border-[#C9B896]/40 rounded-2xl p-6 shadow-xs overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#C9B896]/20">
                        <div>
                            <h3 class="text-xl font-black text-[#26201B] font-heading tracking-tight">Data Pembibitan (Stok F2)</h3>
                            <p class="text-xs text-[#8E6E4E] font-medium mt-0.5">Daftar riwayat stok bibit jamur tiram yang masuk.</p>
                        </div>
                        @if(auth()->user()->role === 'petugas')
                            <a href="{{ route('bibit.create') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Input Stok Bibit Baru
                            </a>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-[#C9B896]/40 text-[#6B4E36] text-xs font-black uppercase tracking-widest">
                                    <th class="py-3 px-4 font-heading">Tgl Masuk</th>
                                    <th class="py-3 px-4 font-heading">Kode Bibit</th>
                                    <th class="py-3 px-4 font-heading">Petugas Input</th>
                                    <th class="py-3 px-4 font-heading text-center">Jumlah Botol</th>
                                    <th class="py-3 px-4 font-heading text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#C9B896]/20 text-[#362C24]">
                                @forelse($bibits as $bibit)
                                <tr class="hover:bg-[#F6F1E6]/40 transition duration-150">
                                    <td class="py-3.5 px-4 font-black text-[#26201B] font-mono-data text-xs">{{ \Carbon\Carbon::parse($bibit->tanggal_masuk)->format('d M Y') }}</td>
                                    <td class="py-3.5 px-4 font-black text-[#4F6146]">{{ $bibit->kode_bibit }}</td>
                                    <td class="py-3.5 px-4 font-medium">{{ $bibit->user->name }}</td>
                                    <td class="py-3.5 px-4 text-center font-mono-data text-[#4F6146] font-black text-xs">{{ number_format($bibit->jumlah) }} Botol</td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black border uppercase tracking-wider font-mono-data bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30">
                                            {{ $bibit->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-[#8E6E4E] font-medium font-heading italic">
                                        Belum ada data stok bibit masuk.
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

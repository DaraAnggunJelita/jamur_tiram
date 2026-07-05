<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen text-slate-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-55 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-semibold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6">

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Riwayat Pengecekan Baglog</h3>
                            <p class="text-xs text-slate-500">Daftar pemantauan kondisi pertumbuhan jamur tiram.</p>
                        </div>
                        @if(auth()->user()->role === 'petugas')
                            <a href="{{ route('baglog.create') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black uppercase tracking-wider rounded-xl transition duration-150 shadow-sm transform hover:-translate-y-0.5 self-start sm:self-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Log Kondisi Kumbung
                            </a>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                    <th class="py-3 px-4">Tanggal</th>
                                    <th class="py-3 px-4">Petugas</th>
                                    <th class="py-3 px-4">Baglog Aktif</th>
                                    <th class="py-3 px-4">Kondisi Kumbung</th>
                                    <th class="py-3 px-4 text-center">Status</th>
                                    @if(auth()->user()->role === 'admin')
                                        <th class="py-3 px-4 text-right">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @forelse($baglogs as $log)
                                <tr class="hover:bg-slate-50 transition duration-150">
                                    <td class="py-3.5 px-4 font-semibold text-slate-900">{{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}</td>
                                    <td class="py-3.5 px-4 text-slate-600">{{ $log->user->name }}</td>
                                    <td class="py-3.5 px-4 font-mono text-emerald-600 font-bold">{{ number_format($log->jumlah_baglog_aktif) }} Pcs</td>
                                    <td class="py-3.5 px-4 truncate max-w-[200px]">{{ $log->kondisi_kumbung }}</td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border
                                            {{ $log->status_validasi === 'valid'
                                                ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                                : 'bg-amber-50 text-amber-700 border-amber-200 animate-pulse' }}">
                                            {{ ucfirst($log->status_validasi) }}
                                        </span>
                                    </td>
                                    @if(auth()->user()->role === 'admin')
                                    <td class="py-3.5 px-4 text-right">
                                        @if($log->status_validasi === 'pending')
                                        <form method="POST" action="{{ route('baglog.validate', $log->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-3 py-1.5 rounded-lg transition duration-150 shadow-xs">
                                                Validasi
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-xs text-slate-400 font-semibold italic">Selesai</span>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-400 font-medium">Belum ada log pengecekan baglog yang diinput.</td>
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

<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen text-slate-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-55 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-semibold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6">

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Agenda & Jadwal Panen Jamur</h3>
                            <p class="text-xs text-slate-500">Kalender agenda mendatang untuk kesiapan masa panen.</p>
                        </div>
                        @if(auth()->user()->role !== 'ketua')
                            <a href="{{ route('jadwal-panen.create') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black uppercase tracking-wider rounded-xl transition duration-150 shadow-sm transform hover:-translate-y-0.5 self-start sm:self-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Tambah Jadwal
                            </a>
                        @endif
                    </div>

                    <div class="space-y-3">
                        @forelse($jadwals as $jadwal)
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 transition duration-150">

                            <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-200 flex flex-col items-center justify-center text-emerald-700 shrink-0 shadow-xs">
                                <span class="text-[9px] font-extrabold uppercase leading-none text-emerald-600">{{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->format('M') }}</span>
                                <span class="text-base font-black leading-none mt-0.5">{{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->format('d') }}</span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-slate-900 flex items-center flex-wrap gap-2">
                                    <span>Estimasi Panen Jamur Tiram</span>
                                    @if(\Carbon\Carbon::parse($jadwal->tanggal_estimasi)->isToday())
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black bg-rose-600 text-white tracking-wider uppercase shadow-xs animate-pulse">Hari Ini</span>
                                    @endif
                                </h4>
                                <p class="text-xs text-slate-600 mt-0.5 leading-relaxed truncate">
                                    {{ $jadwal->catatan ?? 'Tidak ada catatan khusus lapangan.' }}
                                </p>
                            </div>

                            <div class="text-right shrink-0">
                                <span class="text-[11px] font-mono font-bold px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg border border-slate-200">
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal_estimasi)->diffForHumans(null, true) }} lagi
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="py-8 text-center text-slate-400 font-medium">Belum ada agenda jadwal panen terdekat.</div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-black text-2xl text-slate-950 tracking-tight leading-tight">
                    {{ __('Dashboard Administrator') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola verifikasi pasokan masuk dan otentikasi data KUPS Harapan Asri</p>
            </div>
            <div class="flex items-center self-start sm:self-center">
                <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-[10px] font-black px-3.5 py-1.5 rounded-xl shadow-md shadow-emerald-600/20 uppercase tracking-wider">
                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                    Sistem Validasi Utama
                </span>
            </div>
        </div>
    </x-slot>



    <div class="py-8 bg-slate-50 min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            {{-- Action Notification System --}}
            @if (session('success'))
                <div class="mb-8 bg-gradient-to-r from-emerald-900 to-teal-950 text-white p-4 rounded-xl shadow-xl shadow-emerald-950/10 border border-emerald-700/50 flex items-center justify-between transition animate-fadeIn" role="alert">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white shadow-md">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm">Konfirmasi Berhasil</p>
                            <p class="text-xs text-emerald-200/90 font-light mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- === SECTION 1: METRIC DASHBOARD CARDS (Vibrant & Colorful) === --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-gradient-to-br from-amber-50/60 via-white to-white rounded-2xl border border-amber-200/70 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-amber-100/40 hover:border-amber-400 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-amber-700/80 font-extrabold uppercase tracking-widest">Antrian Tertunda</p>
                        <h4 class="text-2xl font-black text-slate-900 mt-0.5">{{ $pendingReports->count() }} <span class="text-xs font-bold text-slate-400">Berkas</span></h4>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-50/60 via-white to-white rounded-2xl border border-emerald-200/70 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-emerald-100/40 hover:border-emerald-400 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-600/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-emerald-800/80 font-extrabold uppercase tracking-widest">Total Berat Tunggu</p>
                        <h4 class="text-2xl font-black text-slate-900 mt-0.5">{{ number_format($pendingReports->sum('jumlah_panen'), 1) }} <span class="text-xs font-bold text-slate-400">Kg</span></h4>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-50/60 via-white to-white rounded-2xl border border-indigo-200/70 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-indigo-100/40 hover:border-indigo-400 transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-600/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-indigo-700/80 font-extrabold uppercase tracking-widest">Selesai Diverifikasi</p>
                        <h4 class="text-2xl font-black text-slate-900 mt-0.5">{{ \App\Models\ProductionReport::whereIn('status_validasi', ['valid', 'invalid'])->count() }} <span class="text-xs font-bold text-slate-400">Laporan</span></h4>
                    </div>
                </div>
            </div>

            {{-- === SECTION 2: GRID SYSTEM FOR LOGS AND ACTIONS === --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left & Center Column: Validation Queue List --}}
                <div class="bg-white overflow-hidden shadow-xs border border-slate-200/60 rounded-2xl lg:col-span-2">
                    <div class="p-6">
                        <div class="flex items-center justify-between pb-5 mb-6 border-b border-slate-100">
                            <div class="flex items-center space-x-3">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-500 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                                </span>
                                <h3 class="text-base font-black text-slate-900 tracking-tight">Antrian Validasi Pasokan Masuk</h3>
                            </div>
                            <span class="bg-amber-100 text-amber-800 border border-amber-200 text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-wider">
                                {{ $pendingReports->count() }} Perlu Validasi
                            </span>
                        </div>

                        <div class="space-y-4">
                            @forelse ($pendingReports as $report)
                                <div class="bg-slate-50/70 border border-slate-200/60 rounded-xl p-5 hover:border-emerald-300 hover:bg-emerald-50/10 transition duration-200">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                        <div class="space-y-3 flex-1">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <span class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-[11px] font-black px-3 py-1 rounded-lg shadow-sm tracking-wide">
                                                    {{ number_format($report->jumlah_panen, 1) }} Kg
                                                </span>
                                                <span class="px-2.5 py-1 text-[10px] font-black rounded-lg border shadow-xs uppercase tracking-wider
                                                    {{ $report->kondisi === 'Bagus' ? 'bg-emerald-100 text-emerald-800 border-emerald-300' :
                                                       ($report->kondisi === 'Cukup' ? 'bg-amber-100 text-amber-800 border-amber-300' : 'bg-rose-100 text-rose-800 border-rose-300') }}">
                                                    Kondisi: {{ $report->kondisi }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-base font-extrabold text-slate-900 leading-tight">{{ $report->user->name }}</p>
                                                <p class="text-xs text-slate-400 font-bold mt-0.5">
                                                    Tanggal Distribusi Panen: {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                                </p>
                                            </div>

                                            @if($report->catatan)
                                                <div class="text-xs text-slate-600 bg-white px-4 py-3 rounded-lg border border-slate-200/80 font-normal italic leading-relaxed">
                                                    "{{ $report->catatan }}"
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-2 self-end md:self-start pt-2 md:pt-0">
                                            <form action="{{ route('admin.reports.validate', $report->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="valid">
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-xs font-black uppercase tracking-wider text-white bg-emerald-600 hover:bg-emerald-500 rounded-xl transition duration-150 transform hover:-translate-y-0.5 shadow-md shadow-emerald-600/10">
                                                    <span>Terima</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.reports.validate', $report->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="invalid">
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-xs font-black uppercase tracking-wider text-white bg-rose-600 hover:bg-rose-500 rounded-xl transition duration-150 transform hover:-translate-y-0.5 shadow-md shadow-rose-600/10">
                                                    <span>Tolak</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-20 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                    <div class="w-12 h-12 bg-emerald-50 rounded-xl border border-emerald-200 text-emerald-600 flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-800">Antrian Kosong</p>
                                    <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">Seluruh laporan dari petugas kumbung telah divalidasi ke sistem utama.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right Column: History Logs (Color-Coded Badges) --}}
                <div class="bg-white overflow-hidden shadow-xs border border-slate-200/60 rounded-2xl lg:col-span-1">
                    <div class="p-6">
                        <div class="pb-4 mb-5 border-b border-slate-100 flex items-center space-x-2">
                            <div class="w-7 h-7 bg-indigo-50 border border-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">Log Riwayat Audit</h3>
                        </div>

                        <div class="space-y-3 overflow-y-auto max-h-[520px] pr-1">
                            @forelse ($processedReports as $report)
                                <div class="p-4 border border-slate-100 rounded-xl bg-slate-50/70 hover:bg-white hover:border-slate-200 hover:shadow-xs transition duration-200 space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] text-slate-400 font-bold">
                                            {{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}
                                        </span>
                                        <span class="px-2.5 py-0.5 text-[9px] font-black rounded-md border uppercase tracking-widest shadow-2xs
                                            {{ $report->status_validasi === 'valid' ? 'bg-emerald-600 text-white border-transparent' : 'bg-rose-600 text-white border-transparent' }}">
                                            {{ $report->status_validasi }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-extrabold text-slate-900 leading-tight">{{ $report->user->name }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5 font-semibold">{{ number_format($report->jumlah_panen, 1) }} Kg — {{ $report->kondisi }}</p>
                                    </div>
                                    <div class="pt-2 border-t border-slate-200/60 flex items-center space-x-1 text-[10px] text-slate-400 font-bold">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <span class="truncate text-slate-500">Validator: {{ $report->validator->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-16 text-slate-400">
                                    <svg class="mx-auto h-7 w-7 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p class="text-xs font-semibold text-slate-500">Belum ada riwayat terekam.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-black text-2xl text-[#26201B] tracking-tight leading-tight font-heading">
                    {{ __('Dashboard Administrator') }}
                </h2>
                <p class="text-xs text-[#6B4E36] mt-0.5 font-medium">Kelola verifikasi pasokan masuk dan otentikasi data KUPS Harapan Asri</p>
            </div>
            <div class="flex items-center self-start sm:self-center">
                <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-[#37452F] to-[#4F6146] text-white text-[10px] font-black px-3.5 py-1.5 rounded-xl shadow-md shadow-[#4F6146]/20 uppercase tracking-wider">
                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                    Sistem Validasi Utama
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen px-4 sm:px-6 lg:px-8 font-sans text-[#26201B]">
        <div class="max-w-7xl mx-auto">

            {{-- Action Notification System --}}
            @if (session('success'))
                <div class="mb-8 bg-gradient-to-r from-[#37452F] to-[#26201B] text-white p-4 rounded-xl shadow-xl shadow-[#26201B]/10 border border-[#7C9169]/30 flex items-center justify-between transition animate-fadeIn" role="alert">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-[#4F6146] rounded-lg flex items-center justify-center text-white shadow-md">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="font-black text-sm font-heading">Konfirmasi Berhasil</p>
                            <p class="text-xs text-[#E6DAC2] font-light mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- === SECTION 1: METRIC DASHBOARD CARDS === --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <!-- Card Antrian Tertunda -->
                <div class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/60 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-[#6B4E36]/5 hover:border-[#8E6E4E] transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#A0653D] text-white flex items-center justify-center shadow-lg shadow-[#A0653D]/20 text-lg">
                        <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-[#A0653D] font-black uppercase tracking-widest">Antrian Tertunda</p>
                        <h4 class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ $pendingReports->count() }} <span class="text-xs font-bold text-[#8E6E4E]/70 font-sans">Berkas</span></h4>
                    </div>
                </div>

                <!-- Card Total Berat Tunggu -->
                <div class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/60 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-[#4F6146]/5 hover:border-[#4F6146] transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#4F6146] text-white flex items-center justify-center shadow-lg shadow-[#4F6146]/20 text-lg">
                        <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-[#4F6146] font-black uppercase tracking-widest">Total Berat Tunggu</p>
                        <h4 class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ number_format($pendingReports->sum('jumlah_panen'), 1) }} <span class="text-xs font-bold text-[#8E6E4E]/70 font-sans">Kg</span></h4>
                    </div>
                </div>

                <!-- Card Selesai Diverifikasi -->
                <div class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/60 p-6 flex items-center space-x-4 hover:shadow-xl hover:shadow-[#6B4E36]/5 hover:border-[#6B4E36] transition duration-300">
                    <div class="w-12 h-12 rounded-xl bg-[#6B4E36] text-white flex items-center justify-center shadow-lg shadow-[#6B4E36]/20 text-lg">
                        ✓
                    </div>
                    <div>
                        <p class="text-[10px] text-[#6B4E36] font-black uppercase tracking-widest">Selesai Diverifikasi</p>
                        <h4 class="text-2xl font-black text-[#26201B] mt-0.5 font-mono-data">{{ \App\Models\ProductionReport::whereIn('status_validasi', ['valid', 'invalid'])->count() }} <span class="text-xs font-bold text-[#8E6E4E]/70 font-sans">Laporan</span></h4>
                    </div>
                </div>
            </div>

            {{-- === SECTION 2: GRID SYSTEM FOR LOGS AND ACTIONS === --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left & Center Column: Validation Queue List --}}
                <div class="bg-[#FBF8F1] overflow-hidden shadow-xs border border-[#C9B896]/40 rounded-2xl lg:col-span-2">
                    <div class="p-6">
                        <div class="flex items-center justify-between pb-5 mb-6 border-b border-[#C9B896]/30">
                            <div class="flex items-center space-x-3">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#A0653D] opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-[#A0653D]"></span>
                                </span>
                                <h3 class="text-base font-black text-[#26201B] tracking-tight font-heading">Antrian Validasi Pasokan Masuk</h3>
                            </div>
                            <span class="bg-[#E6DAC2] text-[#6B4E36] border border-[#C9B896]/50 text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-wider font-mono-data">
                                {{ $pendingReports->count() }} Perlu Validasi
                            </span>
                        </div>

                        <div class="space-y-4">
                            @forelse ($pendingReports as $report)
                                <div class="bg-[#F6F1E6]/50 border border-[#C9B896]/40 rounded-xl p-5 hover:border-[#4F6146]/60 hover:bg-[#FBF8F1] transition duration-200">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                        <div class="space-y-3 flex-1">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <span class="bg-gradient-to-r from-[#37452F] to-[#4F6146] text-white text-[11px] font-black px-3 py-1 rounded-lg shadow-xs tracking-wide font-mono-data">
                                                    {{ number_format($report->jumlah_panen, 1) }} Kg
                                                </span>
                                                <span class="px-2.5 py-1 text-[10px] font-black rounded-lg border shadow-2xs uppercase tracking-wider
                                                    {{ $report->kualitas_panen === 'Kualitas Bagus' ? 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30' :
                                                       ($report->kualitas_panen === 'Kualitas Cukup' ? 'bg-[#C9B896]/20 text-[#6B4E36] border-[#C9B896]/40' : 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20') }}">
                                                    Kondisi: {{ $report->kualitas_panen }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-base font-black text-[#26201B] leading-tight font-heading">{{ $report->user->name }}</p>
                                                <p class="text-xs text-[#8E6E4E] font-bold mt-0.5">
                                                    Tanggal Distribusi Panen: {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                                </p>
                                            </div>

                                            @if($report->catatan)
                                                <div class="text-xs text-[#362C24] bg-[#FBF8F1] px-4 py-3 rounded-lg border border-[#C9B896]/30 font-normal italic leading-relaxed">
                                                    "{{ $report->catatan }}"
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-2 self-end md:self-start pt-2 md:pt-0">
                                            <form action="{{ route('admin.reports.validate', $report->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="valid">
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-[10px] font-black uppercase tracking-widest text-white bg-[#4F6146] hover:bg-[#37452F] rounded-xl transition duration-150 transform hover:-translate-y-0.5 shadow-md shadow-[#4F6146]/10">
                                                    <span>Terima</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.reports.validate', $report->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="invalid">
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-[10px] font-black uppercase tracking-widest text-white bg-[#A0653D] hover:bg-black rounded-xl transition duration-150 transform hover:-translate-y-0.5 shadow-md shadow-[#A0653D]/10">
                                                    <span>Tolak</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-20 bg-[#F6F1E6]/30 rounded-xl border border-dashed border-[#C9B896]/60">
                                    <div class="w-12 h-12 bg-[#7C9169]/10 rounded-xl border border-[#7C9169]/20 text-[#4F6146] flex items-center justify-center mx-auto mb-3 text-xl">
                                        <svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg>
                                    </div>
                                    <p class="text-sm font-black text-[#26201B] font-heading">Antrian Kosong</p>
                                    <p class="text-xs text-[#8E6E4E] mt-1 max-w-xs mx-auto font-medium">Seluruh laporan dari petugas kumbung telah divalidasi ke sistem utama.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right Column: History Logs --}}
                <div class="bg-[#FBF8F1] overflow-hidden shadow-xs border border-[#C9B896]/40 rounded-2xl lg:col-span-1">
                    <div class="p-6">
                        <div class="pb-4 mb-5 border-b border-[#C9B896]/30 flex items-center space-x-2">
                            <div class="w-7 h-7 bg-[#E6DAC2]/50 border border-[#C9B896]/30 rounded-lg flex items-center justify-center text-[#6B4E36] font-bold text-xs">
                                <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'/></svg>
                            </div>
                            <h3 class="text-xs font-black text-[#26201B] uppercase tracking-widest font-heading">Log Riwayat Audit</h3>
                        </div>

                        <div class="space-y-3 overflow-y-auto max-h-[520px] pr-1">
                            @forelse ($processedReports as $report)
                                <div class="p-4 border border-[#C9B896]/20 rounded-xl bg-[#F6F1E6]/40 hover:bg-white hover:border-[#C9B896]/50 hover:shadow-sm transition duration-200 space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] text-[#8E6E4E] font-bold font-mono-data">
                                            {{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}
                                        </span>
                                        <span class="px-2.5 py-0.5 text-[9px] font-black rounded-md uppercase tracking-widest shadow-2xs text-white
                                            {{ $report->status_validasi === 'valid' ? 'bg-[#4F6146]' : 'bg-[#A0653D]' }}">
                                            {{ $report->status_validasi }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-[#26201B] leading-tight font-heading">{{ $report->user->name }}</p>
                                        <p class="text-xs text-[#6B4E36] mt-0.5 font-bold font-mono-data">{{ number_format($report->jumlah_panen, 1) }} Kg <span class="text-[10px] font-sans text-[#8E6E4E]">({{ $report->kualitas_panen }})</span></p>
                                    </div>
                                    <div class="pt-2 border-t border-[#C9B896]/20 flex items-center space-x-1 text-[10px] text-[#8E6E4E] font-bold">
                                        <span class="truncate">Validator: {{ $report->validator->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-16 text-[#8E6E4E]">
                                    <p class="text-2xl block mb-1"><svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg></p>
                                    <p class="text-xs font-bold text-[#6B4E36] font-heading">Belum ada riwayat terekam.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


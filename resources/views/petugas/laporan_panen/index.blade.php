<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Kelola Laporan Hasil Panen') }}
            </h2>
            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">
                Pencatatan Produksi
            </span>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Alert Notifikasi --}}
            @if (session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r shadow-sm flex items-center justify-between animate-fadeIn" role="alert">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-extrabold text-sm">Sukses!</p>
                            <p class="text-xs">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 rounded-r shadow-sm flex items-center justify-between animate-fadeIn" role="alert">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-extrabold text-sm">Gagal!</p>
                            <p class="text-xs">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

          

            {{-- === TABEL RIWAYAT LAPORAN === --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/65">
                <div class="p-6">
                    {{-- Header Tabel --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 mb-6 border-b border-slate-100">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-800 font-heading">Semua Riwayat Laporan Panen</h3>
                                <p class="text-xs text-slate-400">Daftar lengkap laporan produksi jamur yang Anda kirimkan.</p>
                            </div>
                        </div>
                        <a href="{{ route('petugas.laporan-panen.create') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black uppercase tracking-wider rounded-xl transition duration-150 shadow-sm transform hover:-translate-y-0.5 self-start sm:self-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Input Hasil Panen
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-100">
                        <table class="min-w-full divide-y divide-slate-150">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Berat (Kg)</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kondisi</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Validasi</th>
                                    <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Catatan</th>
                                    <th class="px-6 py-3.5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @forelse ($reports as $report)
                                    <tr class="hover:bg-slate-50/70 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-800">
                                            {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-slate-900">
                                            {{ number_format($report->jumlah_panen, 1) }} Kg
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full border
                                                {{ $report->kondisi === 'Bagus' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                                   ($report->kondisi === 'Cukup' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200') }}">
                                                {{ $report->kondisi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($report->status_validasi === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                    ⏳ Menunggu Validasi
                                                </span>
                                            @elseif ($report->status_validasi === 'valid')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    ✓ Valid
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                    ✕ Invalid
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                            {{ $report->catatan ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-xs font-bold">
                                            @if ($report->status_validasi === 'pending')
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('petugas.laporan-panen.edit', $report->id) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 hover:text-amber-800 rounded-lg border border-amber-200/60 transition duration-150">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('petugas.laporan-panen.destroy', $report->id) }}" method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');"
                                                          class="inline-block m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 hover:text-rose-800 rounded-lg border border-rose-200/60 transition duration-150">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-slate-400 text-xs italic font-medium">Terkunci</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="w-12 h-12 bg-slate-50 border border-slate-200 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            </div>
                                            <p class="text-sm font-extrabold text-slate-700">Belum ada laporan produksi.</p>
                                            <p class="text-xs text-slate-400 mt-1">Klik tombol diatas untuk mulai membuat laporan panen harian baru.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <a href="{{ route('ketua.dashboard') }}"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                    title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                    {{ __('Verifikasi Laporan Panen') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B] font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
            <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-xs font-semibold shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#059669] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <div class="bg-white border border-[#E5E7EB]/60 rounded-2xl p-6 shadow-xs overflow-hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 mb-6 border-b border-[#E5E7EB]/40">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-[#D1FAE5] rounded-xl flex items-center justify-center text-[#059669]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#064E3B] uppercase tracking-wider">Antrean Laporan Petugas</h3>
                            {{-- <p class="text-xs text-[#6B7280] font-medium mt-0.5">Tinjau dan validasi hasil pencatatan panen harian sebelum direkapitulasi.</p> --}}
                        </div>
                    </div>

                    <form method="GET" class="relative w-full sm:w-64 shrink-0">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama petugas..."
                        class="w-full pl-9 pr-4 py-2 border border-[#E5E7EB]/80 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#059669]/20 focus:border-[#059669] text-xs font-semibold text-[#064E3B] transition shadow-2xs" />
                        <svg class="w-4 h-4 text-[#9CA3AF] absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </form>
                </div>

                <div class="overflow-x-auto rounded-xl border border-[#E5E7EB]/50">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-[#F9FAFB] border-b border-[#E5E7EB] text-[#4B5563] uppercase tracking-wider text-[11px] font-semibold">
                                <th class="py-2.5 px-4">Tanggal & Petugas</th>
                                <th class="py-2.5 px-4">Berat Hasil Panen</th>
                                <th class="py-2.5 px-4">Distribusi Kualitas</th>
                                <th class="py-2.5 px-4 text-center">Aksi Validasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E7EB]/50 text-[#374151]">
                            @forelse ($reports as $report)
                            <tr class="hover:bg-[#F9FAFB] transition duration-150 {{ $report->status_validasi !=='pending' ?'opacity-70 bg-gray-50/50' :'' }}">
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-[#1F2937]">
                                        {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                    </div>
                                    <div class="text-[11px] font-medium text-[#6B7280] mt-0.5 flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        {{ $report->user->name ?? 'Petugas' }}
                                    </div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <span class="text-xs font-bold text-[#059669] bg-[#D1FAE5] px-2 py-0.5 rounded border border-[#10B981]/20">
                                        {{ number_format($report->jumlah_panen, 1) }} Kg
                                    </span>
                                    <div class="text-[10px] text-[#6B7280] font-medium mt-1">
                                        Grade A: {{ number_format($report->berat_grade_a, 1) }} Kg | Grade B: {{ number_format($report->berat_grade_b, 1) }} Kg
                                    </div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="flex flex-col gap-1.5">
                                        <span class="inline-flex w-max items-center px-2 py-0.5 text-[10px] font-semibold rounded-full bg-[#F3F5F4] text-[#064E3B] border border-[#E5E7EB]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mr-1.5"></span>
                                            [Grade A] Pasar Segar
                                        </span>
                                        @if($report->berat_grade_b > 0)
                                        <span class="inline-flex w-max items-center px-2 py-0.5 text-[10px] font-semibold rounded-full bg-[#F3F5F4] text-[#B45309] border border-[#E5E7EB]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B] mr-1.5"></span>
                                            [Grade B] Olahan Rendang
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-center whitespace-nowrap">
                                    @if($report->status_validasi ==='pending')
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('ketua.verifikasi.process', $report->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status_validasi" value="valid">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-700 border border-green-200 text-xs font-semibold rounded-lg transition cursor-pointer">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('ketua.verifikasi.process', $report->id) }}" method="POST" class="inline" onsubmit="return promptAlasanPenolakan(event, this)">
                                            @csrf
                                            <input type="hidden" name="status_validasi" value="invalid">
                                            <input type="hidden" name="catatan" class="input-catatan">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 text-xs font-semibold rounded-lg transition cursor-pointer">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                        @if($report->status_validasi === 'valid')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-[#D1FAE5] text-[#065F46]">
                                                ● Disetujui
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-red-100 text-red-700">
                                                ● Ditolak
                                            </span>
                                        @endif
                                    @endif

                                    @if($report->catatan)
                                        <div class="text-[10px] text-red-600 bg-red-50 p-1.5 rounded border border-red-200 mt-1 max-w-xs text-left italic">
                                            "{{ $report->catatan }}"
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="w-10 h-10 bg-[#F3F4F6] text-[#9CA3AF] rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="text-xs font-bold text-[#374151]">Tidak ada antrean laporan.</p>
                                    <p class="text-[11px] text-[#6B7280] mt-0.5">Semua laporan telah divalidasi.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 px-2">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
    function promptAlasanPenolakan(e, form) {
        const alasan = prompt("Harap masukkan alasan penolakan laporan panen ini:");
        if (alasan === null) {
            e.preventDefault();
            return false;
        }
        if (alasan.trim() === "") {
            alert("Alasan penolakan tidak boleh kosong!");
            e.preventDefault();
            return false;
        }
        form.querySelector('.input-catatan').value = alasan.trim();
        return true;
    }
    </script>
</x-app-layout>

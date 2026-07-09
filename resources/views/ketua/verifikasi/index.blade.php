<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Verifikasi Laporan Panen') }}
            </h2>
            <span class="bg-[#E6DAC2] text-[#6B4E36] text-xs font-black px-3 py-1 rounded-full border border-[#C9B896]/60 font-mono-data tracking-wide">
                Wewenang Ketua KUPS
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-[#7C9169]/10 border-l-4 border-[#4F6146] text-[#37452F] p-4 rounded-r shadow-2xs flex items-center space-x-3 font-sans" role="alert">
                    <svg class="w-5 h-5 text-[#4F6146] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <div>
                        <p class="font-black text-sm font-heading">Berhasil!</p>
                        <p class="text-xs font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-[#FBF8F1] overflow-hidden shadow-xs rounded-2xl border border-[#C9B896]/40 p-6">
                <div class="flex items-center space-x-2.5 pb-4 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-8 h-8 bg-[#DDA15E]/10 rounded-lg flex items-center justify-center text-[#DDA15E]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Antrean Laporan Petugas</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium mt-0.5">Tinjau dan validasi hasil pencatatan panen sebelum dimasukkan ke rekapitulasi utama.</p>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-xl border border-[#C9B896]/30">
                    <table class="min-w-full divide-y divide-[#C9B896]/20">
                        <thead class="bg-[#F6F1E6]/50">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Tanggal & Petugas</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Berat (Kg)</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Kondisi & Distribusi</th>
                                <th class="px-6 py-3.5 text-center text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Aksi Validasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#C9B896]/15 text-[#362C24]">
                            @forelse ($reports as $report)
                                <tr class="hover:bg-[#F6F1E6]/30 transition duration-150 {{ $report->status_validasi !== 'pending' ? 'opacity-70 bg-gray-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-black text-[#26201B] font-mono-data">
                                            {{ \Carbon\Carbon::parse($report->tanggal)->isoFormat('D MMMM Y') }}
                                        </div>
                                        <div class="text-xs font-medium text-[#8E6E4E] mt-1 flex items-center">
                                            <span class="mr-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </span> {{ $report->user->name ?? 'Petugas' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-black text-[#4F6146] font-mono-data bg-[#4F6146]/10 px-2.5 py-1 rounded-md border border-[#4F6146]/20">
                                            {{ number_format($report->jumlah_panen, 1) }} Kg
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col space-y-1">
                                            <span class="inline-flex w-max items-center px-2.5 py-1 text-[10px] font-black rounded-full border uppercase tracking-wider font-mono-data
                                                {{ $report->kualitas_panen === 'Kualitas Bagus' ? 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30' :
                                                   ($report->kualitas_panen === 'Kualitas Cukup' ? 'bg-[#C9B896]/20 text-[#6B4E36] border-[#C9B896]/40' : 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20') }}">
                                                {{ $report->kualitas_panen }}
                                            </span>
                                            <span class="text-xs text-[#8E6E4E] font-medium ml-1">
                                                ➔ {{ $report->status_distribusi }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($report->status_validasi === 'pending')
                                            <div class="flex items-center justify-center space-x-2">
                                                <form action="{{ route('ketua.verifikasi.process', $report->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status_validasi" value="valid">
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-bold rounded-lg shadow-md transition duration-150 cursor-pointer">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Terima
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('ketua.verifikasi.process', $report->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status_validasi" value="invalid">
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-[#A0653D]/10 hover:bg-[#A0653D] hover:text-white text-[#A0653D] border border-[#A0653D]/30 text-xs font-bold rounded-lg transition duration-150 cursor-pointer">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold 
                                                {{ $report->status_validasi === 'valid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ ucfirst($report->status_validasi) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <p class="text-sm font-black text-[#26201B] font-heading">Tidak ada laporan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

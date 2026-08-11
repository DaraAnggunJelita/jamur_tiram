<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                    title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                        {{ __('Pengaturan Batas EWS') }}
                    </h2>
                    {{-- <p class="text-xs text-[#047857] mt-0.5 font-medium">Konfigurasi ambang batas aman indikator Early Warning System KUPS Harapan Asri</p> --}}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen px-4 sm:px-6 lg:px-8 font-sans text-[#064E3B]">
        <div class="max-w-4xl mx-auto">

            @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-[#047857] to-[#064E3B] text-white p-4 rounded-xl shadow-md border border-[#34D399]/30 flex items-center justify-between transition" role="alert">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-[#059669] rounded-lg flex items-center justify-center text-white shadow-xs">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-sm">Pembaruan Berhasil</p>
                        <p class="text-xs text-[#E6DAC2] font-light mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xs border border-[#E5E7EB]/60 rounded-2xl p-6 sm:p-8">
                <div class="border-b border-[#E5E7EB]/40 pb-5 mb-6">
                    <h3 class="font-bold text-lg text-[#064E3B]">Parameter Ambang Batas Peringatan</h3>
                    {{-- <p class="text-xs text-[#6B7280] mt-1 font-medium">Batas aman ini digunakan oleh sistem untuk memicu notifikasi peringatan berisiko atau kondisi kritis kepada petugas.</p> --}}
                </div>

                <form method="POST" action="{{ route('admin.ews.settings.update') }}" class="space-y-6">
                    @csrf
                    <div class="mb-6">
                        <label for="maks_hari_panen" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Maksimal Hari Panen Pasca-Pinhead (Hari)</label>
                        <div class="relative">
                            <input type="number" name="maks_hari_panen" id="maks_hari_panen" value="{{ $settings->maks_hari_panen }}" required class="block w-full rounded-xl border-[#E5E7EB] bg-[#F9FAFB] py-2.5 px-3.5 text-sm font-semibold text-[#064E3B] shadow-xs focus:bg-white focus:border-[#059669] focus:ring-[#059669]">
                        </div>
                    </div>

                    <div>
                        <label for="kondisi_udara_kritis" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Deskripsi Kriteria Kondisi Udara Kritis</label>
                        <input type="text" name="kondisi_udara_kritis" id="kondisi_udara_kritis" value="{{ $settings->kondisi_udara_kritis }}" required class="block w-full rounded-xl border-[#E5E7EB] bg-[#F9FAFB] py-2.5 px-3.5 text-sm font-semibold text-[#064E3B] shadow-xs focus:bg-white focus:border-[#059669] focus:ring-[#059669]">
                        {{-- <p class="text-[11px] text-[#6B7280] mt-1.5 font-medium">Catatan batas suhu dan kelembapan kumbung yang dikategorikan keadaan darurat.</p> --}}
                    </div>

                    <div class="pt-6 border-t border-[#E5E7EB]/40 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-xs font-extrabold rounded-xl shadow-md transition duration-150 transform hover:-translate-y-0.5">
                            Simpan Perubahan EWS
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

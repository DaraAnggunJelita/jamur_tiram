<x-app-layout>
 <x-slot name="header">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Pengaturan Batas EWS') }}
 </h2>
 </x-slot>

 <div class="py-12 bg-[#F3F5F4] min-h-screen">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
 <div class="p-6 text-gray-900">
 <h3 class="font-bold text-lg mb-4">Pengaturan Early Warning System</h3>
 <p class="text-sm text-gray-600 mb-4">Konfigurasi batas aman yang akan men-trigger status berisiko atau kritis.</p>
 
 @if(session('success'))
 <div class="mb-4 p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-sm font-bold shadow-2xs">
 {{ session('success') }}
 </div>
 @endif
 
 <form method="POST" action="{{ route('admin.ews.settings.update') }}" class="space-y-6 max-w-md">
 @csrf
 <div>
 <label for="min_durasi_sterilisasi" class="block text-xs font-bold text-[#047857] mb-1">Minimum Durasi Sterilisasi (Jam)</label>
 <input type="number" name="min_durasi_sterilisasi" id="min_durasi_sterilisasi" value="{{ $settings->min_durasi_sterilisasi }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 </div>
 <div>
 <label for="maks_hari_panen" class="block text-xs font-bold text-[#047857] mb-1">Maksimal Hari Panen Sejak Pinhead Muncul (Hari)</label>
 <input type="number" name="maks_hari_panen" id="maks_hari_panen" value="{{ $settings->maks_hari_panen }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 </div>
 <div>
 <label for="kondisi_udara_kritis" class="block text-xs font-bold text-[#047857] mb-1">Kondisi Udara Kritis</label>
 <input type="text" name="kondisi_udara_kritis" id="kondisi_udara_kritis" value="{{ $settings->kondisi_udara_kritis }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
 </div>
 
 <div class="pt-4 border-t border-[#E5E7EB]/20">
 <button type="submit" class="w-full py-2.5 px-6 bg-[#3A5A40] hover:bg-[#253B29] text-white text-sm font-extrabold rounded-xl shadow-md transition shadow-[#3A5A40]/30">
 Simpan Perubahan
 </button>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
</x-app-layout>

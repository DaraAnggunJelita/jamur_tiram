<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Kelola Katalog Produk KUPS') }}
 </h2>
 <span class="bg-[#E6DAC2] text-[#047857] text-xs font-bold px-3 py-1 rounded-full border border-[#E5E7EB]/60">
 Mode Admin
 </span>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

 {{-- Notifikasi Sukses --}}
 @if (session('success'))
 <div class="bg-[#34D399]/10 border-l-4 border-[#059669] text-[#047857] p-4 rounded-r shadow-2xs flex items-center justify-between font-sans" role="alert">
 <div class="flex items-center space-x-3">
 <svg class="w-5 h-5 text-[#059669] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
 <div>
 <p class="font-bold text-sm">Berhasil!</p>
 <p class="text-xs font-medium">{{ session('success') }}</p>
 </div>
 </div>
 </div>
 @endif

 <div class="flex items-center justify-between font-sans">
 <div>
 <h3 class="text-base font-bold text-[#064E3B]">Daftar Produk Jamur</h3>
 <p class="text-xs text-[#6B7280] font-medium mt-0.5">Total produk yang terdaftar: {{ $catalogs->total() }} produk</p>
 </div>
 <a href="{{ route('admin.catalogs.create') }}"
 class="inline-flex items-center space-x-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-md shadow-[#059669]/10 hover:-translate-y-0.5 transform cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
 <span>Tambah Produk Baru</span>
 </a>
 </div>

 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 overflow-hidden">
 <table class="w-full divide-y divide-[#E5E7EB]/30 text-sm">
 <thead class="bg-[#F3F5F4]/50">
 <tr>
 <th class="px-4 py-3.5 text-left text-xs font-bold text-[#047857] w-[20%]">Nama Produk</th>
 <th class="px-4 py-3.5 text-left text-xs font-bold text-[#047857] w-[35%]">Deskripsi</th>
 <th class="px-4 py-3.5 text-left text-xs font-bold text-[#047857] w-[15%]">Harga</th>
 <th class="px-4 py-3.5 text-center text-xs font-bold text-[#047857] w-[10%]">Gambar</th>
 <th class="px-4 py-3.5 text-right text-xs font-bold text-[#047857] w-[20%]">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/15 bg-white text-[#374151]">
 @forelse($catalogs as $catalog)
 <tr class="hover:bg-[#F3F5F4]/30 transition duration-150">
 <td class="px-4 py-3 whitespace-nowrap">
 <span class="text-sm font-bold text-[#064E3B]">{{ substr($catalog->name, 0, 20) }}{{ strlen($catalog->name) > 20 ?'...' :'' }}</span>
 </td>
 <td class="px-4 py-3">
 <div class="line-clamp-2 text-xs text-[#047857] font-medium" title="{{ $catalog->description }}">
 {{ substr($catalog->description, 0, 80) }}{{ strlen($catalog->description) > 80 ?'...' :'' }}
 </div>
 </td>
 <td class="px-4 py-3 whitespace-nowrap">
 <span class="text-sm font-bold text-[#059669]">Rp {{ number_format($catalog->price, 0,',','.') }}</span>
 </td>
 <td class="px-4 py-3 text-center">
 @if($catalog->image)
 <img src="{{ asset('storage/'.$catalog->image) }}" class="w-10 h-10 object-cover rounded-lg border border-[#E5E7EB]/40 mx-auto shadow-2xs" alt="{{ $catalog->name }}">
 @else
 <div class="w-10 h-10 rounded-lg bg-[#F3F5F4] border border-[#E5E7EB]/40 flex items-center justify-center mx-auto text-[#6B7280] text-[9px] font-bold tracking-tighter">
 Kosong
 </div>
 @endif
 </td>
 <td class="px-4 py-3 whitespace-nowrap text-right">
 <div class="flex items-center justify-end gap-1.5 font-sans">
 <a href="{{ route('admin.catalogs.edit', $catalog->id) }}"
 class="inline-flex items-center bg-[#E6DAC2]/40 text-[#047857] hover:bg-[#E6DAC2]/80 text-xs font-bold px-2.5 py-1.5 rounded-lg border border-[#E5E7EB]/60 transition cursor-pointer">
 <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H8v-3.828l9.282-9.282z"/></svg>
 Edit
 </a>
 <form action="{{ route('admin.catalogs.destroy', $catalog->id) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $catalog->name }}?')" class="inline">
 @csrf
 @method('DELETE')
 <button type="submit"
 class="inline-flex items-center bg-[#F59E0B]/10 text-[#F59E0B] hover:bg-[#F59E0B] hover:text-white text-xs font-bold px-2.5 py-1.5 rounded-lg border border-[#F59E0B]/30 transition cursor-pointer">
 <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
 Hapus
 </button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-4 py-12 text-center font-sans">
 <div class="w-12 h-12 bg-[#F3F5F4] border border-[#E5E7EB]/40 text-[#6B7280] rounded-xl flex items-center justify-center mx-auto mb-3 text-xl shadow-2xs">
 <svg class='w-6 h-6' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'/></svg>
 </div>
 <p class="text-sm font-bold text-[#064E3B]">Belum Ada Katalog Produk</p>
 <p class="text-xs text-[#6B7280] mt-1 font-medium">Silakan klik"Tambah Produk Baru" untuk melengkapi katalog utama.</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 <div class="px-6 py-4 border-t border-[#E5E7EB]/20 bg-[#FFFFFF]">
 {{ $catalogs->links() }}
 </div>
 </div>

 </div>
 </div>
</x-app-layout>


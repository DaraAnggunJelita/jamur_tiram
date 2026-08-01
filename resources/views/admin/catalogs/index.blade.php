<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 font-sans">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" 
                    class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
                    title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                        {{ __('Kelola Katalog Produk KUPS') }}
                    </h2>
                    <p class="text-xs text-[#047857] mt-0.5 font-medium">Manajemen daftar produk jamur tiram yang ditampilkan pada halaman publik</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen font-sans text-[#064E3B]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
            <div class="p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-xs font-semibold shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#059669] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <div class="bg-white border border-[#E5E7EB]/60 rounded-2xl p-6 shadow-xs overflow-hidden">
                
                {{-- Header Card --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 pb-4 border-b border-[#E5E7EB]/40">
                    <div>
                        <h3 class="text-xs font-bold text-[#064E3B] uppercase tracking-wider">Daftar Produk Jamur</h3>
                        <p class="text-xs text-[#6B7280] font-medium mt-0.5">Total produk terdaftar: {{ $catalogs->total() }} produk</p>
                    </div>
                    <a href="{{ route('admin.catalogs.create') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 cursor-pointer self-start sm:self-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Tambah Produk Baru</span>
                    </a>
                </div>

                {{-- Tabel Data Katalog --}}
                <div class="overflow-x-auto border border-[#E5E7EB]/60 rounded-xl">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-[#F9FAFB] border-b border-[#E5E7EB] text-[#4B5563] uppercase tracking-wider text-[11px] font-semibold">
                                <th class="py-3 px-4 w-[25%]">Nama Produk</th>
                                <th class="py-3 px-4 w-[35%]">Deskripsi</th>
                                <th class="py-3 px-4 w-[15%]">Harga</th>
                                <th class="py-3 px-4 text-center w-[10%]">Gambar</th>
                                <th class="py-3 px-4 text-right w-[15%]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E7EB]/50 text-[#374151]">
                            @forelse($catalogs as $catalog)
                            <tr class="hover:bg-[#F9FAFB] transition duration-150">
                                <td class="py-3.5 px-4 font-bold text-[#1F2937]">
                                    {{ $catalog->name }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <p class="line-clamp-2 text-xs text-[#6B7280] font-medium" title="{{ $catalog->description }}">
                                        {{ $catalog->description }}
                                    </p>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-[#059669] whitespace-nowrap">
                                    Rp {{ number_format($catalog->price, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    @if($catalog->image)
                                    <img src="{{ asset('storage/'.$catalog->image) }}" class="w-9 h-9 object-cover rounded-lg border border-[#E5E7EB] mx-auto shadow-2xs" alt="{{ $catalog->name }}">
                                    @else
                                    <div class="w-9 h-9 rounded-lg bg-[#F3F4F6] border border-[#E5E7EB] flex items-center justify-center mx-auto text-[#9CA3AF] text-[10px] font-medium">
                                        N/A
                                    </div>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.catalogs.edit', $catalog->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-xs font-semibold rounded-lg border border-[#D1D5DB] transition cursor-pointer">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.catalogs.destroy', $catalog->id) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $catalog->name }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-lg border border-red-200 transition cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-[#6B7280]">
                                    <div class="w-10 h-10 bg-[#F3F4F6] text-[#9CA3AF] rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <p class="text-xs font-bold text-[#374151]">Belum Ada Katalog Produk</p>
                                    <p class="text-xs text-[#6B7280] mt-0.5 font-medium">Klik "Tambah Produk Baru" untuk menambahkan produk baru.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($catalogs->hasPages())
                <div class="mt-4 pt-4 border-t border-[#E5E7EB]/40">
                    {{ $catalogs->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

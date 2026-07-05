<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Kelola Katalog Produk KUPS') }}
            </h2>
            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">
                Mode Admin
            </span>
        </div>
    </x-slot>


    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r shadow-sm flex items-center justify-between" role="alert">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <div>
                            <p class="font-extrabold text-sm">Berhasil!</p>
                            <p class="text-xs">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-extrabold text-slate-800">Daftar Produk Jamur</h3>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Total produk yang terdaftar: {{ $catalogs->total() }} produk</p>
                </div>
                <a href="{{ route('admin.catalogs.create') }}"
                    class="inline-flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-extrabold px-4 py-2.5 rounded-xl transition shadow-sm hover:-translate-y-0.5 transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Produk Baru</span>
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-2xl border border-slate-200/60 overflow-hidden">
                <table class="w-full divide-y divide-slate-150 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider w-20%">Nama Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider w-35%">Deskripsi</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider w-15%">Harga</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-slate-500 uppercase tracking-wider w-10%">Gambar</th>
                            <th class="px-4 py-3 text-right text-xs font-bold text-slate-500 uppercase tracking-wider w-20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($catalogs as $catalog)
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="text-xs font-extrabold text-slate-800">{{ substr($catalog->name, 0, 20) }}{{ strlen($catalog->name) > 20 ? '...' : '' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="line-clamp-2 text-xs text-slate-600" title="{{ $catalog->description }}">
                                        {{ substr($catalog->description, 0, 80) }}{{ strlen($catalog->description) > 80 ? '...' : '' }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="text-xs font-bold text-emerald-700">Rp {{ number_format($catalog->price, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($catalog->image)
                                        <img src="{{ asset('storage/'.$catalog->image) }}" class="w-10 h-10 object-cover rounded-lg border border-slate-200 mx-auto" alt="{{ $catalog->name }}">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center mx-auto text-slate-400 text-[8px] font-bold">
                                            No Img
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.catalogs.edit', $catalog->id) }}"
                                            class="inline-flex items-center bg-blue-50 text-blue-700 hover:bg-blue-100 text-xs font-bold px-2.5 py-1.5 rounded-lg border border-blue-200 transition">
                                            <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.catalogs.destroy', $catalog->id) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $catalog->name }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center bg-rose-50 text-rose-700 hover:bg-rose-100 text-xs font-bold px-2.5 py-1.5 rounded-lg border border-rose-200 transition">
                                                <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center">
                                    <div class="w-14 h-14 bg-slate-50 border border-slate-200 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <p class="text-sm font-extrabold text-slate-700">Belum Ada Katalog Produk</p>
                                    <p class="text-xs text-slate-400 mt-1">Silakan klik "Tambah Produk Baru" untuk melengkapi katalog.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $catalogs->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

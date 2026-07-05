<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Edit Produk Katalog') }}
            </h2>
            <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">
                Mode Admin
            </span>
        </div>
    </x-slot>


    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumbs --}}
            <nav class="flex mb-5 text-sm font-semibold text-slate-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.catalogs.index') }}" class="hover:text-slate-600 transition">Katalog Produk</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-slate-600 md:ml-2">Edit Produk</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white shadow-sm rounded-2xl border border-slate-200/60 p-8">
                <h3 class="text-lg font-extrabold text-slate-800 pb-4 mb-6 border-b border-slate-100 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Form Edit Produk</span>
                </h3>

                <form action="{{ route('admin.catalogs.update', $catalog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $catalog->name) }}"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5" required>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi Produk</label>
                        <textarea name="description" rows="4"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5" required>{{ old('description', $catalog->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Harga Jual (Rp)</label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-slate-400 text-sm font-bold">Rp</span>
                            </div>
                            <input type="number" name="price" value="{{ old('price', $catalog->price) }}" min="0"
                                class="block w-full pl-9 rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5" required>
                        </div>
                        @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Gambar Produk <span class="text-slate-400 font-normal">(Kosongkan jika tidak diganti)</span></label>
                        @if($catalog->image)
                            <div class="mb-4 flex items-center space-x-3 bg-slate-50 border border-slate-200/80 p-3 rounded-xl w-fit">
                                <img src="{{ asset('storage/'.$catalog->image) }}" alt="{{ $catalog->name }}" class="w-16 h-16 object-cover rounded-lg border border-slate-200">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Gambar Saat Ini</p>
                                    <p class="text-xs text-slate-500 truncate max-w-[150px]">{{ basename($catalog->image) }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-emerald-400 transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h16a4 4 0 004-4V12a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14 29l7-7 7 7 9-9 3 3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-extrabold text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                                        <span>Ganti foto produk</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-slate-400">PNG, JPG, JPEG, atau WEBP hingga 2MB</p>
                            </div>
                        </div>
                        @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-extrabold px-6 py-3 rounded-xl shadow-sm transition transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.catalogs.index') }}"
                            class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-extrabold px-6 py-3 rounded-xl transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            let fileName = e.target.files[0] ? e.target.files[0].name : "Ganti foto produk";
            e.target.closest('div').querySelector('span').innerText = "Terpilih: " + fileName;
        });
    </script>
</x-app-layout>

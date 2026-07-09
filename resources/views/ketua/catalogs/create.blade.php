<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <div class="flex items-center gap-3">
                <button onclick="history.back()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#C9B896]/60 bg-[#FBF8F1] hover:bg-[#E6DAC2]/60 text-[#6B4E36] transition duration-150 shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </button>
                <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                    {{ __('Tambah Produk Katalog') }}
                </h2>
            </div>
            <span class="bg-[#E6DAC2] text-[#6B4E36] text-xs font-black px-3 py-1 rounded-full border border-[#C9B896]/60 font-mono-data tracking-wide">
                Mode Admin
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumbs --}}
            <nav class="flex mb-5 text-xs font-black text-[#8E6E4E] uppercase tracking-wider font-heading" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('ketua.catalogs.index') }}" class="hover:text-[#26201B] transition">Katalog Produk</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-[#C9B896]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-[#26201B] md:ml-2">Tambah Baru</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">
                <h3 class="text-base font-black text-[#26201B] pb-4 mb-6 border-b border-[#C9B896]/20 flex items-center space-x-2 font-heading tracking-tight">
                    <svg class="w-5 h-5 text-[#4F6146]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    <span>Form Detail Produk</span>
                </h3>

                <form action="{{ route('ketua.catalogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-sans">
                    @csrf

                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Jamur Tiram Putih Segar (Grade A)"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50" required>
                        @error('name')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Deskripsi Produk --}}
                    <div>
                        <label class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Deskripsi Produk</label>
                        <textarea name="description" rows="4" placeholder="Jelaskan keunggulan produk, ukuran kemasan, kebersihan, dll..."
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50" required>{{ old('description') }}</textarea>
                        @error('description')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Harga Jual --}}
                    <div>
                        <label class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Harga Jual (Rp)</label>
                        <div class="relative rounded-xl shadow-2xs">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-[#6B4E36] text-sm font-black font-mono-data">Rp</span>
                            </div>
                            <input type="number" name="price" value="{{ old('price') }}" placeholder="15000" min="0"
                                class="block w-full pl-9 rounded-xl border-[#C9B896]/60 bg-white focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-black font-mono-data placeholder-[#8E6E4E]/50" required>
                        </div>
                        @error('price')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Foto Produk --}}
                    <div>
                        <label class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Foto Produk</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-[#C9B896]/40 border-dashed rounded-xl bg-white hover:border-[#4F6146] transition duration-150">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-[#8E6E4E]/70" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h16a4 4 0 004-4V12a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14 29l7-7 7 7 9-9 3 3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm justify-center">
                                    <label for="image" class="relative cursor-pointer rounded-md font-black text-[#4F6146] hover:text-[#37452F] focus-within:outline-none transition">
                                        <span id="upload-label">Unggah foto produk</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-[#8E6E4E] font-medium">PNG, JPG, JPEG, atau WEBP hingga 2MB</p>
                            </div>
                        </div>
                        @error('image')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center gap-3 pt-4 border-t border-[#C9B896]/20 font-sans">
                        <button type="submit"
                            class="bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest px-6 py-3 rounded-xl shadow-md shadow-[#4F6146]/10 hover:-translate-y-0.5 transform transition cursor-pointer">
                            Simpan Produk
                        </button>
                        <a href="{{ route('ketua.catalogs.index') }}"
                            class="bg-[#E6DAC2]/40 text-[#6B4E36] hover:bg-[#E6DAC2]/80 text-xs font-black uppercase tracking-widest px-6 py-3 rounded-xl border border-[#C9B896]/60 transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update teks label saat berkas berhasil dipilih
        document.getElementById('image').addEventListener('change', function(e) {
            let fileName = e.target.files[0] ? e.target.files[0].name : "Unggah foto produk";
            document.getElementById('upload-label').innerText = "Terpilih: " + fileName;
        });
    </script>
</x-app-layout>

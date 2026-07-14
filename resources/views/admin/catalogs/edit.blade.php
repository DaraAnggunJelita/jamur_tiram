<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
 <div class="flex items-center gap-3">
 <button onclick="history.back()"
 class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition duration-150 shadow-xs cursor-pointer">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
 </button>
 <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
 {{ __('Edit Produk Katalog') }}
 </h2>
 </div>
 <span class="bg-[#E6DAC2] text-[#047857] text-xs font-bold px-3 py-1 rounded-full border border-[#E5E7EB]/60">
 Mode Admin
 </span>
 </div>
 </x-slot>

 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

 {{-- Breadcrumbs --}}
 <nav class="flex mb-5 text-xs font-bold text-[#6B7280]" aria-label="Breadcrumb">
 <ol class="inline-flex items-center space-x-1 md:space-x-2">
 <li class="inline-flex items-center">
 <a href="{{ route('admin.catalogs.index') }}" class="hover:text-[#064E3B] transition">Katalog Produk</a>
 </li>
 <li>
 <div class="flex items-center">
 <svg class="w-4 h-4 text-[#E5E7EB]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
 <span class="ml-1 text-[#064E3B] md:ml-2">Edit Produk</span>
 </div>
 </li>
 </ol>
 </nav>

 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
 <h3 class="text-base font-bold text-[#064E3B] pb-4 mb-6 border-b border-[#E5E7EB]/20 flex items-center space-x-2">
 <svg class="w-5 h-5 text-[#047857]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H8v-3.828l9.282-9.282z"/></svg>
 <span>Form Edit Produk</span>
 </h3>

 <form action="{{ route('admin.catalogs.update', $catalog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 font-sans">
 @csrf
 @method('PUT')

 {{-- Nama Produk --}}
 <div>
 <label class="block text-xs font-bold text-[#047857] mb-1.5">Nama Produk</label>
 <input type="text" name="name" value="{{ old('name', $catalog->name) }}"
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium" required>
 @error('name')<p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>

 {{-- Deskripsi Produk --}}
 <div>
 <label class="block text-xs font-bold text-[#047857] mb-1.5">Deskripsi Produk</label>
 <textarea name="description" rows="4"
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium" required>{{ old('description', $catalog->description) }}</textarea>
 @error('description')<p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>

 {{-- Harga Jual --}}
 <div>
 <label class="block text-xs font-bold text-[#047857] mb-1.5">Harga Jual (Rp)</label>
 <div class="relative rounded-xl shadow-2xs">
 <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
 <span class="text-[#047857] text-sm font-bold">Rp</span>
 </div>
 <input type="number" name="price" value="{{ old('price', $catalog->price) }}" min="0"
 class="block w-full pl-9 rounded-xl border-[#E5E7EB]/60 bg-white focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-bold" required>
 </div>
 @error('price')<p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>

 {{-- Gambar Produk Saat Ini --}}
 <div>
 <label class="block text-xs font-bold text-[#047857] mb-1.5">Gambar Produk <span class="text-[#6B7280]/70 font-medium lowercase">(Kosongkan jika tidak diganti)</span></label>

 @if($catalog->image)
 <div class="mb-4 flex items-center space-x-3 bg-[#F3F5F4]/50 border border-[#E5E7EB]/40 p-3 rounded-xl w-fit shadow-2xs">
 <img src="{{ asset('storage/'.$catalog->image) }}" alt="{{ $catalog->name }}" class="w-16 h-16 object-cover rounded-lg border border-[#E5E7EB]/40 bg-white">
 <div>
 <p class="text-[10px] text-[#047857] font-bold">Gambar Saat Ini</p>
 <p class="text-xs text-[#6B7280] font-medium truncate max-w-[150px]">{{ basename($catalog->image) }}</p>
 </div>
 </div>
 @endif

 {{-- Input Upload Gambar Baru --}}
 <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-[#E5E7EB]/40 border-dashed rounded-xl bg-white hover:border-[#059669] transition duration-150">
 <div class="space-y-1 text-center">
 <svg class="mx-auto h-12 w-12 text-[#6B7280]/70" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
 <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h16a4 4 0 004-4V12a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
 <path d="M14 29l7-7 7 7 9-9 3 3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
 </svg>
 <div class="flex text-sm justify-center">
 <label for="image" class="relative cursor-pointer rounded-md font-bold text-[#059669] hover:text-[#047857] focus-within:outline-none transition">
 <span id="upload-label">Ganti foto produk</span>
 <input id="image" name="image" type="file" accept="image/*" class="sr-only">
 </label>
 </div>
 <p class="text-xs text-[#6B7280] font-medium">PNG, JPG, JPEG, atau WEBP hingga 2MB</p>
 </div>
 </div>
 @error('image')<p class="text-[#F59E0B] text-xs font-bold mt-1">{{ $message }}</p>@enderror
 </div>

 {{-- Tombol Aksi --}}
 <div class="flex items-center gap-3 pt-4 border-t border-[#E5E7EB]/20 font-sans">
 <button type="submit"
 class="bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold px-6 py-3 rounded-xl shadow-md shadow-[#059669]/10 hover:-translate-y-0.5 transform transition cursor-pointer">
 Simpan Perubahan
 </button>
 <a href="{{ route('admin.catalogs.index') }}"
 class="bg-[#E6DAC2]/40 text-[#047857] hover:bg-[#E6DAC2]/80 text-xs font-bold px-6 py-3 rounded-xl border border-[#E5E7EB]/60 transition text-center">
 Batal
 </a>
 </div>
 </form>
 </div>
 </div>
 </div>

 <script>
 // Update teks label saat berkas baru berhasil dipilih
 document.getElementById('image').addEventListener('change', function(e) {
 let fileName = e.target.files[0] ? e.target.files[0].name :"Ganti foto produk";
 document.getElementById('upload-label').innerText ="Terpilih:" + fileName;
 });
 </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Edit Akun Pengguna KUPS') }}
            </h2>
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#E6DAC2]/40 text-[#6B4E36] hover:bg-[#E6DAC2]/80 text-xs font-black uppercase tracking-widest rounded-xl border border-[#C9B896]/60 transition duration-150 text-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-8">
                <div class="flex items-center space-x-3 pb-5 mb-6 border-b border-[#C9B896]/20">
                    <div class="w-10 h-10 bg-[#E6DAC2]/60 text-[#6B4E36] rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H8v-3.828l9.282-9.282z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Perbarui Akun</h3>
                        <p class="text-xs text-[#8E6E4E] font-medium mt-0.5">Edit informasi login dan role dari {{ $user->name }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5 font-sans">
                    @csrf
                    @method('PUT')

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama Lengkap Pengguna"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium" required>
                        @error('name')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Alamat Email --}}
                    <div>
                        <label for="email" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="contoh@kups.com"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium" required>
                        @error('email')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Kata Sandi Baru --}}
                    <div>
                        <label for="password" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Kata Sandi Baru (Opsional)</label>
                        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin diubah"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium placeholder-[#8E6E4E]/50">
                        <span class="text-[10px] text-[#8E6E4E] font-semibold block mt-1">Minimal 8 karakter jika Anda ingin memperbarui password.</span>
                        @error('password')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Role / Hak Akses --}}
                    <div>
                        <label for="role" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">Role / Hak Akses</label>
                        <select id="role" name="role"
                            class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium" required>
                            <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas Harian (Input Panen)</option>
                            <option value="ketua" {{ old('role', $user->role) === 'ketua' ? 'selected' : '' }}>Ketua KUPS (Melihat Laporan & Grafik)</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator (Kelola Sistem)</option>
                        </select>
                        @error('role')<p class="text-[#A0653D] text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="pt-4 border-t border-[#C9B896]/20 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                           class="bg-[#E6DAC2]/40 text-[#6B4E36] hover:bg-[#E6DAC2]/80 text-xs font-black uppercase tracking-widest px-6 py-3 rounded-xl border border-[#C9B896]/60 transition text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest px-6 py-3 rounded-xl shadow-md shadow-[#4F6146]/10 hover:-translate-y-0.5 transform transition cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 font-sans">
            <button onclick="history.back()"
                class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-[#E5E7EB]/60 bg-[#FFFFFF] hover:bg-[#E6DAC2]/60 text-[#047857] transition shadow-xs cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </button>
            <h2 class="font-bold text-base text-[#064E3B] leading-tight">
                {{ __('Tambah Akun Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-8">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-xs font-bold text-[#047857] mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" placeholder="Nama Lengkap Pengguna" value="{{ old('name') }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                        @error('name')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-xs font-bold text-[#047857] mb-1">Alamat Email</label>
                        <input type="email" name="email" id="email" placeholder="contoh@kups.com" value="{{ old('email') }}" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                        @error('email')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-xs font-bold text-[#047857] mb-1">Kata Sandi (Password)</label>
                        <input type="password" name="password" id="password" placeholder="Min. 8 karakter" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                        @error('password')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="role" class="block text-xs font-bold text-[#047857] mb-1">Role / Hak Akses</label>
                        <select name="role" id="role" required class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white py-2.5 shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                            <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas Harian (Input Panen)</option>
                            <option value="ketua" {{ old('role') == 'ketua' ? 'selected' : '' }}>Ketua KUPS (Melihat Laporan & Grafik)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator (Kelola Sistem)</option>
                        </select>
                        @error('role')<p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>
                    
                    <div class="pt-4 border-t border-[#E5E7EB]/20 flex justify-end">
                        <button type="submit" class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-sm font-extrabold rounded-xl shadow-md transition">
                            Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

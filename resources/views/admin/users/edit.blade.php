<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
                {{ __('Edit Akun Pengguna KUPS') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 border border-slate-350 text-slate-700 text-xs font-bold rounded-xl transition duration-150 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-slate-200/60 p-8">
                <div class="flex items-center space-x-3 pb-5 mb-6 border-b border-slate-100">
                    <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H8v-3.828l9.282-9.282z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 leading-tight">Perbarui Akun</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Edit informasi login dan role dari {{ $user->name }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama Lengkap Pengguna"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5" required>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="contoh@kups.com"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5" required>
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi Baru (Opsional)</label>
                        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin diubah"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5">
                        <span class="text-[10px] text-slate-400 font-semibold block mt-1">Minimal 8 karakter jika Anda ingin memperbarui password.</span>
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="role" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Role / Hak Akses</label>
                        <select id="role" name="role"
                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5" required>
                            <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas Harian (Input Panen)</option>
                            <option value="ketua" {{ old('role', $user->role) === 'ketua' ? 'selected' : '' }}>Ketua KUPS (Melihat Laporan & Grafik)</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator (Kelola Sistem)</option>
                        </select>
                        @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}" 
                           class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition duration-150">
                            Batal
                        </a>
                        <button type="submit"
                            class="py-2.5 px-5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-extrabold rounded-xl transition duration-150 shadow-sm transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

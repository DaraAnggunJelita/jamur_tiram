<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-sans">
            <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
                {{ __('Kelola Pengguna & Anggota KUPS') }}
            </h2>
            <span class="bg-[#E6DAC2] text-[#6B4E36] text-xs font-black px-3 py-1 rounded-full border border-[#C9B896]/60 font-mono-data tracking-wide">
                Mode Admin
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F6F1E6] min-h-screen text-[#26201B]" x-data="{ openCreateModal: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="mb-8 bg-[#7C9169]/10 border-l-4 border-[#4F6146] text-[#37452F] p-4 rounded-r shadow-2xs flex items-center justify-between font-sans" role="alert">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-[#4F6146] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <div>
                            <p class="font-black text-sm font-heading">Berhasil!</p>
                            <p class="text-xs font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Notifikasi Error --}}
            @if (session('error'))
                <div class="mb-8 bg-[#A0653D]/10 border-l-4 border-[#A0653D] text-[#A0653D] p-4 rounded-r shadow-2xs flex items-center justify-between font-sans" role="alert">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-[#A0653D] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        <div>
                            <p class="font-black text-sm font-heading">Gagal!</p>
                            <p class="text-xs font-bold">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Daftar Pengguna (Full Width) --}}
            <div class="bg-[#FBF8F1] shadow-xs rounded-2xl border border-[#C9B896]/40 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 mb-5 border-b border-[#C9B896]/20">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 bg-[#F6F1E6] rounded-lg flex items-center justify-center text-[#6B4E36] text-lg">
                            <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'/></svg>
                        </div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Daftar Akun Pengguna</h3>
                    </div>
                    <button @click="openCreateModal = true"
                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 self-start sm:self-center cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Tambah Pengguna
                    </button>
                </div>

                <div class="overflow-x-auto rounded-xl border border-[#C9B896]/30 bg-white">
                    <table class="min-w-full divide-y divide-[#C9B896]/30">
                        <thead class="bg-[#F6F1E6]/50">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Nama Pengguna</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Email</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Role</th>
                                <th class="px-6 py-3.5 text-left text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Bergabung Pada</th>
                                <th class="px-6 py-3.5 text-center text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#C9B896]/15 bg-white text-[#362C24]">
                            @foreach ($users as $user)
                                <tr class="hover:bg-[#F6F1E6]/30 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-9 h-9 rounded-full font-black text-xs flex items-center justify-center shadow-2xs uppercase font-mono-data
                                                {{ $user->role === 'admin' ? 'bg-[#A0653D]/20 text-[#A0653D]' :
                                                   ($user->role === 'ketua' ? 'bg-[#C9B896]/30 text-[#6B4E36]' : 'bg-[#4F6146]/20 text-[#37452F]') }}">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-[#26201B] font-heading leading-tight">{{ $user->name }}</p>
                                                @if(auth()->id() === $user->id)
                                                    <span class="inline-block bg-[#E6DAC2] text-[#6B4E36] text-[9px] font-black px-1.5 py-0.5 rounded mt-0.5 uppercase tracking-wide font-mono-data">Anda</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#8E6E4E] font-mono-data">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-black rounded-full border uppercase tracking-wider font-mono-data
                                            {{ $user->role === 'admin' ? 'bg-[#A0653D]/10 text-[#A0653D] border-[#A0653D]/20' :
                                               ($user->role === 'ketua' ? 'bg-[#C9B896]/20 text-[#6B4E36] border-[#C9B896]/40' : 'bg-[#7C9169]/15 text-[#37452F] border-[#7C9169]/30') }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                                {{ $user->role === 'admin' ? 'bg-[#A0653D]' :
                                                   ($user->role === 'ketua' ? 'bg-[#6B4E36]' : 'bg-[#4F6146]') }}"></span>
                                            {{ $user->role }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-[#8E6E4E] font-bold font-mono-data">
                                        {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('D MMMM Y') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="p-1.5 bg-[#E6DAC2]/40 text-[#6B4E36] hover:bg-[#E6DAC2]/80 border border-[#C9B896]/60 rounded-lg transition duration-150 shadow-2xs"
                                               title="Edit Pengguna">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H8v-3.828l9.282-9.282z"/>
                                                </svg>
                                            </a>

                                            @if(auth()->id() !== $user->id)
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="p-1.5 bg-[#A0653D]/10 text-[#A0653D] hover:bg-[#A0653D] hover:text-white border border-[#A0653D]/30 rounded-lg transition duration-150 shadow-2xs cursor-pointer"
                                                            title="Hapus Pengguna">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="p-1.5 bg-[#F6F1E6] text-[#C9B896] border border-[#C9B896]/30 rounded-lg cursor-not-allowed opacity-60" title="Tidak bisa menghapus akun sendiri" disabled>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Tambah Pengguna --}}
            <div x-show="openCreateModal"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#26201B]/70 backdrop-blur-xs"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 x-cloak>
                <div @click.away="openCreateModal = false"
                     class="bg-[#FBF8F1] rounded-2xl border border-[#C9B896]/60 p-6 max-w-md w-full shadow-2xl relative animate-fadeIn text-[#26201B]">

                    <button @click="openCreateModal = false" class="absolute top-4 right-4 text-[#8E6E4E] hover:text-[#26201B] transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="flex items-center space-x-2.5 pb-4 mb-5 border-b border-[#C9B896]/20">
                        <div class="w-8 h-8 bg-[#7C9169]/15 rounded-lg flex items-center justify-center text-[#4F6146] text-base">
                            <svg class='w-6 h-6 inline-block' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'/></svg>
                        </div>
                        <h3 class="text-base font-black text-[#26201B] font-heading tracking-tight">Tambah Akun Pengguna</h3>
                    </div>

                    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1.5">Nama Lengkap</label>
                            <input type="text" id="name" name="name" placeholder="Nama Lengkap Pengguna"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-0 text-sm py-2.5 text-[#26201B]" required>
                            @error('name')<p class="text-[#A0653D] text-xs font-bold mt-1 font-sans">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1.5">Alamat Email</label>
                            <input type="email" id="email" name="email" placeholder="contoh@kups.com"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-0 text-sm py-2.5 text-[#26201B] font-mono-data" required>
                            @error('email')<p class="text-[#A0653D] text-xs font-bold mt-1 font-sans">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1.5">Kata Sandi (Password)</label>
                            <input type="password" id="password" name="password" placeholder="Min. 8 karakter"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-0 text-sm py-2.5 text-[#26201B] font-mono-data" required>
                            @error('password')<p class="text-[#A0653D] text-xs font-bold mt-1 font-sans">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="role" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest mb-1.5">Role / Hak Akses</label>
                            <select id="role" name="role"
                                class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-0 text-sm py-2.5 text-[#26201B] font-bold" required>
                                <option value="petugas">Petugas Harian (Input Panen)</option>
                                <option value="ketua">Ketua KUPS (Melihat Laporan & Grafik)</option>
                                <option value="admin">Administrator (Kelola Sistem)</option>
                            </select>
                            @error('role')<p class="text-[#A0653D] text-xs font-bold mt-1 font-sans">{{ $message }}</p>@enderror
                        </div>

                        <div class="pt-4 border-t border-[#C9B896]/20 flex justify-end gap-3">
                            <button type="button" @click="openCreateModal = false"
                                class="px-4 py-2.5 text-sm font-black text-[#8E6E4E] hover:text-[#26201B] transition cursor-pointer">
                                Batal
                            </button>
                            <button type="submit"
                                class="py-2.5 px-5 bg-[#4F6146] hover:bg-[#37452F] text-white text-sm font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 cursor-pointer">
                                Buat Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>


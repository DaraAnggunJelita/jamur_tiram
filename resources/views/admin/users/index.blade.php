<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between font-sans">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-[#E5E7EB] bg-white hover:bg-[#F3F4F6] text-[#4B5563] transition cursor-pointer"
            title="Kembali ke Dashboard">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h2 class="font-bold text-base text-[#064E3B] leading-tight">
            {{ __('Kelola Pengguna & Anggota KUPS') }}
        </h2>
    </div>
 {{-- <span class="bg-[#E6DAC2] text-[#047857] text-xs font-bold px-3 py-1 rounded-full border border-[#E5E7EB]/60">
 Mode Admin
 </span> --}}
 </div>
 </x-slot>
 <div class="py-8 bg-[#F3F5F4] min-h-screen text-[#064E3B]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

 {{-- Notifikasi Sukses --}}
 @if (session('success'))
 <div class="mb-8 bg-[#34D399]/10 border-l-4 border-[#059669] text-[#047857] p-4 rounded-r shadow-2xs flex items-center justify-between font-sans" role="alert">
 <div class="flex items-center space-x-3">
 <svg class="w-5 h-5 text-[#059669] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
 <div>
 <p class="font-bold text-sm">Berhasil!</p>
 <p class="text-xs font-medium">{{ session('success') }}</p>
 </div>
 </div>
 </div>
 @endif

 {{-- Notifikasi Error --}}
 @if (session('error'))
 <div class="mb-8 bg-[#F59E0B]/10 border-l-4 border-[#F59E0B] text-[#F59E0B] p-4 rounded-r shadow-2xs flex items-center justify-between font-sans" role="alert">
 <div class="flex items-center space-x-3">
 <svg class="w-5 h-5 text-[#F59E0B] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
 <div>
 <p class="font-bold text-sm">Gagal!</p>
 <p class="text-xs font-bold">{{ session('error') }}</p>
 </div>
 </div>
 </div>
 @endif

 {{-- Daftar Pengguna (Full Width) --}}
 <div class="bg-[#FFFFFF] shadow-xs rounded-2xl border border-[#E5E7EB]/40 p-6">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 mb-5 border-b border-[#E5E7EB]/20">
 <div>
 <h3 class="text-lg font-bold text-[#064E3B]">Daftar Akun Pengguna</h3>
 {{-- <p class="text-sm text-[#6B7280]">Daftar riwayat akun pengguna sistem yang terdaftar.</p> --}}
 </div>
 <a href="{{ route('admin.users.create') }}"
 class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 cursor-pointer self-start sm:self-center">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
 <span>Tambah Pengguna Baru</span>
 </a>
 </div>

 <div class="overflow-x-auto rounded-xl border border-[#E5E7EB]/30 bg-white">
 <table class="min-w-full divide-y divide-[#E5E7EB]/30">
 <thead class="bg-[#F3F5F4]/50">
 <tr>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Nama Pengguna</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Email</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Role</th>
 <th class="px-6 py-3.5 text-left text-xs font-bold text-[#047857]">Bergabung Pada</th>
 <th class="px-6 py-3.5 text-center text-xs font-bold text-[#047857]">Aksi</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-[#E5E7EB]/15 bg-white text-[#374151]">
 @foreach ($users as $user)
 <tr class="hover:bg-[#F3F5F4]/30 transition duration-150">
 <td class="px-6 py-4 whitespace-nowrap">
 <div class="flex items-center space-x-3">
 <div class="w-9 h-9 rounded-full font-bold text-xs flex items-center justify-center shadow-2xs
 {{ $user->role ==='admin' ?'bg-[#F59E0B]/20 text-[#F59E0B]' :
 ($user->role ==='ketua' ?'bg-[#E5E7EB]/30 text-[#047857]' :'bg-[#059669]/20 text-[#047857]') }}">
 {{ substr($user->name, 0, 2) }}
 </div>
 <div>
 <p class="text-sm font-medium text-[#1F2937] leading-tight">{{ $user->name }}</p>
 @if(auth()->id() === $user->id)
 <span class="inline-block bg-[#E6DAC2] text-[#047857] text-[9px] font-bold px-1.5 py-0.5 rounded mt-0.5">Anda</span>
 @endif
 </div>
 </div>
 </td>

 <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#6B7280]">
 {{ $user->email }}
 </td>

 <td class="px-6 py-4 whitespace-nowrap">
 <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full border
 {{ $user->role ==='admin' ?'bg-[#F59E0B]/10 text-[#F59E0B] border-[#F59E0B]/20' :
 ($user->role ==='ketua' ?'bg-[#E5E7EB]/20 text-[#047857] border-[#E5E7EB]/40' :'bg-[#34D399]/15 text-[#047857] border-[#34D399]/30') }}">
 <span class="w-1.5 h-1.5 rounded-full mr-1.5
 {{ $user->role ==='admin' ?'bg-[#F59E0B]' :
 ($user->role ==='ketua' ?'bg-[#047857]' :'bg-[#059669]') }}"></span>
 {{ $user->role }}
 </span>
 </td>

 <td class="px-6 py-4 whitespace-nowrap text-xs text-[#6B7280] font-bold">
 {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('D MMMM Y') }}
 </td>

 <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
 <div class="flex items-center justify-center space-x-2">
 <a href="{{ route('admin.users.edit', $user->id) }}"
 class="p-1.5 bg-[#E6DAC2]/40 text-[#047857] hover:bg-[#E6DAC2]/80 border border-[#E5E7EB]/60 rounded-lg transition duration-150 shadow-2xs"
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
 class="p-1.5 bg-[#F59E0B]/10 text-[#F59E0B] hover:bg-[#F59E0B] hover:text-white border border-[#F59E0B]/30 rounded-lg transition duration-150 shadow-2xs cursor-pointer"
 title="Hapus Pengguna">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
 </svg>
 </button>
 </form>
 @else
 <button class="p-1.5 bg-[#F3F5F4] text-[#E5E7EB] border border-[#E5E7EB]/30 rounded-lg cursor-not-allowed opacity-60" title="Tidak bisa menghapus akun sendiri" disabled>
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
 <div class="mt-4 px-2">
     {{ $users->links() }}
 </div>
 </div>

 </div>
 </div>
</x-app-layout>


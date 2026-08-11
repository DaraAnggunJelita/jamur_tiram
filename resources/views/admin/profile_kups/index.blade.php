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
                        {{ __('Kelola Profil KUPS Harapan Asri') }}
                    </h2>
                    {{-- <p class="text-xs text-[#047857] mt-0.5 font-medium">Atur informasi profil lembaga, visi, misi, serta kontak yang ditampilkan pada halaman publik.</p> --}}
                </div>
            </div>
            <div>
                {{-- <a href="{{ route('public.profile-kups') }}" target="_blank"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white hover:bg-[#F3F4F6] text-[#059669] font-semibold text-xs rounded-xl border border-[#D1D5DB] transition cursor-pointer shadow-xs">
                    <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>Pratinjau Halaman Publik</span>
                </a> --}}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F3F5F4] min-h-screen font-sans text-[#064E3B]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-[#E5E7EB]/60 rounded-2xl p-6 sm:p-8 shadow-xs overflow-hidden">

                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                <div class="mb-6 p-4 bg-[#34D399]/10 border border-[#34D399]/30 text-[#047857] rounded-xl text-xs font-semibold shadow-xs flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#059669] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-semibold">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.profile-kups.update') }}" class="space-y-6">
                    @csrf

                    <!-- Bagian 1: Identitas Lembaga & Hero -->
                    <div class="bg-[#F9FAFB] p-5 rounded-xl border border-[#E5E7EB]">
                        <div class="border-b border-[#E5E7EB] pb-3 mb-4">
                            <h3 class="font-bold text-xs text-[#064E3B] uppercase tracking-wider">Identitas Utama </h3>
                            {{-- <p class="text-[11px] text-[#6B7280] font-medium mt-0.5">Informasi judul dan deskripsi utama yang muncul di bagian atas halaman publik.</p> --}}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="nama_kups" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Nama Kelompok (KUPS) <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_kups" id="nama_kups" value="{{ old('nama_kups', $profile->nama_kups) }}" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            </div>

                            <div>
                                <label for="sub_judul" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Sub Judul / Wilayah <span class="text-red-500">*</span></label>
                                <input type="text" name="sub_judul" id="sub_judul" value="{{ old('sub_judul', $profile->sub_judul) }}" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            </div>

                            <div class="md:col-span-2">
                                <label for="deskripsi_singkat" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Deskripsi Singkat (Hero Header) <span class="text-red-500">*</span></label>
                                <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">{{ old('deskripsi_singkat', $profile->deskripsi_singkat) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Visi, Misi & Sejarah -->
                    <div class="bg-[#F9FAFB] p-5 rounded-xl border border-[#E5E7EB]">
                        <div class="border-b border-[#E5E7EB] pb-3 mb-4">
                            <h3 class="font-bold text-xs text-[#064E3B] uppercase tracking-wider">Sejarah, Visi & Misi</h3>
                            {{-- <p class="text-[11px] text-[#6B7280] font-medium mt-0.5">Penjelasan mendetail terkait latar belakang dan tujuan utama KUPS.</p> --}}
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="tentang_kami" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Sejarah & Tentang Kami <span class="text-red-500">*</span></label>
                                <textarea name="tentang_kami" id="tentang_kami" rows="4" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">{{ old('tentang_kami', $profile->tentang_kami) }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="visi" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Visi KUPS <span class="text-red-500">*</span></label>
                                    <textarea name="visi" id="visi" rows="4" required
                                        class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">{{ old('visi', $profile->visi) }}</textarea>
                                </div>

                                <div>
                                    <label for="misi" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Misi KUPS <span class="text-red-500">*</span></label>
                                    <textarea name="misi" id="misi" rows="4" required
                                        class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">{{ old('misi', $profile->misi) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 3: Statistik Produksi & Anggota -->
                    <div class="bg-[#F9FAFB] p-5 rounded-xl border border-[#E5E7EB]">
                        <div class="border-b border-[#E5E7EB] pb-3 mb-4">
                            <h3 class="font-bold text-xs text-[#064E3B] uppercase tracking-wider">Angka & Statistik Highlight</h3>
                            {{-- <p class="text-[11px] text-[#6B7280] font-medium mt-0.5">Data ringkasan statistik yang menampilkan pencapaian kelembagaan.</p> --}}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label for="jumlah_anggota" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Jumlah Anggota Aktif (Orang) <span class="text-red-500">*</span></label>
                                <input type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota', $profile->jumlah_anggota) }}" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            </div>

                            <div>
                                <label for="siklus_panen" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Siklus Panen (Kali/Musim) <span class="text-red-500">*</span></label>
                                <input type="number" name="siklus_panen" id="siklus_panen" value="{{ old('siklus_panen', $profile->siklus_panen) }}" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            </div>

                            <div>
                                <label for="tahun_berdiri" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Tahun Berdiri <span class="text-red-500">*</span></label>
                                <input type="number" name="tahun_berdiri" id="tahun_berdiri" value="{{ old('tahun_berdiri', $profile->tahun_berdiri) }}" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 4: Kontak & Alamat -->
                    <div class="bg-[#F9FAFB] p-5 rounded-xl border border-[#E5E7EB]">
                        <div class="border-b border-[#E5E7EB] pb-3 mb-4">
                            <h3 class="font-bold text-xs text-[#064E3B] uppercase tracking-wider">Informasi Kontak & Lokasi</h3>
                            {{-- <p class="text-[11px] text-[#6B7280] font-medium mt-0.5">Alamat dan nomor kontak resmi KUPS yang dapat dihubungi pengunjung.</p> --}}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="nomor_telepon" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $profile->nomor_telepon) }}"
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Alamat Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}"
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3.5 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">
                            </div>

                            <div class="md:col-span-2">
                                <label for="alamat" class="block text-xs font-bold text-[#064E3B] uppercase tracking-wider mb-2">Alamat Lengkap Kumbung / Sekretariat <span class="text-red-500">*</span></label>
                                <textarea name="alamat" id="alamat" rows="2" required
                                    class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-xs font-semibold text-[#1F2937] shadow-xs focus:border-[#059669] focus:ring-[#059669]">{{ old('alamat', $profile->alamat) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Action Tombol Simpan -->
                    <div class="pt-6 border-t border-[#E5E7EB]/60 flex items-center justify-end">
                        <button type="submit"
                            class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl shadow-md transition duration-150 transform hover:-translate-y-0.5 cursor-pointer">
                            Simpan Perubahan Profil KUPS
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

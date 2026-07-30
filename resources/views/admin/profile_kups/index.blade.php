<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-[#064E3B] leading-tight">
                    {{ __('Kelola Profile KUPS') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Atur informasi profil lembaga, visi, misi, sejarah, serta kontak yang ditampilkan pada halaman publik (Umum).
                </p>
            </div>
            <div>
                <a href="{{ route('public.profile-kups') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600/10 text-emerald-700 font-bold text-sm rounded-xl border border-emerald-600/20 hover:bg-emerald-600/20 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Lihat di Halaman Umum
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#F3F5F4] min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 md:p-8 text-gray-900">

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-[#34D399]/15 border border-[#34D399]/40 text-[#047857] rounded-xl text-sm font-bold flex items-center gap-3 shadow-2xs">
                            <svg class="w-5 h-5 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-bold">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.profile-kups.update') }}" class="space-y-8">
                        @csrf

                        <!-- Bagian 1: Identitas Lembaga & Hero -->
                        <div class="bg-emerald-50/50 p-6 rounded-2xl border border-emerald-100/60">
                            <h3 class="font-extrabold text-lg text-[#064E3B] mb-1 flex items-center gap-2">
                                <span class="w-2 h-5 bg-[#064E3B] rounded-full inline-block"></span>
                                Identitas Utama & Hero
                            </h3>
                            <p class="text-xs text-gray-500 mb-6">Informasi judul dan deskripsi yang akan muncul langsung pada layar beranda pengunjung.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_kups" class="block text-xs font-extrabold text-[#047857] uppercase tracking-wider mb-2">Nama Kelompok (KUPS)</label>
                                    <input type="text" name="nama_kups" id="nama_kups" value="{{ old('nama_kups', $profile->nama_kups) }}" required class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                                </div>

                                <div>
                                    <label for="sub_judul" class="block text-xs font-extrabold text-[#047857] uppercase tracking-wider mb-2">Sub Judul / Wilayah</label>
                                    <input type="text" name="sub_judul" id="sub_judul" value="{{ old('sub_judul', $profile->sub_judul) }}" required class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="deskripsi_singkat" class="block text-xs font-extrabold text-[#047857] uppercase tracking-wider mb-2">Deskripsi Singkat (Hero)</label>
                                    <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3" required class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">{{ old('deskripsi_singkat', $profile->deskripsi_singkat) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian 2: Visi, Misi & Sejarah -->
                        <div class="bg-gray-50/70 p-6 rounded-2xl border border-gray-200/60">
                            <h3 class="font-extrabold text-lg text-[#064E3B] mb-1 flex items-center gap-2">
                                <span class="w-2 h-5 bg-[#3A5A40] rounded-full inline-block"></span>
                                Visi, Misi & Sejarah
                            </h3>
                            <p class="text-xs text-gray-500 mb-6">Penjelasan mendetail terkait latar belakang dan tujuan utama Kelompok Usaha Perhutanan Sosial.</p>

                            <div class="space-y-6">
                                <div>
                                    <label for="tentang_kami" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Sejarah & Tentang Kami</label>
                                    <textarea name="tentang_kami" id="tentang_kami" rows="4" required class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">{{ old('tentang_kami', $profile->tentang_kami) }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="visi" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Visi KUPS</label>
                                        <textarea name="visi" id="visi" rows="4" required class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">{{ old('visi', $profile->visi) }}</textarea>
                                    </div>

                                    <div>
                                        <label for="misi" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Misi KUPS (Gunakan Enter untuk daftar baru)</label>
                                        <textarea name="misi" id="misi" rows="4" required class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">{{ old('misi', $profile->misi) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian 3: Statistik Produksi & Anggota -->
                        <div class="bg-amber-50/30 p-6 rounded-2xl border border-amber-100">
                            <h3 class="font-extrabold text-lg text-[#064E3B] mb-1 flex items-center gap-2">
                                <span class="w-2 h-5 bg-[#D4A373] rounded-full inline-block"></span>
                                Angka & Statistik
                            </h3>
                            <p class="text-xs text-gray-500 mb-6">Data sorotan (stats) yang menampilkan kredibilitas dan kemajuan usaha.</p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="jumlah_anggota" class="block text-xs font-extrabold text-amber-900 uppercase tracking-wider mb-2">Jumlah Anggota Aktif (Orang)</label>
                                    <input type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota', $profile->jumlah_anggota) }}" required class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                                </div>

                                <div>
                                    <label for="siklus_panen" class="block text-xs font-extrabold text-amber-900 uppercase tracking-wider mb-2">Siklus Panen (Kali/Musim)</label>
                                    <input type="number" name="siklus_panen" id="siklus_panen" value="{{ old('siklus_panen', $profile->siklus_panen) }}" required class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                                </div>

                                <div>
                                    <label for="tahun_berdiri" class="block text-xs font-extrabold text-amber-900 uppercase tracking-wider mb-2">Tahun Berdiri</label>
                                    <input type="number" name="tahun_berdiri" id="tahun_berdiri" value="{{ old('tahun_berdiri', $profile->tahun_berdiri) }}" required class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                                </div>
                            </div>
                        </div>

                        <!-- Bagian 4: Kontak & Alamat -->
                        <div class="bg-blue-50/30 p-6 rounded-2xl border border-blue-100">
                            <h3 class="font-extrabold text-lg text-[#064E3B] mb-1 flex items-center gap-2">
                                <span class="w-2 h-5 bg-blue-700 rounded-full inline-block"></span>
                                Informasi Kontak & Lokasi
                            </h3>
                            <p class="text-xs text-gray-500 mb-6">Untuk memudahkah mitra maupun pembeli umum menghubungi pengelola KUPS.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nomor_telepon" class="block text-xs font-extrabold text-blue-900 uppercase tracking-wider mb-2">Nomor Telepon / WhatsApp</label>
                                    <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $profile->nomor_telepon) }}" class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-extrabold text-blue-900 uppercase tracking-wider mb-2">Alamat Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}" class="block w-full rounded-xl border-[#E5E7EB] bg-white py-2.5 px-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-xs font-extrabold text-blue-900 uppercase tracking-wider mb-2">Alamat Lengkap Kumbung / Sekretariat</label>
                                    <textarea name="alamat" id="alamat" rows="2" required class="block w-full rounded-xl border-[#E5E7EB] bg-white p-3 text-sm shadow-sm focus:border-[#059669] focus:ring-[#059669]">{{ old('alamat', $profile->alamat) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Action Tombol Simpan -->
                        <div class="pt-6 border-t border-gray-200/80 flex items-center justify-end gap-4">
                            <button type="submit" class="py-3 px-8 bg-[#3A5A40] hover:bg-[#253B29] text-white font-extrabold rounded-xl shadow-lg transition duration-200 flex items-center gap-2 transform hover:-translate-y-0.5 shadow-[#3A5A40]/30">
                                <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                <span>Simpan Perubahan Profile KUPS</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

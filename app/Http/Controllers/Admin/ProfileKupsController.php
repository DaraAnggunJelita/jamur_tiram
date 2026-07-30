<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileKups;
use Illuminate\Http\Request;

class ProfileKupsController extends Controller
{
    /**
     * Menampilkan halaman formulir edit Profil KUPS untuk Admin.
     */
    public function index()
    {
        $profile = ProfileKups::getProfile();

        return view('admin.profile_kups.index', compact('profile'));
    }

    /**
     * Memperbarui data Profil KUPS ke dalam database.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_kups'         => 'required|string|max:255',
            'sub_judul'         => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'tentang_kami'      => 'required|string',
            'visi'              => 'required|string',
            'misi'              => 'required|string',
            'jumlah_anggota'    => 'required|integer|min:1',
            'siklus_panen'      => 'required|integer|min:1',
            'tahun_berdiri'     => 'required|integer|min:1900|max:2100',
            'alamat'            => 'required|string',
            'nomor_telepon'     => 'nullable|string|max:50',
            'email'             => 'nullable|email|max:255',
        ]);

        $profile = ProfileKups::first();
        if (!$profile) {
            $profile = new ProfileKups();
        }

        $profile->fill([
            'nama_kups'         => $request->nama_kups,
            'sub_judul'         => $request->sub_judul,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'tentang_kami'      => $request->tentang_kami,
            'visi'              => $request->visi,
            'misi'              => $request->misi,
            'jumlah_anggota'    => $request->jumlah_anggota,
            'siklus_panen'      => $request->siklus_panen,
            'tahun_berdiri'     => $request->tahun_berdiri,
            'alamat'            => $request->alamat,
            'nomor_telepon'     => $request->nomor_telepon,
            'email'             => $request->email,
        ]);
        $profile->save();

        return redirect()->route('admin.profile-kups.index')->with('success', 'Profil KUPS berhasil diperbarui dan dipublikasikan ke halaman umum.');
    }
}

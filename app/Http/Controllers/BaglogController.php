<?php

namespace App\Http\Controllers;

use App\Models\Baglog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaglogController extends Controller
{
    /**
     * Menampilkan daftar data baglog/kumbung
     */
    public function index()
    {
        // Jika admin atau ketua, tampilkan semua data. Jika petugas, tampilkan miliknya saja.
        if (Auth::user()->role === 'petugas') {
            $baglogs = Baglog::with('user')->where('user_id', Auth::id())->orderBy('tanggal', 'desc')->get();
        } else {
            $baglogs = Baglog::with('user')->orderBy('tanggal', 'desc')->get();
        }

        // Return ke view dashboard baglog kamu (sesuaikan path-nya jika memakai folder khusus)
        return view('baglog.index', compact('baglogs'));
    }

    /**
     * Menampilkan formulir input log baglog baru
     */
    public function create()
    {
        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Hanya petugas yang dapat menambahkan data baglog.');
        }

        return view('baglog.create');
    }

    /**
     * Menyimpan inputan data baglog baru dari Petugas
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah_baglog_aktif' => 'required|integer|min:0',
            'kondisi_kumbung' => 'required|string|max:255',
        ]);

        Baglog::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'jumlah_baglog_aktif' => $request->jumlah_baglog_aktif,
            'kondisi_kumbung' => $request->kondisi_kumbung,
            'status_validasi' => 'pending', // default awal sebelum dicek admin
        ]);

        return redirect()->route('baglog.index')->with('success', 'Data log baglog berhasil dikirim dan menunggu validasi!');
    }

    /**
     * Fitur khusus Admin untuk memvalidasi data baglog
     */
    public function validateBaglog($id)
    {
        // Proteksi tingkat controller agar hanya admin yang bisa memvalidasi
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk tindakan ini.');
        }

        $baglog = Baglog::findOrFail($id);
        $baglog->update([
            'status_validasi' => 'valid'
        ]);

        return redirect()->route('baglog.index')->with('success', 'Data baglog berhasil divalidasi!');
    }
}

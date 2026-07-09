<?php

namespace App\Http\Controllers;

use App\Models\Baglog;
use App\Models\Bibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaglogController extends Controller
{
    /**
     * Menampilkan daftar data baglog/kumbung
     */
    public function index()
    {
        if (Auth::user()->role === 'petugas') {
            $baglogs = Baglog::with(['user', 'bibit'])->where('user_id', Auth::id())->orderBy('tanggal_pembuatan', 'desc')->get();
            $sterilisasis = \App\Models\Sterilisasi::with(['baglog', 'user'])->where('user_id', Auth::id())->orderBy('tanggal', 'desc')->get();
        } else {
            $baglogs = Baglog::with(['user', 'bibit'])->orderBy('tanggal_pembuatan', 'desc')->get();
            $sterilisasis = \App\Models\Sterilisasi::with(['baglog', 'user'])->orderBy('tanggal', 'desc')->get();
        }

        return view('baglog.index', compact('baglogs', 'sterilisasis'));
    }

    /**
     * Menampilkan formulir input log baglog baru
     */
    public function create()
    {
        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Hanya petugas yang dapat menambahkan data baglog.');
        }

        $bibits = Bibit::where('status', 'Tersedia')->get();
        $baglogs = Baglog::orderBy('created_at', 'desc')->get();
        return view('baglog.create', compact('bibits', 'baglogs'));
    }

    /**
     * Menyimpan inputan data baglog baru dari Petugas
     */
    public function store(Request $request)
    {
        $request->validate([
            'bibit_id' => 'required|exists:bibits,id',
            'kode_batch' => 'required|string|unique:baglogs,kode_batch',
            'tanggal_pembuatan' => 'required|date',
            'jumlah_baglog' => 'required|integer|min:1',
        ]);

        Baglog::create([
            'bibit_id' => $request->bibit_id,
            'user_id' => Auth::id(),
            'kode_batch' => $request->kode_batch,
            'tanggal_pembuatan' => $request->tanggal_pembuatan,
            'jumlah_baglog' => $request->jumlah_baglog,
            'status_validasi' => 'pending',
        ]);

        return redirect()->route('baglog.index')->with('success', 'Data pembuatan baglog berhasil disimpan dan menunggu validasi!');
    }

    /**
     * Fitur khusus Admin untuk memvalidasi data baglog
     */
    public function validateBaglog($id)
    {
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

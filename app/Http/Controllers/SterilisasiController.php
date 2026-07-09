<?php

namespace App\Http\Controllers;

use App\Models\Baglog;
use App\Models\Sterilisasi;
use App\Models\Peringatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SterilisasiController extends Controller
{
    public function index()
    {
        $sterilisasis = Sterilisasi::with(['baglog', 'user'])->orderBy('tanggal', 'desc')->get();
        return view('sterilisasi.index', compact('sterilisasis'));
    }

    public function create()
    {
        $baglogs = Baglog::where('status_validasi', 'valid')->get();
        return view('sterilisasi.create', compact('baglogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'baglog_id' => 'required|exists:baglogs,id',
            'tanggal' => 'required|date',
            'durasi_pengukusan' => 'required|integer|min:1',
            'kondisi_air' => 'required|in:Aman,Menipis,Habis',
            'kestabilan_api' => 'required|in:Stabil-Besar,Mengecil,Padam',
        ]);

        $status = 'aman';
        $kritis = false;
        $pesanEws = '';

        if ($request->durasi_pengukusan < 7) {
            $status = 'berisiko';
            $kritis = true;
            $pesanEws .= "Durasi pengukusan kurang dari 7 jam! ";
        }
        if ($request->kestabilan_api !== 'Stabil-Besar') {
            $status = 'berisiko';
            $kritis = true;
            $pesanEws .= "Api " . $request->kestabilan_api . "! Risiko kontaminasi tinggi.";
        }

        $sterilisasi = Sterilisasi::create([
            'baglog_id' => $request->baglog_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'durasi_pengukusan' => $request->durasi_pengukusan,
            'kondisi_air' => $request->kondisi_air,
            'kestabilan_api' => $request->kestabilan_api,
            'status_sterilisasi' => $status,
        ]);

        // Trigger EWS
        if ($kritis) {
            Peringatan::create([
                'kategori' => 'Sterilisasi',
                'referensi_id' => $sterilisasi->id,
                'level' => 'Kritis',
                'pesan' => "Peringatan Batch Baglog #" . $sterilisasi->baglog_id . ": " . $pesanEws,
            ]);
        }

        return redirect()->route('sterilisasi.index')->with('success', 'Data sterilisasi berhasil disimpan.');
    }
}

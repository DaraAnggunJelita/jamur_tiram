<?php

namespace App\Http\Controllers;

use App\Models\Inokulasi;
use App\Models\Sterilisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InokulasiController extends Controller
{
    public function index()
    {
        $inokulasis = Inokulasi::with(['sterilisasi.baglog', 'user'])->orderBy('tanggal', 'desc')->get();
        return view('inokulasi.index', compact('inokulasis'));
    }

    public function create()
    {
        // Ambil data sterilisasi yang siap untuk diinokulasi
        $sterilisasis = Sterilisasi::with('baglog')->orderBy('tanggal', 'desc')->get();
        return view('inokulasi.create', compact('sterilisasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sterilisasi_id' => 'required|exists:sterilisasis,id',
            'tanggal' => 'required|date',
            'jumlah_berhasil' => 'required|integer|min:0',
            'jumlah_kontaminasi' => 'required|integer|min:0',
        ]);

        $sterilisasi = Sterilisasi::findOrFail($request->sterilisasi_id);

        // Petugas tetap bisa menyimpan data meskipun statusnya berisiko (dipaksakan)
        // Peringatan pop-up dihandle di View melalui Javascript saat memilih select option,
        // namun di backend kita juga bisa merekam log atau memberikan notifikasi tambahan jika perlu.

        Inokulasi::create([
            'sterilisasi_id' => $request->sterilisasi_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'jumlah_berhasil' => $request->jumlah_berhasil,
            'jumlah_kontaminasi' => $request->jumlah_kontaminasi,
        ]);

        $pesanFlash = 'Data inokulasi berhasil disimpan.';
        if ($sterilisasi->status_sterilisasi === 'berisiko') {
            $pesanFlash .= ' (Catatan: Anda memaksakan inokulasi pada batch yang berisiko).';
        }

        return redirect()->route('inokulasi.index')->with('success', $pesanFlash);
    }
}

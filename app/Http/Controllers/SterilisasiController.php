<?php

namespace App\Http\Controllers;

use App\Models\Baglog;
use App\Models\Sterilisasi;
use App\Models\Peringatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SterilisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Sterilisasi::with(['baglog', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('baglog', function($baglogQuery) use ($search) {
                      $baglogQuery->where('kode_batch', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal', $request->date);
        }

        $sterilisasis = $query->latest()->paginate(10)->withQueryString();

        return view('sterilisasi.index', compact('sterilisasis'));
    }

    public function create()
    {
        // Hanya tampilkan batch baglog yang belum pernah disterilisasi
        $baglogs = Baglog::whereDoesntHave('sterilisasis')
                    ->orderBy('created_at', 'desc')
                    ->get();
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

        // Logika EWS berdasarkan durasi pengukusan
        if ($request->durasi_pengukusan < 7) {
            $status = 'berisiko';
            $kritis = true;
            $pesanEws .= "Durasi pengukusan kurang dari 7 jam! ";
        } else {
            $status = 'aman';
        }

        // Tambahan logika risiko dari parameter lain (opsional)
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

    public function destroy($id)
    {
        $sterilisasi = Sterilisasi::findOrFail($id);

        if (Auth::user()->role === 'petugas' && $sterilisasi->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data sterilisasi ini.');
        }

        if (\App\Models\Inokulasi::where('sterilisasi_id', $id)->exists()) {
            return redirect()->route('sterilisasi.index')->with('error', 'Data sterilisasi ini tidak dapat dihapus karena sudah masuk tahap inokulasi.');
        }

        $sterilisasi->delete();

        return redirect()->route('sterilisasi.index')->with('success', 'Data sterilisasi berhasil dihapus.');
    }

    public function edit($id)
    {
        $sterilisasi = Sterilisasi::findOrFail($id);
        $baglogs = Baglog::orderBy('created_at', 'desc')->get();
        return view('sterilisasi.edit', compact('sterilisasi', 'baglogs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'baglog_id' => 'required|exists:baglogs,id',
            'tanggal' => 'required|date',
            'durasi_pengukusan' => 'required|integer|min:1',
            'kondisi_air' => 'required|in:Aman,Menipis,Habis',
            'kestabilan_api' => 'required|in:Stabil-Besar,Mengecil,Padam',
        ]);

        $sterilisasi = Sterilisasi::findOrFail($id);
        
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

        $sterilisasi->update([
            'baglog_id' => $request->baglog_id,
            'tanggal' => $request->tanggal,
            'durasi_pengukusan' => $request->durasi_pengukusan,
            'kondisi_air' => $request->kondisi_air,
            'kestabilan_api' => $request->kestabilan_api,
            'status_sterilisasi' => $status,
        ]);

        if ($kritis) {
            Peringatan::create([
                'kategori' => 'Sterilisasi',
                'referensi_id' => $sterilisasi->id,
                'level' => 'Kritis',
                'pesan' => "Peringatan (Update) Batch Baglog #" . $sterilisasi->baglog_id . ": " . $pesanEws,
            ]);
        }

        return redirect()->route('sterilisasi.index')->with('success', 'Data sterilisasi berhasil diperbarui.');
    }

    public function kukusUlang($id)
    {
        $sterilisasi = Sterilisasi::findOrFail($id);
        $sterilisasi->update([
            'durasi_pengukusan' => 0,
            'kondisi_air' => 'Aman',
            'kestabilan_api' => 'Stabil-Besar',
            'status_sterilisasi' => 'aman'
        ]);

        return redirect()->route('sterilisasi.edit', $id)->with('success', 'Silakan inputkan ulang data durasi pengukusan yang benar untuk batch ini.');
    }
}

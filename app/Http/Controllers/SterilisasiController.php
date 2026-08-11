<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use App\Models\Sterilisasi;
use App\Models\Peringatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SterilisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Sterilisasi::with(['bibit.user', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('bibit', function($bibitQuery) use ($search) {
                      $bibitQuery->where('kode_bibit', 'LIKE', '%' . $search . '%')
                                 ->orWhereHas('user', function($u) use ($search) {
                                     $u->where('name', 'LIKE', '%' . $search . '%');
                                 });
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
        // Tampilkan alokasi bibit yang belum pernah disterilisasi
        $query = Bibit::whereDoesntHave('sterilisasis')->orderBy('created_at', 'desc');
        if (Auth::user()->role === 'petugas') {
            $query->where('user_id', Auth::id());
        }
        $bibits = $query->get();

        return view('sterilisasi.create', compact('bibits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bibit_id' => 'required|exists:bibits,id',
            'tanggal' => 'required|date',
        ]);

        Sterilisasi::create([
            'bibit_id' => $request->bibit_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'durasi_pengukusan' => 8,
            'kondisi_air' => 'Aman',
            'kestabilan_api' => 'Stabil-Besar',
            'status_sterilisasi' => 'aman',
        ]);

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

        $query = Bibit::orderBy('created_at', 'desc');
        if (Auth::user()->role === 'petugas') {
            $query->where('user_id', Auth::id());
        }
        $bibits = $query->get();

        return view('sterilisasi.edit', compact('sterilisasi', 'bibits'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bibit_id' => 'required|exists:bibits,id',
            'tanggal' => 'required|date',
        ]);

        $sterilisasi = Sterilisasi::findOrFail($id);

        $sterilisasi->update([
            'bibit_id' => $request->bibit_id,
            'tanggal' => $request->tanggal,
            'durasi_pengukusan' => 8,
            'kondisi_air' => 'Aman',
            'kestabilan_api' => 'Stabil-Besar',
            'status_sterilisasi' => 'aman',
        ]);

        return redirect()->route('sterilisasi.index')->with('success', 'Data sterilisasi berhasil diperbarui.');
    }

    public function kukusUlang($id)
    {
        $sterilisasi = Sterilisasi::findOrFail($id);
        $sterilisasi->update([
            'durasi_pengukusan' => 8,
            'kondisi_air' => 'Aman',
            'kestabilan_api' => 'Stabil-Besar',
            'status_sterilisasi' => 'aman'
        ]);

        return redirect()->route('sterilisasi.index')->with('success', 'Batch berhasil dikukus ulang dengan durasi standar 8 jam.');
    }
}

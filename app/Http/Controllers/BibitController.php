<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use App\Models\DistribusiBibit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibitController extends Controller
{
    public function index(Request $request)
    {
        $query = Bibit::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_bibit', 'LIKE', '%' . $search . '%')
                  ->orWhere('asal_bibit', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal_masuk', $request->date);
        }

        $bibits = $query->latest()->paginate(10)->withQueryString();
        
        return view('bibit.index', compact('bibits'));
    }

    public function create()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('bibit.create', compact('petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bibit' => 'required|string|max:50',
            'asal_bibit' => 'required|string|max:255',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|numeric|min:0.1',
        ]);

        $countPetugas = count($request->user_ids);
        $totalBungkus = (float) $request->jumlah;
        $totalBaglog = $totalBungkus * 50;

        $bungkusPerPetugas = $totalBungkus / $countPetugas;
        $baglogPerPetugas = $totalBaglog / $countPetugas;

        foreach ($request->user_ids as $userId) {
            Bibit::create([
                'user_id' => $userId,
                'kode_bibit' => 'F2',
                'asal_bibit' => $request->asal_bibit,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jumlah' => $bungkusPerPetugas,
                'sisa_stok' => $bungkusPerPetugas,
                'banyak_baglog' => $baglogPerPetugas,
                'status' => 'Aktif/Siap Pakai',
            ]);
        }

        return redirect()->route('bibit.index')->with('success', "Stok $totalBungkus bungkus ($totalBaglog baglog) berhasil ditambahkan dan dibagikan kepada $countPetugas petugas terpilih!");
    }

    public function edit($id)
    {
        $bibit = Bibit::findOrFail($id);
        
        // Cek apakah stok bibit sudah mulai terpakai
        if ($bibit->sisa_stok != $bibit->jumlah) {
            $redirectRoute = auth()->user()->role === 'ketua' ? 'ketua.bibit.pantau' : 'bibit.index';
            return redirect()->route($redirectRoute)->with('error', 'Data bibit yang sudah terpakai tidak dapat diubah.');
        }

        $petugas = User::where('role', 'petugas')->get();
        return view('bibit.edit', compact('bibit', 'petugas'));
    }

    public function update(Request $request, $id)
    {
        $bibit = Bibit::findOrFail($id);

        if ($bibit->sisa_stok != $bibit->jumlah) {
            return redirect()->route('bibit.index')->with('error', 'Data bibit yang sudah terpakai tidak dapat diubah.');
        }

        $request->validate([
            'kode_bibit' => 'required|string|max:50',
            'asal_bibit' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|numeric|min:0.1',
        ]);

        $jumlahBungkus = (float) $request->jumlah;
        $banyakBaglog = $jumlahBungkus * 50;

        $bibit->update([
            'user_id' => $request->user_id,
            'kode_bibit' => 'F2',
            'asal_bibit' => $request->asal_bibit,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $jumlahBungkus,
            'sisa_stok' => $jumlahBungkus,
            'banyak_baglog' => $banyakBaglog,
        ]);

        $redirectRoute = auth()->user()->role === 'ketua' ? 'ketua.bibit.pantau' : 'bibit.index';
        return redirect()->route($redirectRoute)->with('success', 'Data bibit berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bibit = Bibit::findOrFail($id);

        if ($bibit->sisa_stok != $bibit->jumlah) {
            $redirectRoute = auth()->user()->role === 'ketua' ? 'ketua.bibit.pantau' : 'bibit.index';
            return redirect()->route($redirectRoute)->with('error', 'Data bibit yang sudah terpakai tidak dapat dihapus.');
        }

        $bibit->delete();

        $redirectRoute = auth()->user()->role === 'ketua' ? 'ketua.bibit.pantau' : 'bibit.index';
        return redirect()->route($redirectRoute)->with('success', 'Data bibit berhasil dihapus.');
    }
}

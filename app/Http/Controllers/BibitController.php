<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
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
        return view('bibit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bibit' => 'required|string|unique:bibits,kode_bibit|max:50',
            'asal_bibit' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        Bibit::create([
            'user_id' => Auth::id(),
            'kode_bibit' => $request->kode_bibit,
            'asal_bibit' => $request->asal_bibit,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $request->jumlah,
            'sisa_stok' => $request->jumlah,
            'status' => 'Aktif/Siap Pakai',
        ]);

        return redirect()->route('bibit.index')->with('success', 'Data bibit berhasil ditambahkan dan siap digunakan.');
    }

    public function edit($id)
    {
        $bibit = Bibit::findOrFail($id);
        
        // Cek apakah stok bibit sudah mulai terpakai
        if ($bibit->sisa_stok != $bibit->jumlah) {
            return redirect()->route('bibit.index')->with('error', 'Data bibit yang sudah terpakai tidak dapat diubah.');
        }

        return view('bibit.edit', compact('bibit'));
    }

    public function update(Request $request, $id)
    {
        $bibit = Bibit::findOrFail($id);

        if ($bibit->sisa_stok != $bibit->jumlah) {
            return redirect()->route('bibit.index')->with('error', 'Data bibit yang sudah terpakai tidak dapat diubah.');
        }

        $request->validate([
            'kode_bibit' => 'required|string|max:50|unique:bibits,kode_bibit,'.$bibit->id,
            'asal_bibit' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        $bibit->update([
            'kode_bibit' => $request->kode_bibit,
            'asal_bibit' => $request->asal_bibit,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $request->jumlah,
            'sisa_stok' => $request->jumlah,
        ]);

        return redirect()->route('bibit.index')->with('success', 'Data bibit berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bibit = Bibit::findOrFail($id);

        if ($bibit->sisa_stok != $bibit->jumlah) {
            return redirect()->route('bibit.index')->with('error', 'Data bibit yang sudah terpakai tidak dapat dihapus.');
        }

        $bibit->delete();

        return redirect()->route('bibit.index')->with('success', 'Data bibit berhasil dihapus.');
    }
}

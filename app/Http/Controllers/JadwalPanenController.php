<?php

namespace App\Http\Controllers;

use App\Models\JadwalPanen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPanenController extends Controller
{
    /**
     * Menampilkan daftar jadwal estimasi panen
     */
    public function index()
    {
        $jadwals = JadwalPanen::latest()->get();

        return view('jadwal_panen.index', compact('jadwals'));
    }

    /**
     * Menampilkan formulir tambah jadwal panen baru
     */
    public function create()
    {
        if (Auth::user()->role === 'ketua') {
            abort(403, 'Ketua KUPS hanya memiliki hak akses memantau jadwal.');
        }

        return view('jadwal_panen.create');
    }

    /**
     * Menyimpan jadwal panen baru (Bisa diisi oleh Admin atau Petugas)
     */
    public function store(Request $request)
    {
        // Memastikan hanya admin atau petugas yang bisa menambah jadwal panen
        if (Auth::user()->role === 'ketua') {
            abort(403, 'Ketua KUPS hanya memiliki hak akses memantau jadwal.');
        }

        $request->validate([
            'tanggal_estimasi' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string|max:500',
        ]);

        JadwalPanen::create([
            'tanggal_estimasi' => $request->tanggal_estimasi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('jadwal-panen.index')->with('success', 'Jadwal estimasi panen berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir edit jadwal panen
     */
    public function edit($id)
    {
        if (Auth::user()->role === 'ketua') {
            abort(403, 'Ketua KUPS hanya memiliki hak akses memantau jadwal.');
        }

        $jadwal = JadwalPanen::findOrFail($id);
        return view('jadwal_panen.edit', compact('jadwal'));
    }

    /**
     * Memperbarui jadwal panen
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role === 'ketua') {
            abort(403, 'Ketua KUPS hanya memiliki hak akses memantau jadwal.');
        }

        $request->validate([
            'tanggal_estimasi' => 'required|date',
            'catatan' => 'nullable|string|max:500',
        ]);

        $jadwal = JadwalPanen::findOrFail($id);
        $jadwal->update([
            'tanggal_estimasi' => $request->tanggal_estimasi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('jadwal-panen.index')->with('success', 'Jadwal estimasi panen berhasil diperbarui!');
    }

    /**
     * Menghapus jadwal panen
     */
    public function destroy($id)
    {
        if (Auth::user()->role === 'ketua') {
            abort(403, 'Ketua KUPS hanya memiliki hak akses memantau jadwal.');
        }

        $jadwal = JadwalPanen::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal-panen.index')->with('success', 'Jadwal estimasi panen berhasil dihapus!');
    }
}

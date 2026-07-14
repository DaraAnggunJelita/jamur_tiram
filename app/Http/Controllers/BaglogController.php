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
    public function index(Request $request)
    {
        $query = Baglog::with(['user']);

        if (Auth::user()->role === 'petugas') {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_batch', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal_pembuatan', $request->date);
        }

        $baglogs = $query->latest()->paginate(10)->withQueryString();

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

        $baglogs = Baglog::orderBy('created_at', 'desc')->get();
        return view('baglog.create', compact('baglogs'));
    }

    /**
     * Menyimpan inputan data baglog baru dari Petugas
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_batch' => 'required|string|unique:baglogs,kode_batch',
            'tanggal_pembuatan' => 'required|date',
            'jumlah_baglog' => 'required|integer|min:1',
        ]);

        Baglog::create([
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

        // Jika sudah divalidasi
        if ($baglog->status_validasi === 'valid') {
            return redirect()->route('baglog.index')->with('success', 'Data baglog sudah divalidasi sebelumnya.');
        }

        $baglog->update([
            'status_validasi' => 'valid'
        ]);

        return redirect()->route('baglog.index')->with('success', 'Data baglog berhasil divalidasi!');
    }

    public function edit($id)
    {
        $baglog = Baglog::findOrFail($id);

        if (Auth::user()->role === 'petugas' && $baglog->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data baglog ini.');
        }

        if (\App\Models\Sterilisasi::where('baglog_id', $id)->exists()) {
            return redirect()->route('baglog.index')->with('error', 'Data baglog ini tidak dapat diubah karena sudah masuk tahap sterilisasi.');
        }

        // Cek jika sudah di validasi admin, mungkin tidak boleh diedit lagi
        if ($baglog->status_validasi === 'valid') {
            return redirect()->route('baglog.index')->with('error', 'Data baglog sudah divalidasi dan tidak dapat diubah.');
        }

        return view('baglog.edit', compact('baglog'));
    }

    public function update(Request $request, $id)
    {
        $baglog = Baglog::findOrFail($id);

        if (Auth::user()->role === 'petugas' && $baglog->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data baglog ini.');
        }

        if (\App\Models\Sterilisasi::where('baglog_id', $id)->exists()) {
            return redirect()->route('baglog.index')->with('error', 'Data baglog ini tidak dapat diubah karena sudah masuk tahap sterilisasi.');
        }

        if ($baglog->status_validasi === 'valid') {
            return redirect()->route('baglog.index')->with('error', 'Data baglog sudah divalidasi dan tidak dapat diubah.');
        }

        $request->validate([
            'kode_batch' => 'required|string|unique:baglogs,kode_batch,'.$baglog->id,
            'tanggal_pembuatan' => 'required|date',
            'jumlah_baglog' => 'required|integer|min:1',
        ]);

        $baglog->update([
            'kode_batch' => $request->kode_batch,
            'tanggal_pembuatan' => $request->tanggal_pembuatan,
            'jumlah_baglog' => $request->jumlah_baglog,
        ]);

        return redirect()->route('baglog.index')->with('success', 'Data pembuatan baglog berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $baglog = Baglog::findOrFail($id);

        if (Auth::user()->role === 'petugas' && $baglog->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data baglog ini.');
        }

        if (\App\Models\Sterilisasi::where('baglog_id', $id)->exists()) {
            return redirect()->route('baglog.index')->with('error', 'Data baglog ini tidak dapat dihapus karena sudah masuk tahap sterilisasi.');
        }

        if ($baglog->status_validasi === 'valid') {
            return redirect()->route('baglog.index')->with('error', 'Data baglog sudah divalidasi dan tidak dapat dihapus.');
        }

        $baglog->delete();

        return redirect()->route('baglog.index')->with('success', 'Data baglog berhasil dihapus.');
    }
}

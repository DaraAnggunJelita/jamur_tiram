<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\ProductionReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductionReportController extends Controller
{
    /**
     * Menampilkan riwayat laporan panen milik petugas (paginated).
     */
    public function index(): View
    {
        $reports = ProductionReport::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('petugas.laporan_panen.index', compact('reports'));
    }

    /**
     * Menampilkan formulir tambah laporan panen harian.
     */
    public function create(): View
    {
        $inokulasis = \App\Models\Inokulasi::all();
        return view('petugas.laporan_panen.create', compact('inokulasis'));
    }

    /**
     * Menyimpan laporan panen baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'inokulasi_id' => 'required|exists:inokulasis,id',
            'tanggal'      => 'required|date|before_or_equal:today',
            'jumlah_panen' => 'required|numeric|min:0.1',
            'kualitas_panen' => 'required|string|max:50',
            'catatan'      => 'nullable|string',
        ]);

        // LOGIKA OTOMATIS DISTRIBUSI PASCAPANEN
        $status_distribusi = 'Belum Didistribusikan';
        
        if ($request->kualitas_panen === 'Kualitas Bagus') {
            $status_distribusi = 'Siap Jual Segar';
        } elseif ($request->kualitas_panen === 'Kualitas Cukup') {
            $status_distribusi = 'Siap Jual Grosir';
        } elseif ($request->kualitas_panen === 'Kualitas Buruk/Layu') {
            $status_distribusi = 'Pengolahan Kuliner Rendang';
        }

        ProductionReport::create([
            'inokulasi_id'      => $request->inokulasi_id,
            'user_id'           => auth()->id(),
            'tanggal'           => $request->tanggal,
            'jumlah_panen'      => $request->jumlah_panen,
            'kualitas_panen'    => $request->kualitas_panen,
            'status_distribusi' => $status_distribusi,
            'catatan'           => $request->catatan,
            'status_validasi'   => 'pending',
        ]);

        return redirect()->route('petugas.laporan-panen.index')
            ->with('success', 'Laporan panen berhasil ditambahkan dan menunggu validasi Admin.');
    }

    /**
     * Menampilkan formulir edit laporan panen.
     */
    public function edit($id)
    {
        $report = ProductionReport::findOrFail($id);

        if ($report->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        if ($report->status_validasi !== 'pending') {
            return redirect()->route('petugas.laporan-panen.index')
                ->with('error', 'Laporan yang sudah divalidasi tidak dapat diedit.');
        }

        $inokulasis = \App\Models\Inokulasi::all();
        return view('petugas.laporan_panen.edit', compact('report', 'inokulasis'));
    }

    /**
     * Memperbarui laporan panen di database.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $report = ProductionReport::findOrFail($id);

        if ($report->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah laporan ini.');
        }

        if ($report->status_validasi !== 'pending') {
            return redirect()->route('petugas.laporan-panen.index')
                ->with('error', 'Laporan yang sudah divalidasi tidak dapat diubah.');
        }

        $request->validate([
            'inokulasi_id' => 'required|exists:inokulasis,id',
            'tanggal'      => 'required|date|before_or_equal:today',
            'jumlah_panen' => 'required|numeric|min:0.1',
            'kualitas_panen' => 'required|string|max:50',
            'catatan'      => 'nullable|string',
        ]);

        $status_distribusi = 'Belum Didistribusikan';
        if ($request->kualitas_panen === 'Kualitas Bagus') {
            $status_distribusi = 'Siap Jual Segar';
        } elseif ($request->kualitas_panen === 'Kualitas Cukup') {
            $status_distribusi = 'Siap Jual Grosir';
        } elseif ($request->kualitas_panen === 'Kualitas Buruk/Layu') {
            $status_distribusi = 'Pengolahan Kuliner Rendang';
        }

        $report->update([
            'inokulasi_id'      => $request->inokulasi_id,
            'tanggal'           => $request->tanggal,
            'jumlah_panen'      => $request->jumlah_panen,
            'kualitas_panen'    => $request->kualitas_panen,
            'status_distribusi' => $status_distribusi,
            'catatan'           => $request->catatan,
        ]);

        return redirect()->route('petugas.laporan-panen.index')
            ->with('success', 'Laporan panen berhasil diperbarui.');
    }

    /**
     * Menghapus laporan panen dari database.
     */
    public function destroy($id): RedirectResponse
    {
        $report = ProductionReport::findOrFail($id);

        if ($report->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus laporan ini.');
        }

        if ($report->status_validasi !== 'pending') {
            return redirect()->route('petugas.laporan-panen.index')
                ->with('error', 'Laporan yang sudah divalidasi tidak dapat dihapus.');
        }

        $report->delete();

        return redirect()->route('petugas.laporan-panen.index')
            ->with('success', 'Laporan panen berhasil dihapus.');
    }
}

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
        return view('petugas.laporan_panen.create');
    }

    /**
     * Menyimpan laporan panen baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tanggal'      => 'required|date|before_or_equal:today',
            'jumlah_panen' => 'required|numeric|min:0.1',
            'kondisi'      => 'required|string|max:50',
            'catatan'      => 'nullable|string',
        ]);

        ProductionReport::create([
            'user_id'         => auth()->id(),
            'tanggal'         => $request->tanggal,
            'jumlah_panen'    => $request->jumlah_panen,
            'kondisi'         => $request->kondisi,
            'catatan'         => $request->catatan,
            'status_validasi' => 'pending', // Menunggu persetujuan Admin
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

        return view('petugas.laporan_panen.edit', compact('report'));
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
            'tanggal'      => 'required|date|before_or_equal:today',
            'jumlah_panen' => 'required|numeric|min:0.1',
            'kondisi'      => 'required|string|max:50',
            'catatan'      => 'nullable|string',
        ]);

        $report->update([
            'tanggal'      => $request->tanggal,
            'jumlah_panen' => $request->jumlah_panen,
            'kondisi'      => $request->kondisi,
            'catatan'      => $request->catatan,
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

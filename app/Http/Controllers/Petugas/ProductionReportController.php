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
    public function index(Request $request): View
    {
        $query = ProductionReport::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal', $request->date);
        }

        $reports = $query->latest()->paginate(10)->withQueryString();

        return view('petugas.laporan_panen.index', compact('reports'));
    }

    /**
     * Menampilkan formulir tambah laporan panen harian.
     */
    public function create(): View
    {
        $inokulasis = \App\Models\Inokulasi::withCount('productionReports')
            ->having('production_reports_count', '<', 5)
            ->get();
        return view('petugas.laporan_panen.create', compact('inokulasis'));
    }

    /**
     * Menyimpan laporan panen baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'inokulasi_id'  => 'required|exists:inokulasis,id',
            'tanggal'       => 'required|date',
            'siklus_panen'  => 'required|integer|min:1|max:5',
            'berat_grade_a' => 'required|numeric|min:0',
            'berat_grade_b' => 'required|numeric|min:0',
            'catatan'       => 'nullable|string',
        ]);

        $jumlah_panen = $request->berat_grade_a + $request->berat_grade_b;

        ProductionReport::create([
            'inokulasi_id'      => $request->inokulasi_id,
            'user_id'           => auth()->id(),
            'tanggal'           => $request->tanggal,
            'siklus_panen'      => $request->siklus_panen,
            'berat_grade_a'     => $request->berat_grade_a,
            'berat_grade_b'     => $request->berat_grade_b,
            'jumlah_panen'      => $jumlah_panen,
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

        // Tambahkan inokulasi_id yang sedang diedit agar tetap muncul meskipun sudah 5 kali, atau biarkan semua yang < 5
        $inokulasis = \App\Models\Inokulasi::withCount('productionReports')
            ->having('production_reports_count', '<', 5)
            ->orWhere('id', $report->inokulasi_id)
            ->get();
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
            'inokulasi_id'  => 'required|exists:inokulasis,id',
            'tanggal'       => 'required|date',
            'siklus_panen'  => 'required|integer|min:1|max:5',
            'berat_grade_a' => 'required|numeric|min:0',
            'berat_grade_b' => 'required|numeric|min:0',
            'catatan'       => 'nullable|string',
        ]);

        $jumlah_panen = $request->berat_grade_a + $request->berat_grade_b;

        $report->update([
            'inokulasi_id'      => $request->inokulasi_id,
            'tanggal'           => $request->tanggal,
            'siklus_panen'      => $request->siklus_panen,
            'berat_grade_a'     => $request->berat_grade_a,
            'berat_grade_b'     => $request->berat_grade_b,
            'jumlah_panen'      => $jumlah_panen,
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
                ->with('error', 'Laporan yang sudah divalidasi tidak dapat dibatalkan.');
        }

        $report->update(['status_validasi' => 'dibatalkan']);

        return redirect()->route('petugas.laporan-panen.index')
            ->with('success', 'Laporan panen berhasil dibatalkan (Log Audit tersimpan).');
    }
}

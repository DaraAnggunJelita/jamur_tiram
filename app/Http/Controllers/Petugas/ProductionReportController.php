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
        $query = \App\Models\Inokulasi::with(['productionReports' => function($q) {
            if (!auth()->user()->isAdmin()) {
                $q->where('user_id', auth()->id());
            }
            $q->orderBy('siklus_panen', 'asc');
        }, 'sterilisasi.baglog']);

        if (!auth()->user()->isAdmin()) {
            $query->whereHas('productionReports', function($q) {
                $q->where('user_id', auth()->id());
            });
        } else {
            $query->whereHas('productionReports');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('sterilisasi.baglog', function($q) use ($search) {
                $q->where('kode_batch', 'LIKE', '%' . $search . '%');
            });
        }

        if ($request->filled('date')) {
            $date = $request->date;
            $query->whereHas('productionReports', function($q) use ($date) {
                $q->whereDate('tanggal', $date);
            });
        }

        $inokulasis = $query->latest()->paginate(5)->withQueryString();

        return view('petugas.laporan_panen.index', compact('inokulasis'));
    }

    /**
     * Menampilkan formulir tambah laporan panen harian.
     */
    public function create(): View
    {
        $inokulasis = \App\Models\Inokulasi::withCount(['productionReports' => function($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            }])
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

        // Auto-resolve peringatan Panen untuk batch ini
        \App\Models\Peringatan::where('kategori', 'Panen')
            ->where('referensi_id', $request->inokulasi_id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

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

        if (!auth()->user()->isAdmin() && $report->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        if ($report->status_validasi !== 'pending') {
            return redirect()->route('petugas.laporan-panen.index')
                ->with('error', 'Laporan yang sudah divalidasi tidak dapat diedit.');
        }

        // Tambahkan inokulasi_id yang sedang diedit agar tetap muncul meskipun sudah 5 kali, atau biarkan semua yang < 5
        $inokulasis = \App\Models\Inokulasi::withCount(['productionReports' => function($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            }])
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

        if (!auth()->user()->isAdmin() && $report->user_id !== auth()->id()) {
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

        if (!auth()->user()->isAdmin() && $report->user_id !== auth()->id()) {
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

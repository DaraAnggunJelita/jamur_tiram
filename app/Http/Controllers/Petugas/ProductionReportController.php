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
        $date = $request->filled('date') ? $request->date : null;

        $query = \App\Models\Inokulasi::with(['user', 'sterilisasi.bibit',
            'productionReports.user',
            'productionReports' => function($q) use ($date) {
                if (!auth()->user()->isAdmin()) {
                    $q->where('user_id', auth()->id());
                }
                // Jika ada filter tanggal, hanya muat laporan di tanggal tsb
                if ($date) {
                    $q->whereDate('tanggal', $date);
                }
                $q->orderBy('siklus_panen', 'asc');
            }
        ]);

        if (!auth()->user()->isAdmin()) {
            $query->whereHas('productionReports', function($q) {
                $q->where('user_id', auth()->id());
            });
        } else {
            $query->whereHas('productionReports');
        }

        // Filter per batch inokulasi
        if ($request->filled('inokulasi_id')) {
            // Batch dipilih manual → berlaku untuk semua role
            $query->where('id', $request->inokulasi_id);
        } elseif (!auth()->user()->isAdmin() && !$date) {
            // Petugas tanpa filter tanggal → default tampilkan batch terbaru milik sendiri
            $latestBatchId = \App\Models\Inokulasi::whereHas('productionReports', function($q) {
                    $q->where('user_id', auth()->id());
                })
                ->where('user_id', auth()->id())
                ->latest('id')
                ->value('id');
            if ($latestBatchId) {
                $query->where('id', $latestBatchId);
            }
        }
        // Admin tanpa filter → tampilkan SEMUA batch (tidak ada pembatasan)


        // Filter tanggal: hanya tampilkan batch yang PUNYA laporan di tanggal tsb
        if ($date) {
            $query->whereHas('productionReports', function($q) use ($date) {
                if (!auth()->user()->isAdmin()) {
                    $q->where('user_id', auth()->id());
                }
                $q->whereDate('tanggal', $date);
            });
        }

        // Filter nama petugas: hanya tersedia untuk admin/ketua
        if (auth()->user()->isAdmin() && $request->filled('search')) {
            $search = $request->search;
            $query->whereHas('productionReports.user', function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        $inokulasis = $query->latest()->paginate(10)->withQueryString();


        // Ambil semua batch untuk pilihan filter dropdown
        $batchesQuery = \App\Models\Inokulasi::whereHas('productionReports', function($q) {
            if (!auth()->user()->isAdmin()) {
                $q->where('user_id', auth()->id());
            }
        })->with('sterilisasi.bibit')->latest('id');

        if (!auth()->user()->isAdmin()) {
            $batchesQuery->where('user_id', auth()->id());
        }
        $allBatches = $batchesQuery->get();

        // Daftar nama petugas untuk autocomplete (hanya untuk admin)
        $petugasList = auth()->user()->isAdmin()
            ? \App\Models\User::where('role', 'petugas')->orderBy('name')->pluck('name')
            : collect();

        return view('petugas.laporan_panen.index', compact('inokulasis', 'allBatches', 'petugasList'));
    }

    /**
     * Menampilkan formulir tambah laporan panen harian.
     */
    public function create(): View
    {
        $query = \App\Models\Inokulasi::with([
            'user',
            'bibit',
            'sterilisasi.bibit',
            'logInkubasis',
            'productionReports' => function($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            }
        ])
            ->withCount(['productionReports' => function($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            }])
            // SYARAT 1: Hanya tampilkan batch yang memiliki log inkubasi 100%
            ->whereHas('logInkubasis', function($q) {
                $q->where('persentase_tumbuh', 100);
            })
            ->having('production_reports_count', '<', 7);

        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $inokulasis = $query->get();
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
            'siklus_panen'  => 'required|integer|min:1|max:7',
            'berat_grade_a' => 'required|numeric|min:0',
            'berat_grade_b' => 'required|numeric|min:0',
            'catatan'       => 'nullable|string',
        ]);

        $inokulasi = \App\Models\Inokulasi::with('logInkubasis')->findOrFail($request->inokulasi_id);

        // SYARAT 2 (Validasi Backend): Cek persentase inkubasi tertinggi batch ini
        $maxProgres = $inokulasi->logInkubasis->max('persentase_tumbuh') ?? 0;
        if ($maxProgres < 100) {
            return back()->withErrors(['error' => "Gagal! Batch ini belum dapat dipanen karena progres inkubasi/miselium baru mencapai {$maxProgres}% (Wajib 100%)."])->withInput();
        }

        // Validasi Selisih Usia Minimal 50 Hari
        $tanggalInokulasi = \Carbon\Carbon::parse($inokulasi->tanggal)->startOfDay();
        $tanggalPanen = \Carbon\Carbon::parse($request->tanggal)->startOfDay();

        $jarakHari = $tanggalInokulasi->diffInDays($tanggalPanen, false);

        if ($jarakHari < 50) {
            return back()->withErrors(['error' => "Gagal! Batch ini baru berumur $jarakHari hari semenjak inokulasi. Baglog belum layak untuk dipanen (minimal masa inkubasi adalah 50 hari)."])->withInput();
        }

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

        if (!auth()->user()->isAdmin() && $report->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        if ($report->status_validasi !== 'pending') {
            return redirect()->route('petugas.laporan-panen.index')
                ->with('error', 'Laporan yang sudah divalidasi tidak dapat diedit.');
        }

        $query = \App\Models\Inokulasi::with(['user', 'bibit', 'sterilisasi.bibit', 'logInkubasis'])
            ->withCount(['productionReports' => function($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            }])
            ->whereHas('logInkubasis', function($q) {
                $q->where('persentase_tumbuh', 100);
            })
            ->having('production_reports_count', '<', 7);

        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $inokulasis = $query->orWhere('id', $report->inokulasi_id)->get();
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
            'siklus_panen'  => 'required|integer|min:1|max:7',
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
            'status_validasi'   => 'pending',
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
                ->with('error', 'Laporan yang sudah divalidasi tidak dapat dihapus.');
        }

        $report->delete();
 
        return redirect()->route('petugas.laporan-panen.index')
            ->with('success', 'Laporan panen berhasil dihapus secara permanen.');
    }
}

<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\ProductionReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetugasDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard petugas beserta ringkasan aktivitas terbaru.
     */
    public function index(): View
    {
        // Tampilkan seluruh data laporan secara kolektif agar sinkron dengan widget pipeline
        $reportsBulanIni = ProductionReport::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->where('status_validasi', 'valid')
            ->get();

        $totalGradeA = $reportsBulanIni->sum('berat_grade_a');
        $totalGradeB = $reportsBulanIni->sum('berat_grade_b');
        $totalBerat = $totalGradeA + $totalGradeB;
        
        $persentaseA = $totalBerat > 0 ? round(($totalGradeA / $totalBerat) * 100) : 0;
        $persentaseB = $totalBerat > 0 ? round(($totalGradeB / $totalBerat) * 100) : 0;

        // --- STATS PERSONAL PETUGAS (UNTUK CARD & DIAGRAM PERSONAL) ---
        // Keseluruhan berat panen milik petugas yang login (laporan valid)
        $totalBeratPanenSaya = ProductionReport::where('user_id', auth()->id())
            ->where('status_validasi', 'valid')
            ->sum('jumlah_panen');

        // Berat panen personal 6 bulan ini
        $totalBeratPanenSayaBulanIni = ProductionReport::where('user_id', auth()->id())
            ->where('tanggal', '>=', now()->subMonths(5)->startOfMonth())
            ->where('status_validasi', 'valid')
            ->sum('jumlah_panen');

        // Jumlah laporan panen personal 6 bulan ini
        $totalLaporanSayaBulanIni = ProductionReport::where('user_id', auth()->id())
            ->where('tanggal', '>=', now()->subMonths(5)->startOfMonth())
            ->where('status_validasi', 'valid')
            ->count();

        // Rasio Kualitas Panen personal untuk 6 bulan terakhir
        $myReportsBulanIni = ProductionReport::where('user_id', auth()->id())
            ->where('tanggal', '>=', now()->subMonths(5)->startOfMonth())
            ->where('status_validasi', 'valid')
            ->get();
        $totalGradeASaya = $myReportsBulanIni->sum('berat_grade_a');
        $totalGradeBSaya = $myReportsBulanIni->sum('berat_grade_b');
        $totalBeratSaya = $totalGradeASaya + $totalGradeBSaya;
        $persentaseASaya = $totalBeratSaya > 0 ? round(($totalGradeASaya / $totalBeratSaya) * 100) : 0;
        $persentaseBSaya = $totalBeratSaya > 0 ? round(($totalGradeBSaya / $totalBeratSaya) * 100) : 0;
        // --------------------------------------------------------------

        // Aktivitas panen terbaru (dengan pagination 5 per halaman)
        $recentReports = ProductionReport::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->paginate(5, ['*'], 'recent_page');



        // Pipeline Production Indicators (Hanya Milik Petugas yang Login)
        $pipelineStokBaglog = \App\Models\Bibit::where('user_id', auth()->id())->doesntHave('sterilisasis')->orderBy('created_at', 'asc')->get();
        $pipelinePendinginan = \App\Models\Sterilisasi::where('user_id', auth()->id())->with('bibit')->doesntHave('inokulasis')->whereDate('tanggal', today())->orderBy('created_at', 'asc')->get();
        $pipelineSiapInokulasi = \App\Models\Sterilisasi::where('user_id', auth()->id())->with('bibit')->doesntHave('inokulasis')->whereDate('tanggal', '<', today())->orderBy('created_at', 'asc')->get();
        $pipelineInkubasi = \App\Models\Inokulasi::where('user_id', auth()->id())->with('sterilisasi.bibit')->whereDoesntHave('logInkubasis', function ($q) {
            $q->where('persentase_tumbuh', 100);
        })->orderBy('created_at', 'asc')->get();
        $pipelineSiapPanen = \App\Models\Inokulasi::where('user_id', auth()->id())->with('sterilisasi.bibit')
            ->whereHas('productionReports', function($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            }, '<', 7)
            ->where(function ($q) {
            $q->whereHas('logInkubasis', function ($q2) {
                $q2->where('persentase_tumbuh', 100);
            })->orWhere('tanggal', '<=', now()->subDays(40));
        })->orderBy('created_at', 'asc')->get();





        // Ambil data sterilisasi yang berisiko untuk notifikasi (Hanya Milik Petugas yang Login)
        $sterilisasiBerisiko = \App\Models\Sterilisasi::where('user_id', auth()->id())
            ->where('status_sterilisasi', 'berisiko')
            ->with('bibit')
            ->get();

        // Ambil data stok bibit yang dialokasikan oleh Admin ke Petugas ini (hilang dari dashboard setelah dipanen)
        $bibitAlokasi = \App\Models\Bibit::with(['sterilisasis', 'inokulasis'])
            ->where('user_id', auth()->id())
            ->whereDoesntHave('inokulasis.productionReports', function ($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            })
            ->whereDoesntHave('sterilisasis.inokulasis.productionReports', function ($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            })
            ->orderBy('tanggal_masuk', 'desc')
            ->get();
        $totalBibitDiterima = $bibitAlokasi->sum('jumlah');
        $totalBibitSisa = $bibitAlokasi->sum('sisa_stok');

        return view('petugas.dashboard', compact(
            'reportsBulanIni',
            'recentReports', 
            'persentaseA',
            'persentaseB',
            'pipelineStokBaglog',
            'pipelinePendinginan',
            'pipelineSiapInokulasi',
            'pipelineInkubasi',
            'pipelineSiapPanen',
            'sterilisasiBerisiko',
            'bibitAlokasi',
            'totalBibitDiterima',
            'totalBibitSisa',
            'totalBeratPanenSaya',
            'totalBeratPanenSayaBulanIni',
            'totalLaporanSayaBulanIni',
            'persentaseASaya',
            'persentaseBSaya',
            'myReportsBulanIni'
        ));
    }


}

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
        $userId = auth()->id();

        $reportsBulanIni = ProductionReport::where('user_id', $userId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->get();

        $totalGradeA = $reportsBulanIni->sum('berat_grade_a');
        $totalGradeB = $reportsBulanIni->sum('berat_grade_b');
        $totalBerat = $totalGradeA + $totalGradeB;
        
        $persentaseA = $totalBerat > 0 ? round(($totalGradeA / $totalBerat) * 100) : 0;
        $persentaseB = $totalBerat > 0 ? round(($totalGradeB / $totalBerat) * 100) : 0;

        $recentReports = ProductionReport::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->take(10)
            ->get();

        // Mengambil data laporan lainnya yang diinputkan oleh petugas
        $recentBaglogs = \App\Models\Baglog::where('user_id', $userId)->orderBy('created_at', 'desc')->take(5)->get();
        $recentSterilisasi = \App\Models\Sterilisasi::where('user_id', $userId)->orderBy('created_at', 'desc')->take(5)->get();
        $recentInokulasi = \App\Models\Inokulasi::where('user_id', $userId)->orderBy('created_at', 'desc')->take(5)->get();
        $recentMonitoring = \App\Models\MonitoringKumbung::where('user_id', $userId)->orderBy('created_at', 'desc')->take(5)->get();

        // Mengambil data Peringatan Aktif (is_read = false) untuk dikirim ke Dashboard
        $peringatanAktif = \App\Models\Peringatan::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengambil inokulasi yang sudah >= 40 hari dan belum dibuka kapasnya
        $inokulasiBukaKapas = \App\Models\Inokulasi::with('sterilisasi.baglog')
            ->where('status_buka_kapas', false)
            ->where('tanggal', '<=', now()->subDays(40))
            ->get();

        // Pipeline Production Indicators
        $pipelineStokBaglog = \App\Models\Baglog::doesntHave('sterilisasis')->count();
        $pipelinePendinginan = \App\Models\Sterilisasi::doesntHave('inokulasis')->whereDate('tanggal', today())->count();
        $pipelineSiapInokulasi = \App\Models\Sterilisasi::doesntHave('inokulasis')->whereDate('tanggal', '<', today())->count();
        $pipelineInkubasi = \App\Models\Inokulasi::whereDoesntHave('logInkubasis', function ($q) {
            $q->where('persentase_tumbuh', 100);
        })->count();
        $pipelineSiapPanen = \App\Models\Inokulasi::where(function ($q) {
            $q->whereHas('logInkubasis', function ($q2) {
                $q2->where('persentase_tumbuh', 100);
            })->orWhere('tanggal', '<=', now()->subDays(40));
        })->count();

        // Ambil data sterilisasi yang berisiko untuk notifikasi
        $sterilisasiBerisiko = \App\Models\Sterilisasi::where('status_sterilisasi', 'berisiko')
            ->with('baglog')
            ->get();

        return view('petugas.dashboard', compact(
            'reportsBulanIni',
            'recentReports', 
            'peringatanAktif', 
            'inokulasiBukaKapas',
            'recentBaglogs',
            'recentSterilisasi',
            'recentInokulasi',
            'recentMonitoring',
            'persentaseA',
            'persentaseB',
            'pipelineStokBaglog',
            'pipelinePendinginan',
            'pipelineSiapInokulasi',
            'pipelineInkubasi',
            'pipelineSiapPanen',
            'sterilisasiBerisiko'
        ));
    }

    public function resolvePeringatan($id): RedirectResponse
    {
        $peringatan = \App\Models\Peringatan::findOrFail($id);
        $peringatan->update(['is_read' => true]);

        return back()->with('success', 'Peringatan EWS berhasil ditandai selesai.');
    }
}

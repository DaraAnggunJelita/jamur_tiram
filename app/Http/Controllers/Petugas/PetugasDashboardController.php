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
            ->get();

        $totalGradeA = $reportsBulanIni->sum('berat_grade_a');
        $totalGradeB = $reportsBulanIni->sum('berat_grade_b');
        $totalBerat = $totalGradeA + $totalGradeB;
        
        $persentaseA = $totalBerat > 0 ? round(($totalGradeA / $totalBerat) * 100) : 0;
        $persentaseB = $totalBerat > 0 ? round(($totalGradeB / $totalBerat) * 100) : 0;

        $recentReports = ProductionReport::with('user')
            ->orderBy('tanggal', 'desc')
            ->take(10)
            ->get();



        // Mengambil inokulasi yang sudah >= 40 hari dan belum dibuka kapasnya
        $inokulasiBukaKapas = \App\Models\Inokulasi::with('sterilisasi.baglog')
            ->where('status_buka_kapas', false)
            ->where('tanggal', '<=', now()->subDays(40))
            ->get();

        // Pipeline Production Indicators
        $pipelineStokBaglog = \App\Models\Baglog::doesntHave('sterilisasis')->orderBy('created_at', 'asc')->get();
        $pipelinePendinginan = \App\Models\Sterilisasi::with('baglog')->doesntHave('inokulasis')->whereDate('tanggal', today())->orderBy('created_at', 'asc')->get();
        $pipelineSiapInokulasi = \App\Models\Sterilisasi::with('baglog')->doesntHave('inokulasis')->whereDate('tanggal', '<', today())->orderBy('created_at', 'asc')->get();
        $pipelineInkubasi = \App\Models\Inokulasi::with('sterilisasi.baglog')->whereDoesntHave('logInkubasis', function ($q) {
            $q->where('persentase_tumbuh', 100);
        })->orderBy('created_at', 'asc')->get();
        $pipelineSiapPanen = \App\Models\Inokulasi::with('sterilisasi.baglog')
            ->whereHas('productionReports', function($q) {
                $q->where('status_validasi', '!=', 'dibatalkan');
            }, '<', 5)
            ->where(function ($q) {
            $q->whereHas('logInkubasis', function ($q2) {
                $q2->where('persentase_tumbuh', 100);
            })->orWhere('tanggal', '<=', now()->subDays(40));
        })->orderBy('created_at', 'asc')->get();

        // ---------------------------------------------------------
        // EWS LOGIC: MAKSIMAL HARI PANEN
        // ---------------------------------------------------------
        $ewsSetting = \App\Models\EwsSetting::first();
        $maksHariPanen = $ewsSetting ? $ewsSetting->maks_hari_panen : 4;

        foreach ($pipelineSiapPanen as $inokulasi) {
            $lastPanen = \App\Models\ProductionReport::where('inokulasi_id', $inokulasi->id)
                ->where('status_validasi', '!=', 'dibatalkan')
                ->orderBy('tanggal', 'desc')
                ->first();
            
            if ($lastPanen) {
                $lastDate = \Carbon\Carbon::parse($lastPanen->tanggal);
            } else {
                // If never harvested, start counting from the estimated ready date (40 days after inokulasi)
                $lastDate = \Carbon\Carbon::parse($inokulasi->tanggal)->addDays(40);
            }

            $hariTelat = (int) $lastDate->diffInDays(now());

            if ($hariTelat > $maksHariPanen && now()->startOfDay()->greaterThan($lastDate)) {
                $existingWarning = \App\Models\Peringatan::where('kategori', 'Panen')
                    ->where('referensi_id', $inokulasi->id)
                    ->where('is_read', false)
                    ->exists();

                if (!$existingWarning) {
                    $kode = $inokulasi->sterilisasi->baglog->kode_batch ?? $inokulasi->id;
                    \App\Models\Peringatan::create([
                        'kategori' => 'Panen',
                        'referensi_id' => $inokulasi->id,
                        'level' => 'Kritis',
                        'pesan' => "Batch #{$kode} sudah {$hariTelat} hari tidak dipanen (Batas EWS: {$maksHariPanen} hari). Segera panen sebelum layu!",
                        'is_read' => false,
                    ]);
                }
            }
        }
        // ---------------------------------------------------------

        // Mengambil data Peringatan Aktif (is_read = false) untuk dikirim ke Dashboard
        // Dipanggil di sini agar mencakup peringatan EWS baru yang digenerate di atas
        $peringatanAktif = \App\Models\Peringatan::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data sterilisasi yang berisiko untuk notifikasi
        $sterilisasiBerisiko = \App\Models\Sterilisasi::where('status_sterilisasi', 'berisiko')
            ->with('baglog')
            ->get();

        return view('petugas.dashboard', compact(
            'reportsBulanIni',
            'recentReports', 
            'peringatanAktif', 
            'inokulasiBukaKapas',
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

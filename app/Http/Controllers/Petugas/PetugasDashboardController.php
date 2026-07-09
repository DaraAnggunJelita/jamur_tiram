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
        $recentReports = ProductionReport::where('user_id', auth()->id())
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Mengambil data Peringatan Aktif (is_read = false) untuk dikirim ke Dashboard
        $peringatanAktif = \App\Models\Peringatan::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.dashboard', compact('recentReports', 'peringatanAktif'));
    }
}

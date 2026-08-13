<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionReport;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan dashboard Admin: antrian validasi laporan petugas.
     */
    public function index(): View
    {
        // Laporan yang menunggu validasi
        $pendingReports = ProductionReport::with('user')
            ->where('status_validasi', 'pending')
            ->latest()
            ->get();

        // Riwayat laporan yang sudah diproses atau dibatalkan (dengan pagination 5 per halaman)
        $processedReports = ProductionReport::with(['user', 'validator'])
            ->whereIn('status_validasi', ['valid', 'invalid', 'dibatalkan'])
            ->orderBy('updated_at', 'desc')
            ->paginate(5, ['*'], 'audit_page');

        // Data untuk Rasio Kualitas dan Aktivitas Panen Terbaru
        $reportsBulanIni = ProductionReport::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->where('status_validasi', 'valid')
            ->get();
        $totalGradeA = $reportsBulanIni->sum('berat_grade_a');
        $totalGradeB = $reportsBulanIni->sum('berat_grade_b');
        $totalBerat = $totalGradeA + $totalGradeB;
        $persentaseA = $totalBerat > 0 ? round(($totalGradeA / $totalBerat) * 100) : 0;
        $persentaseB = $totalBerat > 0 ? round(($totalGradeB / $totalBerat) * 100) : 0;

        // Aktivitas panen terbaru (dengan pagination 5 per halaman)
        $recentReports = ProductionReport::with('user')
            ->latest()
            ->paginate(5, ['*'], 'recent_page');

        // Keseluruhan berat panen dari seluruh petugas (laporan valid)
        $totalBeratPanenSemua = ProductionReport::where('status_validasi', 'valid')
            ->sum('jumlah_panen');

        return view('admin.dashboard', compact(
            'pendingReports',
            'processedReports',
            'reportsBulanIni',
            'persentaseA',
            'persentaseB',
            'recentReports',
            'totalBeratPanenSemua'
        ));
    }

    /**
     * Proses validasi (Approve / Reject) laporan petugas oleh Admin.
     */
    public function validateReport(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'status'  => 'required|in:valid,invalid',
            'catatan' => 'nullable|string',
        ]);

        $report = ProductionReport::findOrFail($id);
        
        $catatan = $report->catatan;
        if ($request->filled('catatan')) {
            $catatan = ($catatan ? $catatan . "\n[Admin]: " : "[Admin]: ") . $request->catatan;
        }

        $report->update([
            'status_validasi' => $request->status,
            'catatan'         => $catatan,
            'validated_by'    => auth()->id(),
        ]);

        $message = $request->status === 'valid'
            ? 'Laporan berhasil disetujui (VALID).'
            : 'Laporan berhasil ditolak (INVALID).';

        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    // Old bibit routes removed. Admin uses BibitController now.
}

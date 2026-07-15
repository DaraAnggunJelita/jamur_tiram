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
            ->orderBy('tanggal', 'asc')
            ->get();

        // Riwayat laporan yang sudah diproses atau dibatalkan
        $processedReports = ProductionReport::with(['user', 'validator'])
            ->whereIn('status_validasi', ['valid', 'invalid', 'dibatalkan'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        // Data untuk Rasio Kualitas dan Aktivitas Panen Terbaru
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
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('pendingReports', 'processedReports', 'reportsBulanIni', 'persentaseA', 'persentaseB', 'recentReports'));
    }

    /**
     * Proses validasi (Approve / Reject) laporan petugas oleh Admin.
     */
    public function validateReport(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:valid,invalid',
        ]);

        $report = ProductionReport::findOrFail($id);
        $report->update([
            'status_validasi' => $request->status,
            'validated_by'    => auth()->id(),
        ]);

        $message = $request->status === 'valid'
            ? 'Laporan berhasil disetujui (VALID).'
            : 'Laporan berhasil ditolak (INVALID).';

        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    // Old bibit routes removed. Admin uses BibitController now.
}

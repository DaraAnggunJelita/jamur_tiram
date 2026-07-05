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

        // Riwayat laporan yang sudah diproses
        $processedReports = ProductionReport::with(['user', 'validator'])
            ->whereIn('status_validasi', ['valid', 'invalid'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('pendingReports', 'processedReports'));
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
    }}

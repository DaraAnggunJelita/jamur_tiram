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
    }

    /**
     * Tampilkan pemantauan stok bibit.
     */
    public function pantauStokBibit(): View
    {
        $bibits = \App\Models\Bibit::with('user')->orderBy('tanggal_masuk', 'desc')->get();
        return view('admin.bibit.pantau_stok', compact('bibits'));
    }

    /**
     * Konfirmasi ketersediaan bibit.
     */
    public function konfirmasiBibit($id): RedirectResponse
    {
        $bibit = \App\Models\Bibit::findOrFail($id);
        
        if ($bibit->status === 'Pending Konfirmasi Admin') {
            $bibit->update(['status' => 'Aktif/Siap Pakai']);
            return redirect()->route('admin.bibit.pantau')->with('success', 'Stok bibit berhasil dikonfirmasi dan kini Aktif/Siap Pakai.');
        }

        return redirect()->route('admin.bibit.pantau')->with('error', 'Status bibit tidak valid untuk dikonfirmasi.');
    }

    /**
     * Tambah stok bibit yang sudah ada.
     */
    public function tambahStokBibit(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'tambahan_stok' => 'required|integer|min:1',
        ]);

        $bibit = \App\Models\Bibit::findOrFail($id);
        
        // Hanya bisa nambah stok jika statusnya sudah aktif atau habis
        if ($bibit->status === 'Aktif/Siap Pakai' || $bibit->status === 'Habis') {
            $bibit->jumlah += $request->tambahan_stok;
            $bibit->sisa_stok += $request->tambahan_stok;
            $bibit->status = 'Aktif/Siap Pakai'; // Jika sebelumnya habis, otomatis aktif lagi
            $bibit->save();

            return redirect()->route('admin.bibit.pantau')->with('success', 'Stok bibit berhasil ditambahkan sebanyak ' . $request->tambahan_stok . ' botol.');
        }

        return redirect()->route('admin.bibit.pantau')->with('error', 'Stok bibit tidak dapat ditambahkan pada status ini.');
    }
}

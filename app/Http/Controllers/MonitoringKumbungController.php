<?php

namespace App\Http\Controllers;

use App\Models\Inokulasi;
use App\Models\MonitoringKumbung;
use App\Models\Peringatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringKumbungController extends Controller
{
    public function index(Request $request)
    {
        $query = MonitoringKumbung::with(['inokulasi', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($uq) use ($search) {
                    $uq->where('name', 'LIKE', "%{$search}%");
                })->orWhere('inokulasi_id', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal', $request->date);
        }

        $monitorings = $query->latest()->paginate(10)->withQueryString();

        return view('monitoring.index', compact('monitorings'));
    }

    public function create()
    {
        // Hanya tampilkan batch inokulasi yang masih aktif (belum afkir / jumlah_berhasil > 0)
        $inokulasis = Inokulasi::where('jumlah_berhasil', '>', 0)->get();
        return view('monitoring.create', compact('inokulasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inokulasi_id' => 'required|exists:inokulasis,id',
            'tanggal' => 'required|date',
            'kondisi_udara' => 'required|in:Sejuk,Hangat,Panas/Gersang',
            'kondisi_lantai' => 'required|in:Basah/Lembab,Kering',
            'jumlah_penyiraman' => 'required|integer|min:0',
        ]);

        $monitoring = MonitoringKumbung::create([
            'inokulasi_id' => $request->inokulasi_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'kondisi_udara' => $request->kondisi_udara,
            'kondisi_lantai' => $request->kondisi_lantai,
            'jumlah_penyiraman' => $request->jumlah_penyiraman,
        ]);

        // Auto-resolve peringatan kumbung sebelumnya untuk batch ini
        $existingMonitoringIds = MonitoringKumbung::where('inokulasi_id', $request->inokulasi_id)->pluck('id');
        Peringatan::where('kategori', 'Kumbung')
            ->whereIn('referensi_id', $existingMonitoringIds)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // EWS Logic
        if ($request->kondisi_udara === 'Panas/Gersang' && $request->jumlah_penyiraman <= 1) {
            Peringatan::create([
                'kategori' => 'Kumbung',
                'referensi_id' => $monitoring->id,
                'level' => 'Kritis',
                'pesan' => "Kumbung " . $monitoring->inokulasi_id . " KRITIS/BAHAYA! Udara panas/gersang dan penyiraman kurang (<= 1x). Segera lakukan tindakan ekstra.",
                'is_read' => false,
            ]);
        } elseif ($request->kondisi_udara === 'Panas/Gersang' || $request->kondisi_lantai === 'Kering') {
            Peringatan::create([
                'kategori' => 'Kumbung',
                'referensi_id' => $monitoring->id,
                'level' => 'Waspada',
                'pesan' => "Kumbung " . $monitoring->inokulasi_id . " berisiko. Udara panas/lantai kering. Pastikan penyiraman cukup.",
                'is_read' => false,
            ]);
        } elseif ($request->kondisi_udara === 'Hangat' && $request->jumlah_penyiraman < 2) {
            Peringatan::create([
                'kategori' => 'Kumbung',
                'referensi_id' => $monitoring->id,
                'level' => 'Waspada',
                'pesan' => "Kumbung " . $monitoring->inokulasi_id . " Hangat. Disarankan melakukan penyiraman kembali.",
                'is_read' => false,
            ]);
        }

        return redirect()->route('monitoring.index')->with('success', 'Data monitoring kumbung berhasil disimpan.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Inokulasi;
use App\Models\MonitoringKumbung;
use App\Models\Peringatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringKumbungController extends Controller
{
    public function index()
    {
        $monitorings = MonitoringKumbung::with(['inokulasi', 'user'])->orderBy('tanggal', 'desc')->get();
        return view('monitoring.index', compact('monitorings'));
    }

    public function create()
    {
        $inokulasis = Inokulasi::all();
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

        // EWS Logic
        if ($request->kondisi_udara === 'Panas/Gersang' || $request->kondisi_lantai === 'Kering') {
            Peringatan::create([
                'kategori' => 'Kumbung',
                'referensi_id' => $monitoring->id,
                'level' => 'Kritis',
                'pesan' => "Kumbung " . $monitoring->inokulasi_id . " Kritis! Udara panas/lantai kering. Segera lakukan penyiraman ekstra.",
                'is_read' => false, // Equivalent to status_tindakan: 'Belum'
            ]);
        } elseif ($request->kondisi_udara === 'Hangat' && $request->jumlah_penyiraman < 2) {
            Peringatan::create([
                'kategori' => 'Kumbung',
                'referensi_id' => $monitoring->id,
                'level' => 'Waspada', // Level Peringatan
                'pesan' => "Kumbung " . $monitoring->inokulasi_id . " Hangat. Disarankan melakukan penyiraman kembali.",
                'is_read' => false,
            ]);
        }

        return redirect()->route('monitoring.index')->with('success', 'Data monitoring kumbung berhasil disimpan.');
    }
}

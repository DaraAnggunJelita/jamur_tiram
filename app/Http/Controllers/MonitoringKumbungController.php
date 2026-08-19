<?php

namespace App\Http\Controllers;

use App\Models\Inokulasi;
use App\Models\MonitoringKumbung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringKumbungController extends Controller
{
    public function index(Request $request)
    {
        $query = MonitoringKumbung::with(['inokulasi', 'user']);

        // Jika petugas: hanya tampilkan log monitoring milik sendiri
        if (Auth::user()->role === 'petugas') {
            $query->where('user_id', Auth::id());
        }

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

    public function create(Request $request)
    {
        // Hanya tampilkan batch inokulasi yang masih aktif (belum afkir / jumlah_berhasil > 0),
        // sudah menyelesaikan inkubasi 100%,
        // dan belum menyelesaikan masa panen (memiliki kurang dari 7 siklus laporan panen)
        $inokulasisQuery = Inokulasi::with(['user', 'sterilisasi'])
            ->where('jumlah_berhasil', '>', 0)
            ->whereHas('logInkubasis', function ($q) {
                $q->where('persentase_tumbuh', 100);
            })
            ->where(function($query) {
                $query->whereDoesntHave('productionReports', function($q) {
                    $q->where('status_validasi', '!=', 'dibatalkan');
                })->orWhereHas('productionReports', function($q) {
                    $q->where('status_validasi', '!=', 'dibatalkan');
                }, '<', 7);
            });

        if (Auth::user()->role === 'petugas') {
            $inokulasisQuery->where('user_id', Auth::id());
        }
        $inokulasis = $inokulasisQuery->get();

        $latestMonitoring = null;
        $defaultDate = date('Y-m-d');
        $lastRecordedDate = null;
        $lastRecordedType = null;
        
        if ($request->filled('inokulasi_id')) {
            $inokulasi = Inokulasi::find($request->inokulasi_id);
            if ($inokulasi) {
                $latestMonitoring = MonitoringKumbung::where('inokulasi_id', $request->inokulasi_id)->latest('tanggal')->first();
                if ($latestMonitoring) {
                    $defaultDate = \Carbon\Carbon::parse($latestMonitoring->tanggal)->addDay()->format('Y-m-d');
                    $lastRecordedDate = \Carbon\Carbon::parse($latestMonitoring->tanggal)->format('d M Y');
                    $lastRecordedType = 'monitoring';
                } else {
                    $latestInkubasi = \App\Models\LogInkubasi::where('inokulasi_id', $request->inokulasi_id)->latest('tanggal_catat')->first();
                    if ($latestInkubasi) {
                        $defaultDate = \Carbon\Carbon::parse($latestInkubasi->tanggal_catat)->addDay()->format('Y-m-d');
                        $lastRecordedDate = \Carbon\Carbon::parse($latestInkubasi->tanggal_catat)->format('d M Y');
                        $lastRecordedType = 'progres inkubasi';
                    } else {
                        $defaultDate = \Carbon\Carbon::parse($inokulasi->tanggal)->addDay()->format('Y-m-d');
                        $lastRecordedDate = \Carbon\Carbon::parse($inokulasi->tanggal)->format('d M Y');
                        $lastRecordedType = 'inokulasi';
                    }
                }
            }
        }
        
        return view('monitoring.create', compact('inokulasis', 'latestMonitoring', 'defaultDate', 'lastRecordedDate', 'lastRecordedType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inokulasi_id' => 'required|exists:inokulasis,id',
            'tanggal' => 'required|date',
            'kondisi_udara' => 'required|in:Sejuk,Panas,Panas/Gersang',
            'jumlah_penyiraman' => 'required|integer|min:0',
        ]);

        $monitoring = MonitoringKumbung::create([
            'inokulasi_id' => $request->inokulasi_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'kondisi_udara' => $request->kondisi_udara === 'Panas/Gersang' ? 'Panas' : $request->kondisi_udara,
            'kondisi_lantai' => 'Basah/Lembab', // Default otomatis
            'jumlah_penyiraman' => $request->jumlah_penyiraman,
        ]);



        return redirect()->route('monitoring.index')->with('success', 'Data monitoring kumbung berhasil disimpan.');
    }
}

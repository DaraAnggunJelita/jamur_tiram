<?php

namespace App\Http\Controllers;

use App\Models\Inokulasi;
use App\Models\Sterilisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InokulasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Inokulasi::with(['sterilisasi.baglog', 'user', 'logInkubasis.user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('sterilisasi.baglog', function($baglogQuery) use ($search) {
                      $baglogQuery->where('kode_batch', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal', $request->date);
        }

        $inokulasis = $query->latest()->paginate(10)->withQueryString();

        return view('inokulasi.index', compact('inokulasis'));
    }

    public function create()
    {
        // Ambil data sterilisasi yang siap untuk diinokulasi
        $sterilisasis = Sterilisasi::whereDoesntHave('inokulasis')->with('baglog')->orderBy('tanggal', 'desc')->get();
        // Ambil data bibit yang masih tersedia
        $bibits = \App\Models\Bibit::where('status', 'Aktif/Siap Pakai')->where('sisa_stok', '>', 0)->get();
        return view('inokulasi.create', compact('sterilisasis', 'bibits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sterilisasi_id' => 'required|exists:sterilisasis,id',
            'bibit_id' => 'required|exists:bibits,id',
            'tanggal' => 'required|date',
            'jumlah_bibit_terpakai' => 'required|integer|min:1',
        ]);

        $sterilisasi = Sterilisasi::with('baglog')->findOrFail($request->sterilisasi_id);
        $bibit = \App\Models\Bibit::findOrFail($request->bibit_id);

        if ($request->jumlah_bibit_terpakai > $bibit->sisa_stok) {
            return back()->withErrors(['jumlah_bibit_terpakai' => 'Maaf, jumlah botol yang dipakai melebihi sisa stok yang ada di gudang!'])->withInput();
        }

        $tanggalSterilisasi = \Carbon\Carbon::parse($sterilisasi->tanggal)->startOfDay();
        $tanggalInokulasi = \Carbon\Carbon::parse($request->tanggal)->startOfDay();
        $jarakHari = $tanggalSterilisasi->diffInDays($tanggalInokulasi, false);

        if ($jarakHari < 1) {
            return back()->withErrors(['error' => 'Gagal! Baglog belum layak disuntikkan bibit hari ini karena suhu masih panas. Minimal tunggu 1 hari setelah sterilisasi.'])->withInput();
        } elseif ($jarakHari > 3) {
            return back()->withErrors(['error' => 'Gagal! Jeda inokulasi maksimal adalah 3 hari setelah sterilisasi. Media mungkin sudah tidak steril/ideal.'])->withInput();
        }

        $jumlah_baglog_awal = $sterilisasi->baglog->jumlah_baglog ?? 0;

        Inokulasi::create([
            'sterilisasi_id' => $request->sterilisasi_id,
            'bibit_id' => $request->bibit_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'jumlah_berhasil' => $jumlah_baglog_awal,
            'jumlah_kontaminasi' => 0,
            'jumlah_bibit_terpakai' => $request->jumlah_bibit_terpakai,
        ]);

        // Kurangi sisa stok bibit otomatis
        $bibit->sisa_stok -= $request->jumlah_bibit_terpakai;
        if ($bibit->sisa_stok == 0) {
            $bibit->status = 'Habis';
        }
        $bibit->save();

        $pesanFlash = 'Data inokulasi berhasil disimpan.';
        if ($sterilisasi->status_sterilisasi === 'berisiko') {
            $pesanFlash .= ' (Catatan: Anda memaksakan inokulasi pada batch yang berisiko).';
        }

        return redirect()->route('inokulasi.index')->with('success', $pesanFlash);
    }

    public function storeLog(Request $request, $id)
    {
        \Illuminate\Support\Facades\Log::info("storeLog called for id $id with persentase: " . $request->persentase_tumbuh);
        $request->validate([
            'tanggal_catat' => 'required|date',
            'persentase_tumbuh' => 'required|integer|in:25,50,75,100',
            'tambah_kontaminasi' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $inokulasi = Inokulasi::with('logInkubasis')->findOrFail($id);

        $tanggalInokulasi = \Carbon\Carbon::parse($inokulasi->tanggal)->startOfDay();
        $tanggalSekarang = \Carbon\Carbon::parse($request->tanggal_catat)->startOfDay();
        
        if ($tanggalSekarang->lessThan($tanggalInokulasi)) {
            \Illuminate\Support\Facades\Log::warning("Failed date validation: input=$tanggalSekarang, inokulasi=$tanggalInokulasi");
            return back()->withErrors(['error' => 'Gagal! Tanggal pencatatan progres tidak boleh mendahului tanggal inokulasi (' . $tanggalInokulasi->format('d/m/Y') . ').']);
        }

        $maxProgres = $inokulasi->logInkubasis->max('persentase_tumbuh') ?? 0;
        $expectedNext = $maxProgres + 25;

        if ($request->persentase_tumbuh != $expectedNext) {
            \Illuminate\Support\Facades\Log::warning("Failed sequence validation: requested=" . $request->persentase_tumbuh . ", expected=$expectedNext");
            return back()->withErrors(['error' => "Gagal! Anda harus memasukkan progres secara runtut (Target saat ini: $expectedNext%)."]);
        }

        $tambah_kontaminasi = $request->tambah_kontaminasi ?? 0;

        if ($tambah_kontaminasi > $inokulasi->jumlah_berhasil) {
            return back()->withErrors(['tambah_kontaminasi' => 'Jumlah kontaminasi melebihi sisa baglog yang berhasil tumbuh.']);
        }

        // Update jumlah berhasil dan kontaminasi
        if ($tambah_kontaminasi > 0) {
            $inokulasi->jumlah_berhasil -= $tambah_kontaminasi;
            $inokulasi->jumlah_kontaminasi += $tambah_kontaminasi;
            $inokulasi->save();
        }

        \App\Models\LogInkubasi::create([
            'inokulasi_id' => $inokulasi->id,
            'user_id' => Auth::id(),
            'persentase_tumbuh' => $request->persentase_tumbuh,
            'catatan' => $request->catatan,
            'tanggal_catat' => $request->tanggal_catat,
        ]);

        \Illuminate\Support\Facades\Log::info("Successfully created LogInkubasi");
        return back()->with('success', 'Progress inkubasi berhasil dicatat.');
    }

    public function bukaKapas(Request $request, $id)
    {
        $inokulasi = Inokulasi::findOrFail($id);
        $inokulasi->update(['status_buka_kapas' => true]);
        
        return redirect()->back()->with('success', 'Status buka kapas/cincin berhasil dikonfirmasi!');
    }

    public function destroy($id)
    {
        $inokulasi = Inokulasi::findOrFail($id);

        if (Auth::user()->role === 'petugas' && $inokulasi->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data inokulasi ini.');
        }

        if (\App\Models\ProductionReport::where('inokulasi_id', $id)->exists()) {
            return redirect()->route('inokulasi.index')->with('error', 'Data inokulasi ini tidak dapat dihapus karena sudah mulai masuk masa panen.');
        }

        $inokulasi->delete();

        return redirect()->route('inokulasi.index')->with('success', 'Data inokulasi berhasil dihapus.');
    }
}

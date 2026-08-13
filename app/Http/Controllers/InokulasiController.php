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
        $query = Inokulasi::with(['sterilisasi.bibit.user', 'user', 'logInkubasis.user']);

        // Jika petugas: hanya tampilkan riwayat inokulasi milik sendiri
        if (Auth::user()->role === 'petugas') {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('sterilisasi.bibit', function($bibitQuery) use ($search) {
                      $bibitQuery->where('kode_bibit', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal', $request->date);
        }

        $inokulasis = $query->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();

        return view('inokulasi.index', compact('inokulasis'));
    }

    public function create()
    {
        // Ambil data sterilisasi yang siap untuk diinokulasi
        // Jika petugas: hanya tampilkan sterilisasi milik sendiri
        $sterilisasisQuery = Sterilisasi::whereDoesntHave('inokulasis')->with('bibit.user')->orderBy('tanggal', 'desc');
        if (Auth::user()->role === 'petugas') {
            $sterilisasisQuery->where('user_id', Auth::id());
        }
        $sterilisasis = $sterilisasisQuery->get();
        return view('inokulasi.create', compact('sterilisasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sterilisasi_id' => 'required|exists:sterilisasis,id',
            'tanggal' => 'required|date',
        ]);

        $sterilisasi = Sterilisasi::with('bibit')->findOrFail($request->sterilisasi_id);
        $bibit = $sterilisasi->bibit;

        $tanggalSterilisasi = \Carbon\Carbon::parse($sterilisasi->tanggal)->startOfDay();
        $tanggalInokulasi = \Carbon\Carbon::parse($request->tanggal)->startOfDay();
        $jarakHari = $tanggalSterilisasi->diffInDays($tanggalInokulasi, false);

        if ($jarakHari < 2) {
            $sisaHari = 2 - $jarakHari;
            return back()->withErrors(['error' => "Gagal! Baglog belum layak disuntikkan bibit. Baglog harus didinginkan minimal 2 hari setelah sterilisasi (tanggal sterilisasi: " . \Carbon\Carbon::parse($sterilisasi->tanggal)->format('d/m/Y') . ", paling cepat inokulasi: " . \Carbon\Carbon::parse($sterilisasi->tanggal)->addDays(2)->format('d/m/Y') . "). Sisa {$sisaHari} hari pendinginan."])->withInput();
        }

        $jumlah_baglog_awal = $sterilisasi->bibit->banyak_baglog ?? 0;
        $bibit_id = $bibit ? $bibit->id : null;
        $jumlah_terpakai = $bibit ? (float) ($bibit->sisa_stok > 0 ? $bibit->sisa_stok : $bibit->jumlah) : 0;

        Inokulasi::create([
            'sterilisasi_id' => $request->sterilisasi_id,
            'bibit_id' => $bibit_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'jumlah_berhasil' => $jumlah_baglog_awal,
            'jumlah_kontaminasi' => 0,
            'jumlah_bibit_terpakai' => $jumlah_terpakai,
        ]);

        // Kurangi sisa stok bibit otomatis
        if ($bibit) {
            $bibit->sisa_stok = 0;
            $bibit->status = 'Habis';
            $bibit->save();
        }

        $pesanFlash = 'Data inokulasi berhasil disimpan.';
        $tipePesan = 'success';
        
        if ($sterilisasi->status_sterilisasi === 'berisiko') {
            $pesanFlash .= ' (Catatan: Anda memaksakan inokulasi pada batch yang berisiko).';
        }

        if ($jarakHari > 2) {
            $pesanFlash = '⚠️ Peringatan: Data Inokulasi berhasil disimpan, namun jeda sterilisasi melebihi 2 hari. Media baglog ini memiliki risiko kontaminasi yang tinggi.';
            $tipePesan = 'warning';
        }

        return redirect()->route('inokulasi.index')->with($tipePesan, $pesanFlash);
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



    public function destroy($id)
    {
        $inokulasi = Inokulasi::findOrFail($id);

        if (Auth::user()->role === 'petugas' && $inokulasi->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data inokulasi ini.');
        }

        if (\App\Models\ProductionReport::where('inokulasi_id', $id)->exists()) {
            return redirect()->route('inokulasi.index')->with('error', 'Data inokulasi ini tidak dapat dihapus karena sudah mulai masuk masa panen.');
        }

        // Kembalikan stok bibit yang dipakai
        if ($inokulasi->bibit_id && $inokulasi->bibit) {
            $inokulasi->bibit->sisa_stok += $inokulasi->jumlah_bibit_terpakai;
            if ($inokulasi->bibit->sisa_stok > 0 && $inokulasi->bibit->status === 'Habis') {
                $inokulasi->bibit->status = 'Aktif/Siap Pakai';
            }
            $inokulasi->bibit->save();
        }

        $inokulasi->delete();

        return redirect()->route('inokulasi.index')->with('success', 'Data inokulasi berhasil dihapus.');
    }
}

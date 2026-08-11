<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Ketua\KetuaDashboardController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\ProductionReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Umum / Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/', [CatalogController::class, 'publicIndex'])->name('welcome');
Route::get('/profile-kups', [CatalogController::class, 'publicProfile'])->name('public.profile-kups');

/*
|--------------------------------------------------------------------------
| 2. FALLBACK DASHBOARD UTAMA BREEZE
|--------------------------------------------------------------------------
| Jika user login mengakses /dashboard, sistem otomatis mengarahkan
| ke dashboard yang sesuai dengan rolenya masing-masing.
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isPetugas()) {
        return redirect()->route('petugas.dashboard');
    } elseif ($user->isKetua()) {
        return redirect()->route('ketua.dashboard');
    }
    abort(403, 'Role tidak dikenali.');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| 3. RUTE GRUP PETUGAS (Protected: Auth & Role: petugas)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas,admin'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::post('/peringatan/{id}/resolve', [PetugasDashboardController::class, 'resolvePeringatan'])->name('peringatan.resolve');
    Route::resource('laporan-panen', ProductionReportController::class);
});

/*
|--------------------------------------------------------------------------
| 4. RUTE GRUP KETUA KUPS (Protected: Auth & Role: ketua, admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:ketua,admin'])->prefix('ketua')->name('ketua.')->group(function () {
    Route::get('/dashboard', [KetuaDashboardController::class, 'index'])->name('dashboard');
    // Laporan Ketua: halaman indeks + preview + eksport
    Route::get('/reports', [KetuaDashboardController::class, 'reports'])->name('reports.index');
    Route::get('/reports/print', [KetuaDashboardController::class, 'printable'])->name('reports.print');
    Route::get('/reports/export-pdf', [KetuaDashboardController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/export-excel', [KetuaDashboardController::class, 'exportExcel'])->name('reports.export.excel');
    
    // RUTE PANTAU STOK BIBIT (Ketua)
    Route::get('/pantau-stok-bibit', [KetuaDashboardController::class, 'pantauStokBibit'])->name('bibit.pantau');
    
    // RUTE VERIFIKASI DATA PETUGAS (Ketua)
    Route::get('/verifikasi', [KetuaDashboardController::class, 'verifikasiIndex'])->name('verifikasi.index');
    Route::post('/verifikasi/{id}', [KetuaDashboardController::class, 'validateReport'])->name('verifikasi.process');
});

/*
|--------------------------------------------------------------------------
| 5. RUTE GRUP ADMIN (Protected: Auth & Role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/production-reports/{report}/validate', [AdminDashboardController::class, 'validateReport'])->name('reports.validate');
    Route::resource('users', UserController::class)->except(['show']);

    // Manajemen Katalog Produk oleh Admin
    Route::resource('catalogs', CatalogController::class)->except(['show']);

    // Manajemen Kelola Profile KUPS oleh Admin
    Route::get('/profile-kups', [App\Http\Controllers\Admin\ProfileKupsController::class, 'index'])->name('profile-kups.index');
    Route::post('/profile-kups', [App\Http\Controllers\Admin\ProfileKupsController::class, 'update'])->name('profile-kups.update');

    // Rute Konfirmasi dan Pantau Stok Bibit
    Route::get('/pantau-stok-bibit', [AdminDashboardController::class, 'pantauStokBibit'])->name('bibit.pantau');
    Route::post('/bibit/{id}/konfirmasi', [AdminDashboardController::class, 'konfirmasiBibit'])->name('bibit.konfirmasi');
    Route::post('/bibit/{id}/tambah-stok', [AdminDashboardController::class, 'tambahStokBibit'])->name('bibit.tambah-stok');

});

Route::middleware(['auth'])->group(function () {

    // RUTE BARU UNTUK BIBIT (Admin & Ketua)
    Route::middleware(['role:admin,ketua'])->group(function () {
        Route::resource('bibit', \App\Http\Controllers\BibitController::class)->except(['show']);
    });

    // RUTE BARU UNTUK MODUL HULU & TENGAH
    Route::resource('sterilisasi', \App\Http\Controllers\SterilisasiController::class)->except(['show']);
    Route::post('/sterilisasi/{id}/kukus-ulang', [\App\Http\Controllers\SterilisasiController::class, 'kukusUlang'])->name('sterilisasi.kukus-ulang');
    Route::resource('inokulasi', \App\Http\Controllers\InokulasiController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::post('/inokulasi/{id}/log-inkubasi', [\App\Http\Controllers\InokulasiController::class, 'storeLog'])->name('inokulasi.store-log');
    Route::resource('monitoring', \App\Http\Controllers\MonitoringKumbungController::class)->only(['index', 'create', 'store']);

    // RUTE RENDANG JAMUR (Khusus panen yang buruk/layu)
    Route::get('/alokasi-rendang', function(\Illuminate\Http\Request $request) {
        $query = \App\Models\ProductionReport::where('berat_grade_b', '>', 0);
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($uq) use ($search) {
                    $uq->where('name', 'LIKE', "%{$search}%");
                });
            });
        }
        
        if ($request->filled('date')) {
            $query->whereDate('tanggal', $request->date);
        }
        
        $panenBuruk = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('petugas.rendang.index', compact('panenBuruk'));
    })->name('rendang.index');

    // RUTE SETTINGS EWS ADMIN
    Route::get('/admin/ews-settings', [\App\Http\Controllers\Admin\EwsSettingController::class, 'index'])->name('admin.ews.settings');
    Route::post('/admin/ews-settings', [\App\Http\Controllers\Admin\EwsSettingController::class, 'update'])->name('admin.ews.settings.update');
});


/*
|--------------------------------------------------------------------------
| 6. PROFILE ROUTES (Breeze Default)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

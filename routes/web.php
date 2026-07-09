<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BaglogController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\JadwalPanenController;
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
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::resource('laporan-panen', ProductionReportController::class);
});

/*
|--------------------------------------------------------------------------
| 4. RUTE GRUP KETUA KUPS (Protected: Auth & Role: ketua)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:ketua'])->prefix('ketua')->name('ketua.')->group(function () {
    Route::get('/dashboard', [KetuaDashboardController::class, 'index'])->name('dashboard');
    // Laporan Ketua: halaman indeks + preview + eksport
    Route::get('/reports', [KetuaDashboardController::class, 'reports'])->name('reports.index');
    Route::get('/reports/print', [KetuaDashboardController::class, 'printable'])->name('reports.print');
    Route::get('/reports/export-pdf', [KetuaDashboardController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/export-excel', [KetuaDashboardController::class, 'exportExcel'])->name('reports.export.excel');
    
    // Manajemen Katalog Produk oleh Ketua KUPS
    Route::resource('catalogs', CatalogController::class)->except(['show']);

    // RUTE TRACEABILITY KETUA KUPS
    Route::get('/traceability', [KetuaDashboardController::class, 'traceabilityIndex'])->name('traceability.index');
    Route::get('/traceability/{id}', [KetuaDashboardController::class, 'lacakBatch'])->name('traceability.detail');
    
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
});

    // RUTE BARU UNTUK BIBIT
    Route::resource('bibit', \App\Http\Controllers\BibitController::class)->only(['index', 'create', 'store']);

    // RUTE BARU UNTUK BAGLOG
    Route::get('/baglog', [BaglogController::class, 'index'])->name('baglog.index');
    Route::get('/baglog/create', [BaglogController::class, 'create'])->name('baglog.create');
    Route::post('/baglog', [BaglogController::class, 'store'])->name('baglog.store');
    Route::post('/baglog/{id}/validate', [BaglogController::class, 'validateBaglog'])->name('baglog.validate');

    // RUTE BARU UNTUK MODUL HULU & TENGAH
    Route::resource('sterilisasi', \App\Http\Controllers\SterilisasiController::class)->only(['index', 'create', 'store']);
    Route::resource('inokulasi', \App\Http\Controllers\InokulasiController::class)->only(['index', 'create', 'store']);
    Route::resource('monitoring', \App\Http\Controllers\MonitoringKumbungController::class)->only(['index', 'create', 'store']);

    // RUTE RENDANG JAMUR (Khusus panen yang buruk/layu)
    Route::get('/alokasi-rendang', function() {
        $panenBuruk = \App\Models\ProductionReport::where('status_distribusi', 'Pengolahan Kuliner Rendang')
                        ->orderBy('tanggal', 'desc')->get();
        return view('petugas.rendang.index', compact('panenBuruk'));
    })->name('rendang.index');

    // RUTE SETTINGS EWS ADMIN
    Route::get('/admin/ews-settings', [\App\Http\Controllers\Admin\EwsSettingController::class, 'index'])->name('admin.ews.settings');
    Route::post('/admin/ews-settings', [\App\Http\Controllers\Admin\EwsSettingController::class, 'update'])->name('admin.ews.settings.update');

    // RUTE BARU UNTUK JADWAL PANEN
    Route::get('/jadwal-panen', [JadwalPanenController::class, 'index'])->name('jadwal-panen.index');
    Route::get('/jadwal-panen/create', [JadwalPanenController::class, 'create'])->name('jadwal-panen.create');
    Route::post('/jadwal-panen', [JadwalPanenController::class, 'store'])->name('jadwal-panen.store');
    Route::get('/jadwal-panen/{id}/edit', [JadwalPanenController::class, 'edit'])->name('jadwal-panen.edit');
    Route::put('/jadwal-panen/{id}', [JadwalPanenController::class, 'update'])->name('jadwal-panen.update');
    Route::delete('/jadwal-panen/{id}', [JadwalPanenController::class, 'destroy'])->name('jadwal-panen.destroy');


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

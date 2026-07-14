<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\ProductionReport;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===========================================================
        // 1. AKUN PENGGUNA KUPS HARAPAN ASRI
        // ===========================================================

        $admin = User::create([
            'name'     => 'Administrator KUPS',
            'email'    => 'admin@kups.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        $petugas = User::create([
            'name'     => 'Budi Santoso (Petugas)',
            'email'    => 'petugas@kups.com',
            'password' => Hash::make('password123'),
            'role'     => 'petugas',
        ]);

        $ketua = User::create([
            'name'     => 'H. Slamet (Ketua KUPS)',
            'email'    => 'ketua@kups.com',
            'password' => Hash::make('password123'),
            'role'     => 'ketua',
        ]);

        // ===========================================================
        // 2. KATALOG PRODUK PUBLIK
        // ===========================================================

        Catalog::create([
            'name'        => 'Jamur Tiram Putih Segar (Grade A)',
            'description' => 'Jamur tiram segar kualitas terbaik hasil budidaya organik KUPS Harapan Asri. Dipanen langsung dari kumbung setiap hari untuk menjamin kesegaran.',
            'price'       => 15000.00,
            'image'       => null,
        ]);

        Catalog::create([
            'name'        => 'Baglog Jamur Tiram Siap Tumbuh',
            'description' => 'Media tanam jamur (baglog) dengan miselium kualitas prima, siap tumbuh dan dibudidayakan sendiri di rumah Anda dengan mudah.',
            'price'       => 3500.00,
            'image'       => null,
        ]);

        Catalog::create([
            'name'        => 'Kripik Jamur Tiram Harapan Asri',
            'description' => 'Camilan sehat kripik jamur tiram renyah dengan rasa gurih alami. Tanpa bahan pengawet, cocok untuk oleh-oleh khas daerah.',
            'price'       => 10000.00,
            'image'       => null,
        ]);

        // ===========================================================
        // 3. DATA LAPORAN PRODUKSI (TRACEABILITY CHAIN)
        // ===========================================================

        $bibit = \App\Models\Bibit::create([
            'user_id' => $ketua->id,
            'kode_bibit' => 'BBT-001',
            'asal_bibit' => 'Supplier Bibit Harapan',
            'tanggal_masuk' => now()->subMonths(7)->format('Y-m-d'),
            'jumlah' => 100,
            'sisa_stok' => 95,
            'status' => 'Aktif/Siap Pakai',
        ]);

        $baglog = \App\Models\Baglog::create([
            'user_id' => $petugas->id,
            'kode_batch' => 'BGL-001',
            'tanggal_pembuatan' => now()->subMonths(7)->addDays(2)->format('Y-m-d'),
            'jumlah_baglog' => 500,
            'status_validasi' => 'valid',
        ]);

        $sterilisasi = \App\Models\Sterilisasi::create([
            'baglog_id' => $baglog->id,
            'user_id' => $petugas->id,
            'tanggal' => now()->subMonths(7)->addDays(4)->format('Y-m-d'),
            'durasi_pengukusan' => 8,
            'kondisi_air' => 'Aman',
            'kestabilan_api' => 'Stabil-Besar',
            'status_sterilisasi' => 'aman',
        ]);

        $inokulasi = \App\Models\Inokulasi::create([
            'sterilisasi_id' => $sterilisasi->id,
            'bibit_id' => $bibit->id,
            'user_id' => $petugas->id,
            'tanggal' => now()->subMonths(7)->addDays(6)->format('Y-m-d'),
            'jumlah_berhasil' => 490,
            'jumlah_kontaminasi' => 10,
            'jumlah_bibit_terpakai' => 5,
        ]);

        \App\Models\MonitoringKumbung::create([
            'inokulasi_id' => $inokulasi->id,
            'user_id' => $petugas->id,
            'tanggal' => now()->subMonths(6)->format('Y-m-d'),
            'kondisi_udara' => 'Sejuk',
            'kondisi_lantai' => 'Basah/Lembab',
            'jumlah_penyiraman' => 2,
        ]);

        ProductionReport::create([
            'inokulasi_id'    => $inokulasi->id,
            'user_id'         => $petugas->id,
            'tanggal'         => now()->subDays(5)->format('Y-m-d'),
            'siklus_panen'    => 1,
            'berat_grade_a'   => 12.5,
            'berat_grade_b'   => 2.5,
            'jumlah_panen'    => 15.0,
            'status_validasi' => 'valid',
            'catatan'         => 'Panen pertama berjalan lancar',
            'validated_by'    => $admin->id,
        ]);

        ProductionReport::create([
            'inokulasi_id'    => $inokulasi->id,
            'user_id'         => $petugas->id,
            'tanggal'         => now()->subDays(2)->format('Y-m-d'),
            'siklus_panen'    => 2,
            'berat_grade_a'   => 15.0,
            'berat_grade_b'   => 3.0,
            'jumlah_panen'    => 18.0,
            'status_validasi' => 'valid',
            'catatan'         => 'Ukuran jamur sangat baik',
            'validated_by'    => $admin->id,
        ]);

        ProductionReport::create([
            'inokulasi_id'    => $inokulasi->id,
            'user_id'         => $petugas->id,
            'tanggal'         => now()->format('Y-m-d'),
            'siklus_panen'    => 3,
            'berat_grade_a'   => 10.0,
            'berat_grade_b'   => 2.0,
            'jumlah_panen'    => 12.0,
            'status_validasi' => 'pending',
            'catatan'         => 'Panen pagi hari, masih menunggu validasi',
            'validated_by'    => null,
        ]);
    }
}

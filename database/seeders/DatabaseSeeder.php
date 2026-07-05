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

        User::create([
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
        // 3. DATA LAPORAN PRODUKSI MOCK (6 BULAN TERAKHIR)
        // Data ini memungkinkan grafik Ketua KUPS langsung terisi.
        // ===========================================================

        $now = now();
        for ($i = 5; $i >= 0; $i--) {
            // Iterasi 6 bulan ke belakang dari sekarang
            $monthDate = (clone $now)->subMonths($i);

            // Buat beberapa entri panen per bulan (setiap 5 hari)
            for ($day = 5; $day <= 25; $day += 5) {
                // Hindari tanggal yang melebihi hari ini
                $reportDate = $monthDate->copy()->setDay($day);
                if ($reportDate->isFuture()) {
                    break;
                }

                $jumlahPanen = rand(15, 35) + (rand(0, 9) / 10);

                ProductionReport::create([
                    'user_id'         => $petugas->id,
                    'tanggal'         => $reportDate->format('Y-m-d'),
                    'jumlah_panen'    => $jumlahPanen,
                    'kondisi'         => 'Bagus',
                    'status_validasi' => 'valid',  // Set valid agar langsung masuk ke grafik Ketua
                    'catatan'         => 'Kumbung A panen baik, suhu terjaga 26°C',
                    'validated_by'    => $admin->id,
                ]);
            }
        }

        // Tambah 2 laporan pending untuk uji coba dashboard validasi Admin
        ProductionReport::create([
            'user_id'         => $petugas->id,
            'tanggal'         => now()->format('Y-m-d'),
            'jumlah_panen'    => 18.5,
            'kondisi'         => 'Bagus',
            'status_validasi' => 'pending',
            'catatan'         => 'Panen pagi hari, kondisi sangat baik',
            'validated_by'    => null,
        ]);

        ProductionReport::create([
            'user_id'         => $petugas->id,
            'tanggal'         => now()->subDay()->format('Y-m-d'),
            'jumlah_panen'    => 12.0,
            'kondisi'         => 'Cukup',
            'status_validasi' => 'pending',
            'catatan'         => 'Kelembaban kurang optimal kemarin',
            'validated_by'    => null,
        ]);
    }
}

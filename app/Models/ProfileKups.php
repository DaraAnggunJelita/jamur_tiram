<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileKups extends Model
{
    use HasFactory;

    protected $table = 'profile_kups';

    protected $guarded = ['id'];

    /**
     * Mengambil data profil KUPS tunggal (singleton). 
     * Jika belum ada, maka buat data default secara otomatis.
     */
    public static function getProfile(): self
    {
        return self::firstOrCreate([], [
            'nama_kups' => 'KUPS Harapan Asri',
            'sub_judul' => 'Nagari Sijunjung',
            'deskripsi_singkat' => 'Produsen jamur tiram organik dari Nagari Sijunjung. Dibudidayakan secara alami oleh perempuan petani dengan standar mutu yang terdigitalisasi.',
            'tentang_kami' => 'KUPS Harapan Asri adalah kelompok usaha perhutanan sosial di bawah naungan LPHN Nagari Sijunjung yang bergerak di bidang budidaya jamur tiram organik. Seluruh anggota adalah perempuan yang terlatih menjalankan proses produksi secara mandiri dan terdata.',
            'visi' => 'Menjadi pusat percontohan budidaya jamur tiram organik berlandaskan pemberdayaan perempuan dan kelestraian hutan sosial yang inovatif dan mandiri.',
            'misi' => "1. Meningkatkan kesejahteraan anggota melalui produksi jamur tiram berkualitas tinggi.\n2. Menerapkan sistem pertanian organik tanpa bahan kimia berbahaya.\n3. Memanfaatkan teknologi digital untuk pelacakan (traceability) dan pemantauan lingkungan kumbung.\n4. Menjaga kelestrarian lingkungan dan hutan sosial.",
            'jumlah_anggota' => 15,
            'siklus_panen' => 5,
            'tahun_berdiri' => 2021,
            'alamat' => 'Nagari Sijunjung, Kec. Sijunjung, Kab. Sijunjung, Sumatera Barat',
            'nomor_telepon' => '+62 812-3456-7890',
            'email' => 'info@kupsharapanasri.com',
        ]);
    }
}

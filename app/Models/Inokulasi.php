<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inokulasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'sterilisasi_id',
        'bibit_id',
        'user_id',
        'tanggal',
        'jumlah_berhasil',
        'jumlah_kontaminasi',
        'jumlah_bibit_terpakai',
        'status_buka_kapas',
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }

    public function sterilisasi()
    {
        return $this->belongsTo(Sterilisasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function monitoringKumbungs()
    {
        return $this->hasMany(MonitoringKumbung::class);
    }

    public function productionReports()
    {
        return $this->hasMany(ProductionReport::class);
    }

    public function logInkubasis()
    {
        return $this->hasMany(LogInkubasi::class);
    }
}

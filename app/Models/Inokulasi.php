<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inokulasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'sterilisasi_id',
        'user_id',
        'tanggal',
        'jumlah_berhasil',
        'jumlah_kontaminasi',
    ];

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
}

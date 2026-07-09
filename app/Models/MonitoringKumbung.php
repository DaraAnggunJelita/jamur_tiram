<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringKumbung extends Model
{
    use HasFactory;

    protected $fillable = [
        'inokulasi_id',
        'user_id',
        'tanggal',
        'kondisi_udara',
        'kondisi_lantai',
        'jumlah_penyiraman',
    ];

    public function inokulasi()
    {
        return $this->belongsTo(Inokulasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

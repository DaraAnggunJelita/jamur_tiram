<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sterilisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'baglog_id',
        'user_id',
        'tanggal',
        'durasi_pengukusan',
        'kondisi_air',
        'kestabilan_api',
        'status_sterilisasi',
    ];

    public function baglog()
    {
        return $this->belongsTo(Baglog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inokulasis()
    {
        return $this->hasMany(Inokulasi::class);
    }
}

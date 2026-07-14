<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogInkubasi extends Model
{
    protected $fillable = [
        'inokulasi_id',
        'user_id',
        'persentase_tumbuh',
        'catatan',
        'tanggal_catat',
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

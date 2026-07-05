<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baglog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jumlah_baglog_aktif',
        'kondisi_kumbung',
        'status_validasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

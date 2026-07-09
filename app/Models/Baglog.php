<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baglog extends Model
{
    use HasFactory;

    protected $fillable = [
        'bibit_id',
        'user_id',
        'kode_batch',
        'tanggal_pembuatan',
        'jumlah_baglog',
        'status_validasi',
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sterilisasis()
    {
        return $this->hasMany(Sterilisasi::class);
    }
}

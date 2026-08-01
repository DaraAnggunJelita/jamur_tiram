<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_bibit',
        'asal_bibit',
        'tanggal_masuk',
        'jumlah',
        'sisa_stok',
        'banyak_baglog',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sterilisasis()
    {
        return $this->hasMany(Sterilisasi::class);
    }

    public function inokulasis()
    {
        return $this->hasMany(Inokulasi::class);
    }
}

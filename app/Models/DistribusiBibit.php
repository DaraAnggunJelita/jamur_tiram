<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiBibit extends Model
{
    use HasFactory;

    protected $fillable = [
        'bibit_id',
        'user_id',
        'admin_id',
        'tanggal_distribusi',
        'jumlah_dibagikan',
        'sisa_stok',
        'catatan',
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function inokulasis()
    {
        return $this->hasMany(Inokulasi::class, 'distribusi_bibit_id');
    }
}

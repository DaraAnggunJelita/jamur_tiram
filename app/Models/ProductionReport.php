<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'inokulasi_id',
        'user_id',
        'tanggal',
        'jumlah_panen',
        'kualitas_panen',
        'status_distribusi',
        'status_validasi',
        'catatan',
        'validated_by',
    ];

    public function inokulasi()
    {
        return $this->belongsTo(Inokulasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}

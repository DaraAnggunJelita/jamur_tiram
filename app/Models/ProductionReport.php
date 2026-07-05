<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionReport extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'jumlah_panen',
        'kondisi',
        'status_validasi',
        'catatan',
        'validated_by'
    ];

    /**
     * Relasi ke User (Petugas yang menginput laporan)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke User Admin (Admin yang memvalidasi laporan)
     */
    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peringatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'referensi_id',
        'level',
        'pesan',
        'is_read',
    ];

    public function getReferensiAttribute()
    {
        if ($this->kategori === 'Sterilisasi') {
            return Sterilisasi::find($this->referensi_id);
        } elseif ($this->kategori === 'Kumbung') {
            return MonitoringKumbung::find($this->referensi_id);
        }
        return null;
    }
}

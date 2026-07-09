<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EwsSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_durasi_sterilisasi',
        'maks_hari_panen',
        'kondisi_udara_kritis',
    ];
}

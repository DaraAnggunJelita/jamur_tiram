<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EwsSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'maks_hari_panen',
        'kondisi_udara_kritis',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPanen extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_estimasi',
        'catatan'
    ];
}

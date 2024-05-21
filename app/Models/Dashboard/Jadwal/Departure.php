<?php

namespace App\Models\Dashboard\Jadwal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_maskapai', 'id_penerbangan', 'tujuan', 'waktu_berangkat'
    ];
}

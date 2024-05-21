<?php

namespace App\Models\Dashboard\Laporan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keterangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'keterangan',
        'bulan',
        'id_periode',
    ];

    public function periode() : BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }
}

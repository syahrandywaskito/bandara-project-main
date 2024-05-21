<?php

namespace App\Models\Dashboard\Laporan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peralatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peralatan',
        'nama_personil',
        'point',
        'keterangan',
    ];

    public function perode() : HasMany
    {
        return $this->hasMany(Periode::class);
    }
}

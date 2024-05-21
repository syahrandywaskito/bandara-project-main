<?php

namespace App\Models\Dashboard\Laporan;

use App\Models\Admin\Laporan\Kegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_periode',
        'id_peralatan',
    ];

    public function peralatan() : BelongsTo
    {
        return $this->belongsTo(Peralatan::class);
    }

    public function kegiatan() : HasMany
    {
        return $this->hasMany(Kegiatan::class);
    }
}

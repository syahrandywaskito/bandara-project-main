<?php

namespace App\Models\Dashboard\Laporan;

use App\Models\Admin\Laporan\Kegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_detail_kegiatan',
        'id_kegiatan',
    ];

    public function kegiatan() : BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function inputLaporan() : HasMany
    {
        return $this->hasMany(InputLaporan::class);
    }
}

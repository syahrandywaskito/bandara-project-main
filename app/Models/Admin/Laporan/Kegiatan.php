<?php

namespace App\Models\Admin\Laporan;

use App\Models\Dashboard\Laporan\DetailKegiatan;
use App\Models\Dashboard\Laporan\InputLaporan;
use App\Models\Dashboard\Laporan\Periode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'id_periode',
    ];

    public function periode() : BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function detailKegiatan() : HasMany
    {
        return $this->hasMany(DetailKegiatan::class);
    }

    public function inputLaporan() : HasMany
    {
        return $this->hasMany(InputLaporan::class);
    }
}

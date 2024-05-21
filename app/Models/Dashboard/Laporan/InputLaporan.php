<?php

namespace App\Models\Dashboard\Laporan;

use App\Models\Admin\Laporan\Kegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputLaporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kondisi', 
        'tanggal_laporan',
        'id_kegiatan',
        'id_detail_kegiatan',
    ];

    public function kegiatan() : BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function detailKegiatan() : BelongsTo
    {
        return $this->belongsTo(DetailKegiatan::class);
    }
}

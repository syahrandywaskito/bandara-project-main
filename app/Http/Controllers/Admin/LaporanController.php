<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Laporan\Kegiatan;
use App\Models\Dashboard\Laporan\DetailKegiatan;
use App\Models\Dashboard\Laporan\InputLaporan;
use App\Models\Dashboard\Laporan\Keterangan;
use App\Models\Dashboard\Laporan\Peralatan;
use App\Models\Dashboard\Laporan\Periode;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() : View
    {
        $peralatans = Peralatan::get();
        
        return view('admin.laporan.index', [
            'peralatans' => $peralatans,
        ]);
    }

    public function search(Request $request) : View
    {
        $request->validate([
            'kolom' => 'required',
            'cari' => 'required',
        ]);

        $peralatans = Peralatan::where($request->kolom, 'like', "%$request->cari%")->get();
        
        return view('admin.laporan.index', [
            'peralatans' => $peralatans,
        ]);
    }

    public function HalamanPeralatan() : View
    {
        $peralatans = Peralatan::get();

        return view('laporan.index', [
            'peralatans' => $peralatans
        ]);
    }

    public function halamanBulan(Peralatan $peralatan) : View
    {
        return view('laporan.pemilihan-bulan', [
            'peralatan' => $peralatan,
        ]);
    }

    public function download(Request $request, Peralatan $peralatan) : View
    {
        $periodes = Periode::where('id_peralatan', $peralatan->id)->get();

        $date = Carbon::parse($request->bulan)->format('Y-m');
        $kalender = CAL_GREGORIAN;
        $bulan = Carbon::parse($date)->format('m');
        $tahun = Carbon::parse($date)->format('Y');
        $jumlah_hari = cal_days_in_month($kalender, $bulan, $tahun);

        $format_bulan = Carbon::parse($date)->isoFormat('MMMM');
        $format_tahun = Carbon::parse($date)->isoFormat('Y');

        $KEGIATAN = new Kegiatan;
        $DETAIL_KEGIATAN = new DetailKegiatan;
        $INPUT_LAPORAN = new InputLaporan;
        $KETERANGAN = new Keterangan;

        return view('laporan.laporan', [
            'peralatan' => $peralatan,
            'periodes' => $periodes,
            'date' => $date,
            'format_bulan' => $format_bulan,
            'format_tahun' => $format_tahun,
            'jumlah_hari' => $jumlah_hari,
            'KEGIATAN' => $KEGIATAN,
            'INPUT_LAPORAN' => $INPUT_LAPORAN,
            'DETAIL_KEGIATAN' => $DETAIL_KEGIATAN,
            'KETERANGAN' => $KETERANGAN,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Laporan\Kegiatan;
use App\Models\Dashboard\Laporan\DetailKegiatan;
use App\Models\Dashboard\Laporan\InputLaporan;
use App\Models\Dashboard\Laporan\Keterangan;
use App\Models\Dashboard\Laporan\Peralatan;
use App\Models\Dashboard\Laporan\Periode;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function index(Request $request, Peralatan $peralatan) : View
    {
        $periodes = Periode::where('id_peralatan', $peralatan->id)->get();

        $date = Carbon::parse($request->date)->format('Y-m');
        $format_month = Carbon::parse($request->date)->isoFormat('MMMM Y');

        $kalender = CAL_GREGORIAN;
        $bulan = Carbon::parse($date)->format('m');
        $tahun = Carbon::parse($date)->format('Y');
        $jumlah_hari = cal_days_in_month($kalender, $bulan, $tahun);

        // object
        $KEGIATAN = new Kegiatan;
        $INPUT_LAPORAN = new InputLaporan;
        $DETAIL_KEGIATAN = new DetailKegiatan;
        $KETERANGAN = new Keterangan;

        return view('admin.laporan.input.index', [
            'peralatan' => $peralatan,
            'periodes' => $periodes,
            'KEGIATAN' => $KEGIATAN,
            'INPUT_LAPORAN' => $INPUT_LAPORAN,
            'DETAIL_KEGIATAN' => $DETAIL_KEGIATAN,
            'KETERANGAN' => $KETERANGAN,
            'jumlah_hari' => $jumlah_hari,
            'date' => $date,
            'format_month' => $format_month,
        ]);
    }

    public function create(Peralatan $peralatan, $tanggal) : View
    {
        $formated_tanggal = Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y');

        $periodes = Periode::where('id_peralatan', $peralatan->id)->get();

        $jadwal_mingguan = [1, 8, 15, 22, 29];

        $tanggal_array = explode('-', $tanggal);
        $tanggal_int = (int)$tanggal_array[2]; 

        $KEGIATAN = new Kegiatan;
        $INPUT_LAPORAN = new InputLaporan;
        $DETAIL_KEGIATAN = new DetailKegiatan;

        return view('admin.laporan.input.create', [
            'tanggal' => $tanggal,
            'formated_tanggal' => $formated_tanggal,
            'peralatan' => $peralatan,
            'periodes' => $periodes,
            'jadwal_mingguan' => $jadwal_mingguan,
            'tanggal_int' => $tanggal_int,
            'KEGIATAN' => $KEGIATAN,
            'INPUT_LAPORAN' => $INPUT_LAPORAN,
            'DETAIL_KEGIATAN' => $DETAIL_KEGIATAN,
        ]);
    }

    public function store(Request $request, Peralatan $peralatan, $tanggal) : RedirectResponse
    {
        $id_kegiatan = $request->id_kegiatan;
        $id_detail = $request->id_detail;
        $kondisi_kegiatan = $request->kondisi_kegiatan;
        $kondisi_detail = $request->kondisi_detail;

        if (isset($id_kegiatan)) {
            foreach ($id_kegiatan as $key => $value_id_kegiatan) {
                InputLaporan::create([
                    'id_kegiatan' => $value_id_kegiatan,
                    'kondisi' => $kondisi_kegiatan[$key],
                    'tanggal_laporan' => $tanggal,
                ]);
            }
        }

        if (isset($id_detail)) {
            foreach ($id_detail as $key => $value_id_detail) {
                InputLaporan::create([
                    'id_detail_kegiatan' => $value_id_detail,
                    'kondisi' => $kondisi_detail[$key],
                    'tanggal_laporan' => $tanggal,
                ]);
            }
        }

        return redirect()->route('input.index', $peralatan->id);
    }

    public function edit(Peralatan $peralatan, InputLaporan $inputLaporan) : View
    {
        $format_tanggal = Carbon::parse($inputLaporan->tanggal_laporan)->isoFormat('dddd, D MMMM Y');

        $kegiatan = '';
        $detail_kegiatan = '';

        if (isset($inputLaporan->id_kegiatan)) {
            $kegiatan = Kegiatan::where('id', $inputLaporan->id_kegiatan)->first();
        }

        if(isset($inputLaporan->id_detail_kegiatan)){
            $detail_kegiatan = DetailKegiatan::where('id', $inputLaporan->id_detail_kegiatan)->first();
            $kegiatan = Kegiatan::where('id', $detail_kegiatan->id_kegiatan)->first();
        }
        else {
            $detail_kegiatan = null;
        }

        return view('admin.laporan.input.edit', [
            'peralatan' => $peralatan,
            'inputLaporan' => $inputLaporan,
            'tanggal' => $format_tanggal,
            'kegiatan' => $kegiatan,
            'detail_kegiatan' => $detail_kegiatan,
        ]);
    }

    public function update(Request $request, Peralatan $peralatan, InputLaporan $inputLaporan) : RedirectResponse
    {
        $request->validate([
            'kondisi' => ['required'],
        ]);

        $inputLaporan->update([
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('input.index', $peralatan->id);
    }

    public function destroy(Peralatan $peralatan, InputLaporan $inputLaporan) : RedirectResponse
    {
        $inputLaporan->delete();
        
        return redirect()->route('input.index', $peralatan->id);
    }
}





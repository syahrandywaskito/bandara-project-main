<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Laporan\Keterangan;
use App\Models\Dashboard\Laporan\Peralatan;
use App\Models\Dashboard\Laporan\Periode;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KeteranganController extends Controller
{
    public function create(Peralatan $peralatan, $tanggal) : View
    {
        $periodes = Periode::where('id_peralatan', $peralatan->id)->get();
        
        $bulan = Carbon::parse($tanggal)->format('Y-m-d');

        $format_bulan = Carbon::parse($bulan)->isoFormat('MMMM Y');

        return view('admin.laporan.keterangan.create', [
            'peralatan' => $peralatan,
            'bulan' => $bulan,
            'format_bulan' => $format_bulan,
            'periodes' => $periodes,
        ]);
    }

    public function store(Request $request, Peralatan $peralatan, $tanggal) : RedirectResponse
    {
        $request->validate([
            'keterangan' => ['required','string'],
            'id_periode' => ['required'],
        ]);

        Keterangan::create([
            'keterangan' => $request->keterangan,
            'id_periode' => $request->id_periode,
            'bulan' => $tanggal,
        ]);

        return redirect()->route('input.index', $peralatan->id);
    }

    public function edit(Peralatan $peralatan, Keterangan $keterangan) : View
    {
        $periode = Periode::where('id', $keterangan->id_periode)->first();

        return view('admin.laporan.keterangan.edit', [
            'peralatan' => $peralatan,
            'keterangan' => $keterangan,
            'periode' => $periode,
        ]);
    }

    public function update(Request $request, Peralatan $peralatan, Keterangan $keterangan) : RedirectResponse
    {
        $request->validate([
            'keterangan' => ['required', 'string'],
        ]);

        $keterangan->update([
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('input.index', $peralatan->id);
    }

    public function destroy(Peralatan $peralatan, Keterangan $keterangan) : RedirectResponse
    {   
        $keterangan->delete();

        return redirect()->route('input.index', $peralatan->id);
    }
}

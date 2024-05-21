<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Laporan\Kegiatan;
use App\Models\Dashboard\Laporan\DetailKegiatan;
use App\Models\Dashboard\Laporan\Peralatan;
use App\Models\Dashboard\Laporan\Periode;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Peralatan $peralatan, Kegiatan $kegiatan) : View
    { 
        $periode = Periode::where('id', $kegiatan->id_periode)->first();

        $details = DetailKegiatan::where('id_kegiatan', $kegiatan->id)->get();

        return view('admin.laporan.detail.index', [
            'peralatan' => $peralatan,
            'kegiatan'  => $kegiatan,
            'periode' => $periode,
            'details' => $details,
        ]);
    }

    public function create(Peralatan $peralatan, Kegiatan $kegiatan) : View
    {
        $periode = Periode::where('id', $kegiatan->id_periode)->first();

        return view('admin.laporan.detail.create', [
            'peralatan' => $peralatan,
            'kegiatan' => $kegiatan,
            'periode' => $periode,
        ]);
    }

    public function store(Request $request, Peralatan $peralatan, Kegiatan $kegiatan) : RedirectResponse
    {
        $request->validate([
            'nama_detail_kegiatan' => ['required', 'string'],
        ],
        [
            'nama_detail_kegiatan.required' => 'Nama Detail Kegiatan harus diisi',
            'nama_detail_kegiatan.string' => 'Nama Detail Kegiatan harus alfanumerik bukan hanya angka',
        ]);

        DetailKegiatan::create([
            'nama_detail_kegiatan' => $request->nama_detail_kegiatan,
            'id_kegiatan' => $kegiatan->id,
        ]);

        return redirect()->route('detail.index', [$peralatan, $kegiatan->id]);
    }

    public function edit(Peralatan $peralatan, Kegiatan $kegiatan, DetailKegiatan $detail) : View
    {
        $periode = Periode::where('id', $kegiatan->id_periode)->first();

        return view('admin.laporan.detail.edit', [
            'peralatan' =>  $peralatan,
            'periode' => $periode,
            'detail' => $detail,
            'kegiatan' => $kegiatan,
        ]);
    }

    public function update(Request $request, Peralatan $peralatan, Kegiatan $kegiatan, DetailKegiatan $detail) : RedirectResponse
    {
        $request->validate([
            'nama_detail_kegiatan' => ['required', 'string'],
        ],
        [
            'nama_detail_kegiatan.required' => 'Nama Detail Kegiatan harus diisi',
            'nama_detail_kegiatan.string' => 'Nama Detail Kegiatan harus alfanumerik bukan hanya angka',
        ]);

        $detail->update([
            'nama_detail_kegiatan' => $request->nama_detail_kegiatan,
        ]);

        return redirect()->route('detail.index', [$peralatan->id, $kegiatan->id]);
    }

    public function destroy(Peralatan $peralatan, Kegiatan $kegiatan, DetailKegiatan $detail) : RedirectResponse
    {
        $detail->delete();

        return redirect()->route('detail.index', [$peralatan->id, $kegiatan->id]);
    }
}

<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Laporan\Kegiatan;
use App\Models\Dashboard\Laporan\Peralatan;
use App\Models\Dashboard\Laporan\Periode;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Peralatan $peralatan) : View
    {
        $periodes = Periode::where('id_peralatan', $peralatan->id)->get();

        $object_kg = new Kegiatan;
    
        return view('admin.laporan.kegiatan.index', [
            'peralatan' => $peralatan,
            'periodes' => $periodes,
            'object_kg' => $object_kg, 
        ]); 
    }


    public function create(Peralatan $peralatan) : View
    {
        $periodes = Periode::where('id_peralatan', $peralatan->id)->get();   

        return view('admin.laporan.kegiatan.create', [
            'periodes' => $periodes,
            'peralatan' => $peralatan,
        ]);
    }

    public function store(Request $request, Peralatan $peralatan) : RedirectResponse
    {
        $request->validate([
            'nama_kegiatan' => ['required', 'string'],
            'id_periode' => ['required'],
        ],
        [
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi',
            'nama_kegiatan.string' => 'Nama Kegiatan harus alfanumerik bukan hanya angka',
        ]);

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'id_periode' => $request->id_periode,
        ]);

        return redirect()->route('kegiatan.index', $peralatan->id);
    }

    public function edit(Peralatan $peralatan, Kegiatan $kegiatan) : View
    {
        $periode = Periode::where('id', $kegiatan->id_periode)->first(); 

        return view('admin.laporan.kegiatan.edit', [
            'peralatan' => $peralatan,
            'kegiatan' => $kegiatan,
            'periode' => $periode
        ]);
    }

    public function update(Request $request, Peralatan $peralatan, Kegiatan $kegiatan) : RedirectResponse
    {
        $request->validate([
            'nama_kegiatan' => ['required', 'string'],
        ],
        [
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi',
            'nama_kegiatan.string' => 'Nama Kegiatan harus alfanumerik bukan hanya angka',
        ]);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
        ]);

        return redirect()->route('kegiatan.index', $peralatan->id);
    }

    public function destroy(Peralatan $peralatan, Kegiatan $kegiatan) : RedirectResponse
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index', $peralatan->id);
    }
}

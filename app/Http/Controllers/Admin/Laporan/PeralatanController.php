<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Laporan\Peralatan;
use App\Models\Dashboard\Laporan\Periode;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function index() : View
    {
        $peralatans = Peralatan::get();
        $object_peralatan = new PeralatanController;

        return view('admin.laporan.peralatan.index', [
            'peralatans' => $peralatans,
            'object' => $object_peralatan,
        ]);
    }

    public function create() : View
    {
        return view('admin.laporan.peralatan.create');
    }

    public function search(Request $request) : View
    {
        $kolom = $request->kolom;
        $cari = $request->cari;

        $peralatans = Peralatan::where($kolom, 'like', "%$cari%")->get();

        return view('admin.laporan.peralatan.index', ['peralatans' => $peralatans]);
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'nama_peralatan' => ['required', 'string', 'max:255'],
            'nama_personil' => ['required', 'string'],
            'point' => ['required', 'string', 'min:3'],
            'keterangan' => ['required', 'string', 'min:5'],
        ],
        [
            // * Nama Peralatan
            'nama_peralatan.required' => 'Nama peralatan harus diisi', 
            'nama_peralatan.string' => 'Nama peralatan berupa huruf bukan angka',
            'nama_peralatan.max' => 'Nama peralatan maksimal 255 karakter',
            'nama_peralatan.unique' => 'Nama peralatan tidak boleh sama dengan yang sudah ada',

            // * point
            'point.required' => 'Point harus diisi',
            'point.string' => 'Point harus berupa karakter alfanumerik bukan angka saja',
            'point.min' => 'Point minimal 3 karakter',
            
            // * keterangan
            'keterangan.required' => 'Keterangan harus diisi',
            'keterangan.string' => 'Keterangan berupa karakter alfanumerik bukan angka saja',
            'keterangan.min' => 'Keterangan minimal 5 karakter', 
        ]);

        Peralatan::create([
            'nama_peralatan'=> $request->nama_peralatan,
            'nama_personil' => $request->nama_personil,
            'point' => $request->point,
            'keterangan' => $request->keterangan,
        ]); 

        $where_peralatan = [
            'nama_peralatan' => $request->nama_peralatan,
            'nama_personil' => $request->nama_personil,
            'point' => $request->point,
            'keterangan' => $request->keterangan,
        ];

        $peralatan = Peralatan::where($where_peralatan)->first();

        $jenis_periode = ['harian', 'mingguan', 'bulanan'];

        foreach ($jenis_periode as $jenis) {
            Periode::create([
                'jenis_periode' => $jenis,
                'id_peralatan' => $peralatan->id,
            ]);
        }

        return redirect()->route('peralatan.index');
    }

    public function edit(Peralatan $peralatan) : View
    {
        return view('admin.laporan.peralatan.edit', ['peralatan' => $peralatan]);
    }

    public function update(Request $request, Peralatan $peralatan) : RedirectResponse
    {
        $request->validate([
            'nama_peralatan' => ['required', 'string', 'lowercase', 'max:255'],
            'point' => ['required', 'string', 'min:3'],
            'keterangan' => ['required', 'string', 'min:5'],
        ],
        [
            // * Nama Peralatan
            'nama_peralatan.required' => 'Nama peralatan harus diisi',
            'nama_peralatan.string' => 'Nama peralatan berupa huruf bukan angka',
            'nama_peralatan.max' => 'Nama peralatan maksimal 255 karakter',

            // * point
            'point.required' => 'Point harus diisi',
            'point.string' => 'Point harus berupa karakter alfanumerik bukan angka saja',
            'point.min' => 'Point minimal 3 karakter',

            // * keterangan
            'keterangan.required' => 'Keterangan harus diisi',
            'keterangan.string' => 'Keterangan berupa karakter alfanumerik bukan angka saja',
            'keterangan.min' => 'Keterangan minimal 5 karakter', 
        ]);

        $peralatan->update([
            'nama_peralatan' => $request->nama_peralatan,
            'point' => $request->point,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('peralatan.index');
    }

    public function destroy(Peralatan $peralatan) : RedirectResponse
    {
        $peralatan->delete();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Jadwal\Arrival;
use App\Models\Dashboard\Jadwal\Departure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    private $title;
    private $context;
    private $activity;
    private $context_value;
    private $time_value;

    public function index() : View
    {
        $departure = Departure::orderBy('waktu_berangkat', 'asc')->get();
        $arrival = Arrival::orderBy('waktu_datang', 'asc')->get();

        return view('admin.jadwal.index', [
            'departure' => $departure,
            'arrival' => $arrival,
        ]);
    }

    public function departure() : View
    {
        $this->title = "departure";
        $this->context = "tujuan";
        $this->activity = "berangkat";

        return view('admin.jadwal.create', [
            'title' => $this->title,
            'context' => $this->context,
            'activity' => $this->activity,
        ]);
    }

    public function arrival() : View
    {
        $this->title = "arrival";
        $this->context = "dari";
        $this->activity = "datang";

        return view('admin.jadwal.create', [
            'title' => $this->title,
            'context' => $this->context,
            'activity' => $this->activity,
        ]);
    }

    public function storeDeparture(Request $request) : RedirectResponse
    {
        $request->validate([
            'nama_maskapai' => 'required',
            'id_penerbangan' => 'required',
            'tujuan' => 'required',
            'waktu_berangkat' => 'required',
        ],
        [
            'nama_maskapai.required' => 'Nama maskapai harus diisi',
            'id_penerbangan.required' => 'ID Penerbangan harus diis',
            'tujuan.required' => 'Tujuan harus diisi',
            'waktu_berangkat' => 'Waktu Keberangkatan harus diisi',
        ]);

        Departure::create([
            'nama_maskapai' => $request->nama_maskapai,
            'id_penerbangan' => $request->id_penerbangan,
            'tujuan' => $request->tujuan,
            'waktu_berangkat' => $request->waktu_berangkat,
        ]);

        return redirect()->route('jadwal.index');
    }

    public function storeArrival(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_maskapai' => 'required',
            'id_penerbangan' => 'required',
            'dari' => 'required',
            'waktu_datang' => 'required',
        ],
        [
            'nama_maskapai.required' => 'Nama maskapai harus diisi',
            'id_penerbangan.required' => 'ID Penerbangan harus diis',
            'dari.required' => 'Dari harus diisi',
            'waktu_datang' => 'Waktu Kedatangan harus diisi',
        ]);

        Arrival::create([
            'nama_maskapai' => $request->nama_maskapai,
            'id_penerbangan' => $request->id_penerbangan,
            'dari' => $request->dari,
            'waktu_datang' => $request->waktu_datang,
        ]);

        return redirect()->route('jadwal.index');
    }

    public function editDeparture(Departure $departure) : View
    {
        $this->context = "tujuan";
        $this->activity = "berangkat";
        $this->title = "departure";

        $this->context_value = $departure->tujuan;
        $this->time_value = $departure->waktu_berangkat;

        return view('admin.jadwal.edit', [
            'data' => $departure,
            'context' => $this->context,
            'activity' => $this->activity,
            'context_value' => $this->context_value,
            'time_value' => $this->time_value,
            'title' => $this->title,
        ]);
    }

    public function editArrival(Arrival $arrival) : View
    {
        $this->context = "dari";
        $this->activity = "datang";
        $this->title = "arrival"; 

        $this->context_value = $arrival->dari;
        $this->time_value = $arrival->waktu_datang;

        return view('admin.jadwal.edit', [
            'data' => $arrival,
            'context' => $this->context,
            'activity' => $this->activity,
            'context_value' => $this->context_value,
            'time_value' => $this->time_value,
            'title' => $this->title,
        ]);
    }

    public function updateDeparture(Request $request, Departure $departure) : RedirectResponse
    {
        $request->validate([
            'nama_maskapai' => 'required',
            'id_penerbangan' => 'required',
            'tujuan' => 'required',
            'waktu_berangkat' => 'required',
        ],
        [
            'nama_maskapai.required' => 'Nama maskapai harus diisi',
            'id_penerbangan.required' => 'ID Penerbangan harus diis',
            'tujuan.required' => 'Tujuan harus diisi',
            'waktu_berangkat' => 'Waktu Keberangkatan harus diisi',
        ]);

        $departure->update([
            'nama_maskapai' => $request->nama_maskapai,
            'id_penerbangan' => $request->id_penerbangan,
            'tujuan' => $request->tujuan,
            'waktu_berangkat' => $request->waktu_berangkat
        ]);

        return redirect()->route('jadwal.index');
    }

    public function updateArrival(Request $request, Arrival $arrival) : RedirectResponse
    {
        $request->validate([
            'nama_maskapai' => 'required',
            'id_penerbangan' => 'required',
            'dari' => 'required',
            'waktu_datang' => 'required',
        ],
        [
            'nama_maskapai.required' => 'Nama maskapai harus diisi',
            'id_penerbangan.required' => 'ID Penerbangan harus diis',
            'dari.required' => 'Dari harus diisi',
            'waktu_datang' => 'Waktu Kedatangan harus diisi',
        ]);

        $arrival->update([
            'nama_maskapai' => $request->nama_maskapai,
            'id_penerbangan' => $request->id_penerbangan,
            'dari' => $request->dari,
            'waktu_datang' => $request->waktu_datang,
        ]);

        return redirect()->route('jadwal.index');
    }

    public function destroyDeparture(Departure $departure) : RedirectResponse
    {
        $departure->delete();

        return redirect()->route('jadwal.index');
    }

    public function destroyArrival(Arrival $arrival) : RedirectResponse
    {
        $arrival->delete();

        return redirect()->route('jadwal.index');
    }
}

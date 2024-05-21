<?php

namespace App\Http\Controllers;

use App\Models\Dashboard\Berita;
use App\Models\Dashboard\Jadwal\Arrival;
use App\Models\Dashboard\Jadwal\Departure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() : View
    {

        $jadwal_arrival = Arrival::orderBy('waktu_datang', 'asc')->get();
        $jadwal_departure = Departure::orderBy('waktu_berangkat', 'asc')->get();

        $berita_main = Berita::latest()->limit(1)->get();
        $berita_side = Berita::latest()->limit(4)->offset(1)->get();
        
        return view('homepage', [
            'jadwal_arrival' => $jadwal_arrival,
            'jadwal_departure' => $jadwal_departure,
            'berita_main' => $berita_main,
            'berita_side' => $berita_side,
        ]);
    }

    public function showBerita(Berita $berita) : View
    {
        return view('berita', [
            'berita' => $berita,
        ]);
    } 
}

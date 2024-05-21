<?php

namespace App\Http\Controllers;

use App\Models\Contact\Kontak;
use App\Models\Contact\Saran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranController extends Controller
{
    public function index() : View
    {
        $kontak = Kontak::get();

        return view('contact', [
            'kontak' => $kontak->first(),
        ]);
    }

    public function search(Request $request) : View
    {
        $cari = $request->cari;
        $kolom = $request->kolom;

        $saran = Saran::where($kolom, 'like', "%$cari%")->get();

        return view('admin.kontak.index', ['saran' => $saran]);
    }

    public function send(Request $request) : RedirectResponse
    {
        $request->validate([
            'nama' => 'required|min:7',
            'email' => 'required|email',
            'subjek' => 'required|min:10',
            'pesan' => 'required|min:15'
        ]);

        Saran::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan
        ]);

        return redirect()->route('hubungi.kami')->with('success', 'Terima Kasih Sudah Memberikan Saran & Masukan');
    }

    public function show(Saran $saran) : View
    {
        return view('admin.kontak.show', [
            'saran' => $saran,
        ]);
    }

    public function destroy(Saran $saran) : RedirectResponse
    {
        $saran->delete();

        return redirect()->route('contact.index');
    }
}

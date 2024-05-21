<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Berita;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index() : View
    {
        $berita = Berita::latest()->get();

        return view('admin.berita.index', ['berita' => $berita]);
    }

    public function search(Request $request) : View
    {
        $kolom = $request->kolom;
        $cari = $request->cari;

        $berita = Berita::where($kolom, 'like', "%".$cari."%")->get();

        return view('admin.berita.index', ['berita' => $berita]);
    }

    public function create() : View
    {
        return view('admin.berita.create');
    }

    public function store(Request $request) : RedirectResponse
    {

        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg|image',
            'judul' => 'required|min:5|max:30',
            'isi' => 'required|min:10'
        ],
        [
            // * Image
            'image.required' => 'Gambar harus disertakan',
            'image.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'image.image' => 'Gambar harus gambar bukan file lain', 

            // * judul
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 5 karakter',
            'judul.max' => 'Judul maksimal 30 karakter',

            // * isi
            'isi.required' => 'Isi harus diisi',
            'isi.min' => 'Isi minimal 10 karakter',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/berita/', $image->hashName());

        Berita::create([
            'image' => $image->hashName(),
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return redirect()->route('berita.index');
    }

    public function show(Berita $berita) : View
    {
        return view('admin.berita.show', ['berita' => $berita]);
    }

    public function edit(Berita $berita) : View
    {
        return view('admin.berita.edit', ['berita' => $berita]);
    }

    public function update(Request $request, Berita $berita) : RedirectResponse
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png',
            'judul' => 'required|min:5',
            'isi' => 'required|min:10'
        ],
        [
            // * Image
            'image.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'image.image' => 'Gambar harus gambar bukan file lain',

            // * judul
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 5 karakter',
            'judul.max' => 'Judul maksimal 30 karakter',

            // * isi
            'isi.required' => 'Isi harus diisi',
            'isi.min' => 'Isi minimal 10 karakter',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/berita/', $image->hashName());

            Storage::delete('public/berita/'.$berita->image);

            $berita->update([
                'image' => $image->hashName(),
                'judul' => $request->judul,
                'isi' => $request->isi,
            ]);

        } else {
            
            $berita->update([
                'judul' => $request->judul,
                'isi' => $request->isi
            ]);
        }

        return redirect()->route('berita.show', $berita->id);
    }

    public function destroy(Berita $berita) : RedirectResponse
    {
        Storage::delete('public/berita/'.$berita->image);

        $berita->delete();

        return redirect()->route('berita.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact\Kontak;
use App\Models\Contact\Saran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    private $title;
    private $route_name;

    public function index() : View
    {
        $kontak = Kontak::get();
        $saran = Saran::latest()->get();

        return view('admin.kontak.index', [
            'kontak' => $kontak->first(),
            'saran' => $saran
        ]);
    }

    public function create() : View
    {
        $this->title = "tambah";
        $this->route_name = 'store';

        return view('admin.kontak.create', [
            'title' => $this->title,
            'route_name' => $this->route_name,
        ]);
    }
    
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'no_telepon' => 'required',
            'admin_email' => 'required|email'
        ],
        [
            'no_telepon.required' => 'No Telepon harus diisi',
            'admin_email.required' => 'Email harus diisi',
            'admin_email.email' => 'Email harus berupa email',
        ]);

        Kontak::create([
            'no_telepon' => $request->no_telepon,
            'admin_email' => $request->admin_email
        ]);

        return redirect()->route('contact.index');
    }

    public function edit(Kontak $kontak) : View
    {
        $this->title = "ubah";
        $this->route_name = "update";

        return view('admin.kontak.create', [
            'kontak' => $kontak,
            'title' => $this->title,
            'route_name' => $this->route_name,
        ]);
    }

    public function update(Request $request, Kontak $kontak) : RedirectResponse
    {
        $request->validate([
            'no_telepon' => 'required',
            'admin_email' => 'required|email'
        ],
        [
            'no_telepon.required' => 'No Telepon harus diisi',
            'admin_email.required' => 'Email harus diisi',
            'admin_email.email' => 'Email harus berupa email',
        ]);

        $kontak->update([
            'no_telepon' => $request->no_telepon,
            'admin_email' => $request->admin_email
        ]);

        return redirect()->route('contact.index');
    }
    
}

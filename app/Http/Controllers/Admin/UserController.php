<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() : View
    {
        if (! Gate::allows('isAdmin')) {
            return view('admin.dashboard');
        }

        $users = User::latest()->get();

        return view('admin.user.index', ['users' => $users]);
    }

    public function search(Request $request) : View
    {
        $cari = $request->cari;
        $kolom = $request->kolom;

        $users = User::where($kolom, 'like', "%$cari%")->get();

        return view('admin.user.index', ['users' => $users]);
    }

    public function create() : View
    {
        return view('admin.user.create');
    }

    public function show(User $user) : View
    {
        return view('admin.user.show', ['user' => $user]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'username' => ['required', 'string', 'lowercase', 'max:20', 'min:5', 'unique:' . User::class],
            'password' => ['required', 'min:8', 'max:16', 'regex:/[A-Z]+/', 'regex:/[0-9]+/'],
            'role' => ['required'],
        ],
        [
            // * Name
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama berupa huruf bukan angka',
            'name.max' => 'Panjang nama maksimal 20 karakter',
            'name.min' => 'Panjang nama minimal 3 karakter',
            
            // * username
            'username.required' => 'Username harus diisi',
            'username.stirng' => 'Username berupa campuran huruf dan angka',
            'username.lowercase' => 'Username harus huruf kecil semua',
            'username.max' => 'Username maksimal 255 karakter',
            'username.min' => 'Username minimal 5 karakter',
            'username.unique' => 'Username harus unik / tidak sama dengan  yang sudah terdaftar',

            // * Password 
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 16 karakter',
            'password.regex' => 'Password harus ada minimal 1 huruf besar dan 1 angka',
        ]); 

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        return redirect()->route('user.index');
    }

    public function edit(User $user) : View
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user) : RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'username' => ['required', 'string', 'lowercase', 'max:20', 'min:5'],
            'password' => ['required', 'min:8', 'max:16', 'regex:/[A-Z]+/', 'regex:/[0-9]+/'],
        ],
        [
            // * Name
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama berupa huruf bukan angka',
            'name.max' => 'Panjang nama maksimal 255 karakter',
            'name.min' => 'Panjang nama minimal 3 karakter',

            // * username
            'username.required' => 'Username harus diisi',
            'username.stirng' => 'Username berupa campuran huruf dan angka',
            'username.lowercase' => 'Username harus huruf kecil semua',
            'username.max' => 'Username maksimal 20 karakter',
            'username.min' => 'Username minimal 5 karakter',

            // * Password 
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 16 karakter',
            'password.regex' => 'Password harus ada minimal 1 huruf besar dan 1 angka',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index');
    }

    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();

        return redirect()->back();
    }
}

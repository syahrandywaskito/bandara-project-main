<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\Laporan\DetailController;
use App\Http\Controllers\Admin\Laporan\InputController;
use App\Http\Controllers\Admin\Laporan\KegiatanController;
use App\Http\Controllers\Admin\Laporan\KeteranganController;
use App\Http\Controllers\Admin\Laporan\PeralatanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaranController;
use App\Models\Contact\Saran;
use App\Models\Dashboard\Laporan\Keterangan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Route::get('hasil-laporan', function () {
//   return view('laporan');
// });

Route::controller(LaporanController::class)->group(function () {
  
  Route::get('laporan', 'halamanPeralatan')->name('laporan.peralatan');
  Route::get('laporan/peralatan/{peralatan}', 'halamanBulan')->name('laporan.bulan');
  Route::get('laporan/peralatan/{peralatan}/download', 'download')->name('laporan.download');
});

Route::get('berita/{berita}', [HomeController::class, 'showBerita'])->name('lihat-berita');

// * Hubungi Kami
Route::controller(SaranController::class)->group(function () {
  Route::get('hubungi-kami', 'index')->name('hubungi.kami');

  Route::post('saran/send', 'send')->name('saran.send');
});

// * Register & Auth
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.auth');

Route::get('register', [RegisterController::class, 'create'])->name('register')->middleware('checkadmin');
Route::post('register', [RegisterController::class, 'store'])->name('register.regis')->middleware('checkadmin');

// * Admin
Route::middleware(['auth', 'auth.session'])->group(function () {

  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::prefix('dashboard')->group(function() {

    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('berita/search', [BeritaController::class, 'search'])->name('berita.search');
    Route::resource('berita', BeritaController::class)->parameters([
      'berita' => 'berita',
    ]);

    Route::controller(JadwalController::class)->group(function(){

      Route::name('jadwal.')->group(function() {

        Route::get('jadwal', 'index')->name('index');

        Route::prefix('jadwal')->group(function() {
    
          Route::get('departure', 'departure')->name('create.departure');
          Route::get('arrival', 'arrival')->name('create.arrival');
    
          Route::post('departure/store', 'storeDeparture')->name('store.departure');
          Route::post('arrival/store', 'storeArrival')->name('store.arrival');
        
          Route::get('departure/{departure}/edit', 'editDeparture')->name('edit.departure');
          Route::get('arrival/{arrival}/edit', 'editArrival')->name('edit.arrival');
        
          Route::put('departure/update/{departure}', 'updateDeparture')->name('update.departure');
          Route::put('arrival/update/{arrival}', 'updateArrival')->name('update.arrival');

          Route::delete('departure/destroy/{departure}', 'destroyDeparture')->name('destroy.departure');
          Route::delete('arrival/destroy/{arrival}', 'destroyArrival')->name('destroy.arrival');
  
        });

      });

    });

    Route::controller(AdminContactController::class)->group(function(){

      Route::get('contact', 'index')->name('contact.index');
      Route::get('contact/create', 'create')->name('contact.create');
      Route::post('contact/store', 'store')->name('contact.store');

      Route::get('contact/{kontak}/edit', 'edit')->name('contact.edit');
      Route::put('contact/update/{kontak}', 'update')->name('contact.update');
    });

    Route::controller(SaranController::class)->group(function (){
      
      Route::get('contact/saran/search', 'search')->name('saran.search');
      Route::get('saran/show/{saran}', 'show')->name('saran.show');
      Route::delete('saran/destroy/{saran}', 'destroy')->name('saran.destroy');
    });

    Route::resource('peralatan', PeralatanController::class)->except(['show']);
    Route::get('peralatan/search', [PeralatanController::class, 'search'])->name('peralatan.search');

    Route::prefix('peralatan/{peralatan}')->group(function () {

      Route::prefix('input-laporan')->group(function () {
        Route::controller(InputController::class)->group(function () {
          Route::get('/', 'index')->name('input.index');
          Route::get('{tanggal}/input', 'create')->name('input.create');
          Route::post('{tanggal}', 'store')->name('input.store');
          Route::get('{inputLaporan}/edit', 'edit')->name('input.edit');
          Route::put('{inputLaporan}', 'update')->name('input.update');
          Route::delete('{inputLaporan}/delete', 'destroy')->name('input.destroy');
        });
      });

      Route::prefix('keterangan')->group(function() {
        Route::controller(KeteranganController::class)->group(function () {
          Route::get('{tanggal}/input', 'create')->name('keterangan.create');
          Route::post('{tanggal}', 'store')->name('keterangan.store');
          Route::get('{keterangan}/edit', 'edit')->name('keterangan.edit');
          Route::put('{keterangan}', 'update')->name('keterangan.update');
          Route::delete('{keterangan}/delete', 'destroy')->name('keterangan.destroy');
        });
      });

        Route::resource('kegiatan', KegiatanController::class)->except(['show']);

        Route::prefix('kegiatan/{kegiatan}')->group(function () {

          Route::resource('detail', DetailController::class)->except(['show']);

        });
    });

    Route::controller(LaporanController::class)->group(function () {
      Route::get('laporan', 'index')->name('laporan.index');
      Route::get('laporan/search', 'search')->name('laporan.search');
    });

    Route::middleware('can:isAdmin')->group(function () {

      Route::controller(UserController::class)->group(function (){
        Route::prefix('user')->group(function () {
          Route::get('/', 'index')->name('user.index');
          Route::get('search', 'search')->name('user.search');
          Route::get('registrasi', 'create')->name('user.create');
          Route::post('registrasi', 'store')->name('user.store');
          Route::get('show/{user}', 'show')->name('user.show');
          Route::get('{user}/edit', 'edit')->name('user.edit');
          Route::put('update/{user}', 'update')->name('user.update');
          Route::delete('delete/{user}', 'destroy')->name('user.destroy');
        });
      });
      
    });

  }); 
  
});

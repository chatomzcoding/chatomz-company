<?php

use App\Http\Controllers\Bisnis\WadeController;
use App\Http\Controllers\Chatomz\BarangController;
use App\Http\Controllers\Chatomz\Coding\BotController;
use App\Http\Controllers\Chatomz\GrupanggotaController;
use App\Http\Controllers\Chatomz\GrupController;
use App\Http\Controllers\Chatomz\HubungankeluargaController;
use App\Http\Controllers\Chatomz\JejakController;
use App\Http\Controllers\Chatomz\KeluargaController;
use App\Http\Controllers\Chatomz\LinimasaController;
use App\Http\Controllers\Chatomz\OrangController;
use App\Http\Controllers\Chatomz\PendidikanController;
use App\Http\Controllers\Company\InformasiController;
use App\Http\Controllers\Company\InformasisubController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Homepage\LandingController;
use App\Http\Controllers\MigrasiController;
use App\Http\Controllers\Sistem\KategoriController;
use App\Http\Controllers\Sistem\VisitorController;
use App\Http\Controllers\UjiController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOMEPAGE
Route::get('/',[LandingController::class,'index']);
Route::get('/c/{sesi}',[LandingController::class,'content']);

Route::get('uji/lihat', 'App\Http\Controllers\ApiController@index');
Route::post('simpanuji', 'App\Http\Controllers\ApiController@simpan');
Route::get('uji/tambah', 'App\Http\Controllers\ApiController@tambah');
Route::get('uji/hapus/{id}', 'App\Http\Controllers\ApiController@hapus');


/*
-------------------------------------------------------------------------------------------------
*/

// PERCOBAAN LIVEWIRE
// Route::get('/example',[Example::class, 'render'])->name('example');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    // DEMO
    Route::get('/demo/grab', [DemoController::class,'grab']);

    // migrasi
    Route::get('/migrasi', [MigrasiController::class,'index']);

    // Umum
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('dashboard');

    // Route Admin & Chatomz
    Route::middleware(['admin'])->group(function () {
        Route::resource('info-website', 'App\Http\Controllers\Admin\InfowebsiteController');
        // Chatomz
        // barang
        Route::resource('barang', BarangController::class);
        Route::resource('barangbelanja', 'App\Http\Controllers\Chatomz\Barang\BelanjaController');
        Route::resource('barangdaftar', 'App\Http\Controllers\Chatomz\Barang\DaftarController');
        
        Route::resource('jejak', JejakController::class);
        Route::resource('jejakorang', 'App\Http\Controllers\Chatomz\JejakorangController');
        Route::resource('jejakpoto', 'App\Http\Controllers\Chatomz\JejakpotoController');
        Route::resource('orang', OrangController::class);
        Route::resource('linimasa', LinimasaController::class);
        Route::get('lihat/orangpoto/{sesi}', 'App\Http\Controllers\Chatomz\OrangController@orangpoto');
        Route::post('proses/lihat/orangpoto', 'App\Http\Controllers\Chatomz\OrangController@prosesorangpoto');
        Route::post('cariorang', 'App\Http\Controllers\Chatomz\OrangController@cariorang');


        Route::get('lihat/statistik', 'App\Http\Controllers\HomeController@statistik');
        Route::resource('kontak', 'App\Http\Controllers\Chatomz\KontakController');
        Route::resource('grup', GrupController::class);
        Route::get('lihat/grup/{sesi}', 'App\Http\Controllers\Chatomz\GrupController@lihatgrup');
        Route::post('proses/lihat/grup', 'App\Http\Controllers\Chatomz\GrupController@prosesgrup');
        Route::resource('grupanggota', GrupanggotaController::class);
        Route::resource('pendidikan', PendidikanController::class);
        Route::resource('keluarga', KeluargaController::class);
        Route::resource('hubungankeluarga', HubungankeluargaController::class);
        
        // SISTEM
        Route::resource('visitor', VisitorController::class);
        Route::resource('kategori', KategoriController::class);
        
        // Company
        // informasi
        Route::resource('informasi', InformasiController::class);
        Route::resource('informasisub', InformasisubController::class);
        Route::resource('merk', 'App\Http\Controllers\Company\MerkController');

        // BISNIS
        Route::get('wadec',[WadeController::class,'index']);

        // CODING
        Route::resource('chatomzbot', BotController::class);

    });
    
    Route::resource('adminuser', 'App\Http\Controllers\Admin\UserController');
    Route::resource('user', 'App\Http\Controllers\UserController');

    Route::get('pengujian/{sesi}', [UjiController::class, 'pengujian']);
    Route::post('simpanmaps', [JejakController::class, 'simpanmaps'])->name('simpanmaps');

});

// --------------------------------------------------------------------------------------------
// PENGUJIAN DLL
// --------------------------------------------------------------------------------------------
// Cetak PDF dengan dompdf packgake
Route::get('/cetak/lihat','App\Http\Controllers\Pengujian\PrintpdfController@get');
Route::get('/cetak/download','App\Http\Controllers\Pengujian\PrintpdfController@out');
// --------------------------------------------------------------------------------------------

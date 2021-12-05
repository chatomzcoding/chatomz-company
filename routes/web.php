<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Example; 
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
Route::get('/', function(){
    return redirect('login');
});

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


    // Route::get('member', Members::class)->name('member'); //Tambahkan routing ini

    // Umum
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('dashboard');

    // Route Admin & Chatomz
    Route::middleware(['admin'])->group(function () {
        Route::resource('info-website', 'App\Http\Controllers\Admin\InfowebsiteController');
        // Chatomz
        // barang
        Route::resource('barang', 'App\Http\Controllers\Chatomz\BarangController');
        Route::resource('barangbelanja', 'App\Http\Controllers\Chatomz\Barang\BelanjaController');
        Route::resource('barangdaftar', 'App\Http\Controllers\Chatomz\Barang\DaftarController');
        
        Route::resource('jejak', 'App\Http\Controllers\Chatomz\JejakController');
        Route::resource('jejakorang', 'App\Http\Controllers\Chatomz\JejakorangController');
        Route::resource('jejakpoto', 'App\Http\Controllers\Chatomz\JejakpotoController');
        Route::resource('orang', 'App\Http\Controllers\Chatomz\OrangController');
        Route::get('lihat/orangpoto/{sesi}', 'App\Http\Controllers\Chatomz\OrangController@orangpoto');
        Route::post('proses/lihat/orangpoto', 'App\Http\Controllers\Chatomz\OrangController@prosesorangpoto');
        Route::post('cariorang', 'App\Http\Controllers\Chatomz\OrangController@cariorang');


        Route::get('lihat/statistik', 'App\Http\Controllers\HomeController@statistik');
        Route::resource('kontak', 'App\Http\Controllers\Chatomz\KontakController');
        Route::resource('grup', 'App\Http\Controllers\Chatomz\GrupController');
        Route::get('lihat/grup/{sesi}', 'App\Http\Controllers\Chatomz\GrupController@lihatgrup');
        Route::post('proses/lihat/grup', 'App\Http\Controllers\Chatomz\GrupController@prosesgrup');
        Route::resource('grupanggota', 'App\Http\Controllers\Chatomz\GrupanggotaController');
        Route::resource('pendidikan', 'App\Http\Controllers\Chatomz\PendidikanController');
        Route::resource('keluarga', 'App\Http\Controllers\Chatomz\KeluargaController');
        Route::resource('keluargahubungan', 'App\Http\Controllers\Chatomz\HubungankeluargaController');
        
        // SISTEM
        Route::resource('visitor', 'App\Http\Controllers\Sistem\VisitorController');
        Route::resource('kategori', 'App\Http\Controllers\Sistem\KategoriController');
        
        // Company
        // informasi
        Route::resource('informasi', 'App\Http\Controllers\Company\InformasiController');
        Route::resource('informasisub', 'App\Http\Controllers\Company\InformasisubController');
        Route::resource('merk', 'App\Http\Controllers\Company\MerkController');
        Route::resource('gadget', 'App\Http\Controllers\Company\GadgetController');
        Route::resource('hewan', 'App\Http\Controllers\Company\Informasi\HewanController');
        Route::resource('gadgethandphone', 'App\Http\Controllers\Company\Informasi\Gadget\HandphoneController');
        Route::resource('hewanjenis', 'App\Http\Controllers\Company\Informasi\HewanjenisController');

    });
    
    Route::resource('adminuser', 'App\Http\Controllers\Admin\UserController');
    Route::resource('user', 'App\Http\Controllers\UserController');

});

// --------------------------------------------------------------------------------------------
// PENGUJIAN DLL
// --------------------------------------------------------------------------------------------
// Cetak PDF dengan dompdf packgake
Route::get('/cetak/lihat','App\Http\Controllers\Pengujian\PrintpdfController@get');
Route::get('/cetak/download','App\Http\Controllers\Pengujian\PrintpdfController@out');
// --------------------------------------------------------------------------------------------

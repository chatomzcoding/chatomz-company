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
        Route::resource('iklan', 'App\Http\Controllers\Admin\IklanController');
        Route::resource('info-website', 'App\Http\Controllers\Admin\InfowebsiteController');
        Route::resource('kategoriartikel', 'App\Http\Controllers\Admin\KategoriartikelController');
        // Chatomz
        Route::resource('barang', 'App\Http\Controllers\Chatomz\BarangController');
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
        Route::resource('kategoriproduk', 'App\Http\Controllers\Market\KategoriprodukController');
        
        // SISTEM
        Route::resource('visitor', 'App\Http\Controllers\Sistem\VisitorController');
    });
    
    Route::resource('adminuser', 'App\Http\Controllers\Admin\UserController');
    Route::resource('user', 'App\Http\Controllers\UserController');
    
    
    // Market
    Route::resource('toko', 'App\Http\Controllers\Market\TokoController');
    Route::resource('produk', 'App\Http\Controllers\Market\ProdukController');
    Route::resource('pemesanan', 'App\Http\Controllers\Market\PemesananController');
    Route::resource('produk-diskon', 'App\Http\Controllers\Market\ProdukdiskonController');
    
    // Seller
    Route::get('/seller/user', 'App\Http\Controllers\Admin\UserController@seller'); 

});

// --------------------------------------------------------------------------------------------
// PENGUJIAN DLL
// --------------------------------------------------------------------------------------------
// Cetak PDF dengan dompdf packgake
Route::get('/cetak/lihat','App\Http\Controllers\Pengujian\PrintpdfController@get');
Route::get('/cetak/download','App\Http\Controllers\Pengujian\PrintpdfController@out');
// --------------------------------------------------------------------------------------------

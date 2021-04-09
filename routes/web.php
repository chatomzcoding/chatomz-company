<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Example; 
use App\Http\Livewire\Members; //Load class Members 
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
Route::get('/','App\Http\Controllers\Homepage\LandingController@index');
Route::get('/view/{file}','App\Http\Controllers\Homepage\LandingController@view');
Route::get('/h/blog','App\Http\Controllers\Homepage\LandingController@blog');
Route::get('/h/blog/{id}','App\Http\Controllers\Homepage\LandingController@blogdetail');
Route::get('/h/blog/kategori/{slug}','App\Http\Controllers\Homepage\LandingController@blogkategori');
Route::get('/h/produk/{slug}','App\Http\Controllers\Homepage\ProdukController@detail');
Route::post('/h/produk/cari','App\Http\Controllers\Homepage\ProdukController@cariproduk');
Route::get('/h/produk/pencarian/{cari}','App\Http\Controllers\Homepage\ProdukController@hasilpencarian');
Route::get('/h/kategoriproduk/{slug}','App\Http\Controllers\Homepage\ProdukController@kategori');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// PERCOBAAN LIVEWIRE
// Route::get('/example',[Example::class, 'render'])->name('example');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    // Route::get('/dashboard', function() {
    //     return view('dashboard');
    // })->name('dashboard');

    // Route::get('member', Members::class)->name('member'); //Tambahkan routing ini

    // Admin
    Route::get('/dashboard', 'App\Http\Controllers\Market\HomeController@index')->name('dashboard');
    Route::resource('artikel', 'App\Http\Controllers\Admin\ArtikelController');
    Route::resource('iklan', 'App\Http\Controllers\Admin\IklanController');
    Route::resource('info-website', 'App\Http\Controllers\Admin\InfowebsiteController');
    Route::resource('adminuser', 'App\Http\Controllers\Admin\UserController');
    Route::resource('kategoriartikel', 'App\Http\Controllers\Admin\KategoriartikelController');

    // Chatomz
    Route::resource('orang', 'App\Http\Controllers\Chatomz\OrangController');
    Route::resource('keluarga', 'App\Http\Controllers\Chatomz\KeluargaController');
    Route::resource('keluargahubungan', 'App\Http\Controllers\Chatomz\HubungankeluargaController');
    
    // Market
    Route::resource('kategoriproduk', 'App\Http\Controllers\Market\KategoriprodukController');
    Route::resource('toko', 'App\Http\Controllers\Market\TokoController');
    Route::resource('produk', 'App\Http\Controllers\Market\ProdukController');
    Route::resource('produk-diskon', 'App\Http\Controllers\Market\ProdukdiskonController');

});

// --------------------------------------------------------------------------------------------
// PENGUJIAN DLL
// --------------------------------------------------------------------------------------------
// Cetak PDF dengan dompdf packgake
Route::get('/cetak/lihat','App\Http\Controllers\Pengujian\PrintpdfController@get');
Route::get('/cetak/download','App\Http\Controllers\Pengujian\PrintpdfController@out');
// --------------------------------------------------------------------------------------------

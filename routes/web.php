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

Route::get('/', function () {
    return view('welcome');
});

// PENGUJIAN
Route::get('/pengujian','App\Http\Controllers\Cikara\PengujianController@index');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// PERCOBAAN LIVEWIRE
Route::get('/example',[Example::class, 'render'])->name('example');
// Route::get('member', Members::class)->name('member'); //Tambahkan routing ini

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('member', Members::class)->name('member'); //Tambahkan routing ini

    // Chatomz
    Route::resource('orang', 'App\Http\Controllers\Chatomz\OrangController');

});

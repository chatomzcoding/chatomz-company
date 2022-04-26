<?php

use App\Http\Controllers\Api\Bisnis\ProdukController;
use App\Http\Controllers\Api\Bisnis\UsahaController;
use App\Http\Controllers\Api\Informasi\HewanController;
use App\Http\Controllers\Api\informasi\MasakanController;
use App\Http\Controllers\Api\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// BISNIS
Route::resource('usaha', UsahaController::class);
Route::resource('produk', ProdukController::class);

// INFORMASI
Route::resource('hewan', HewanController::class);
Route::resource('masakan', MasakanController::class);
Route::resource('kategori', KategoriController::class);
Route::post('coba', 'App\Http\Controllers\Api\Informasi\HewanController@coba');

// chatomz ganteng

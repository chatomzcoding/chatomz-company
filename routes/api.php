<?php

use App\Http\Controllers\Api\Informasi\HewanController;
use App\Http\Controllers\Company\Informasi\HewanController as InformasiHewanController;
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

Route::resource('hewan', HewanController::class);
Route::post('coba', 'App\Http\Controllers\Api\Informasi\HewanController@coba');

<?php

use App\Http\Controllers\Admin\BackupdbController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuroleController;
use App\Http\Controllers\Admin\MenusubController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Bisnis\ProdukController;
use App\Http\Controllers\Bisnis\UsahaController;
use App\Http\Controllers\Bisnis\WadeController;
use App\Http\Controllers\Chatomz\BarangController;
use App\Http\Controllers\Chatomz\Coding\BotController;
use App\Http\Controllers\Chatomz\GrupanggotaController;
use App\Http\Controllers\Chatomz\GrupController;
use App\Http\Controllers\Chatomz\HubungankeluargaController;
use App\Http\Controllers\Chatomz\JejakController;
use App\Http\Controllers\Chatomz\KeluargaController;
use App\Http\Controllers\Chatomz\Keuangan\JurnalController;
use App\Http\Controllers\Chatomz\Keuangan\JurnalitemController;
use App\Http\Controllers\Chatomz\Keuangan\JurnalmanajemenController;
use App\Http\Controllers\Chatomz\Keuangan\ManajemenkeuanganController;
use App\Http\Controllers\Chatomz\Keuangan\RekeningController;
use App\Http\Controllers\Chatomz\LinimasaController;
use App\Http\Controllers\Chatomz\OrangController;
use App\Http\Controllers\Chatomz\PendidikanController;
use App\Http\Controllers\Company\InformasiController;
use App\Http\Controllers\Company\InformasisubController;
use App\Http\Controllers\Company\TempatController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Homepage\LandingController;
use App\Http\Controllers\Member\OrangaksesController;
use App\Http\Controllers\MigrasiController;
use App\Http\Controllers\Sistem\ItemController;
use App\Http\Controllers\Sistem\KategoriController;
use App\Http\Controllers\Sistem\StatistikController;
use App\Http\Controllers\Sistem\SubkategoriController;
use App\Http\Controllers\Sistem\UnsilController;
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
Route::get('/', function()
{
    return redirect('login');
});
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
    Route::get('/demo/architectui', [DemoController::class,'architectui']);
    Route::get('/demo/backupdb', [DemoController::class,'backupdb']);
    Route::get('/demo/calendar', [DemoController::class,'calendar']);
    Route::get('/demo/mapbox/{s}', [DemoController::class,'mapbox']);

    // migrasi
    Route::get('/migrasi', [MigrasiController::class,'index']);

    // Umum
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('dashboard');

    // Route Admin & Chatomz
    Route::middleware(['admin'])->group(function () {
        // GENERAL
        Route::get('pencarian', [HomeController::class, 'cari']);
        Route::get('kalender', [HomeController::class, 'kalender']);

        Route::get('unsil',[UnsilController::class, 'index']);
        Route::post('simpanmahasiswa',[UnsilController::class, 'simpan']);
        Route::resource('info-website', 'App\Http\Controllers\Admin\InfowebsiteController');
        // Chatomz
        // barang
        Route::resource('barang', BarangController::class);
        Route::resource('barangbelanja', 'App\Http\Controllers\Chatomz\Barang\BelanjaController');
        Route::resource('barangdaftar', 'App\Http\Controllers\Chatomz\Barang\DaftarController');
        
        // KEUANGAN
        Route::resource('rekening', RekeningController::class);
        Route::resource('jurnal', JurnalController::class);
        Route::resource('jurnalitem', JurnalitemController::class);
        Route::resource('manajemenkeuangan', ManajemenkeuanganController::class);
        Route::resource('jurnalmanajemen', JurnalmanajemenController::class);
        
        Route::resource('jejak', JejakController::class);
        Route::resource('jejakorang', 'App\Http\Controllers\Chatomz\JejakorangController');
        Route::resource('jejakpoto', 'App\Http\Controllers\Chatomz\JejakpotoController');
        Route::resource('linimasa', LinimasaController::class);
        Route::get('lihat/orangpoto', 'App\Http\Controllers\Chatomz\OrangController@orangpoto');
        
        
        Route::get('lihat/statistik', 'App\Http\Controllers\HomeController@statistik');
        Route::resource('kontak', 'App\Http\Controllers\Chatomz\KontakController');
        Route::resource('grup', GrupController::class);
        Route::get('lihat/grup/{sesi}', 'App\Http\Controllers\Chatomz\GrupController@lihatgrup');
        Route::post('proses/lihat/grup', 'App\Http\Controllers\Chatomz\GrupController@prosesgrup');
        Route::resource('grupanggota', GrupanggotaController::class);
        Route::resource('pendidikan', PendidikanController::class);
        
        // SISTEM
        Route::resource('visitor', VisitorController::class);
        Route::resource('menu', MenuController::class);
        Route::resource('menusub', MenusubController::class);
        Route::resource('menurole', MenuroleController::class);
        Route::resource('item', ItemController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('subkategori', SubkategoriController::class);
        Route::get('statistik/orang',[StatistikController::class,'orang']);
        Route::resource('backupdb', BackupdbController::class);
        
        
        // Company
        // informasi
        Route::resource('informasi', InformasiController::class);
        Route::resource('informasisub', InformasisubController::class);
        Route::resource('tempat', TempatController::class);
        
        // BISNIS
        Route::resource('produk', ProdukController::class);
        Route::resource('usaha', UsahaController::class);
        Route::get('wadec',[WadeController::class,'index']);
        
        // CODING
        Route::resource('chatomzbot', BotController::class);
        
    });
    
    // Route::resource('adminuser', 'App\Http\Controllers\Admin\UserController');
    Route::resource('orang', OrangController::class);
    Route::resource('orangakses', OrangaksesController::class);
    Route::resource('user', UserController::class);
    Route::resource('keluarga', KeluargaController::class);
    Route::resource('hubungankeluarga', HubungankeluargaController::class);
    
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

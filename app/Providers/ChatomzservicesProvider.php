<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChatomzservicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Http/Helpers/Sistem/bilangan.php';
        require_once app_path() . '/Http/Helpers/Sistem/data.php';
        require_once app_path() . '/Http/Helpers/Sistem/sistem.php';
        require_once app_path() . '/Http/Helpers/Sistem/view.php';
        require_once app_path() . '/Http/Helpers/Sistem/waktu.php';
        require_once app_path() . '/Http/Helpers/Chatomz/dashboard.php';
        require_once app_path() . '/Http/Helpers/Chatomz/data.php';
        require_once app_path() . '/Http/Helpers/Chatomz/db.php';
        require_once app_path() . '/Http/Helpers/Chatomz/keuangan.php';
        require_once app_path() . '/Http/Helpers/Chatomz/kingdom.php';
        require_once app_path() . '/Http/Helpers/Chatomz/list.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

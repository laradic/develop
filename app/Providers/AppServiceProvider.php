<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laradic\Filesystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $fs = Filesystem::create();
        foreach ( glob(storage_path('framework/views/*.php')) as $filePath ) {
            $fs->delete($filePath);
        }
    }
}

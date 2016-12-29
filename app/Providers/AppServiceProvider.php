<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laradic\Filesystem\Filesystem;
use Laradic\Idea\Metadata\Metas\BindingsMeta;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

//        config()->set('laradic.idea.meta.metas', array_except(config('laradic.idea.meta.metas', []), ['translations']));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Filesystem::create()->delete(globule(storage_path('framework/views/*.php')));
    }
}

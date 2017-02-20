<?php
/**
 * Part of the Laradic PHP Packages.
 *
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license https://laradic.mit-license.org The MIT License
 */

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
        if($this->app->environment() === 'local') {
            Filesystem::create()->delete(globule(storage_path('framework/views/*.php')));
        }
    }
}

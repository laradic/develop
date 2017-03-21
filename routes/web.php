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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('blade', 'BladeController@getIndex')->name('blade.index');
Route::get('blade/dump', 'BladeController@getDump')->name('blade.dump');
Route::get('blade/ifsection', 'BladeController@getIfSection')->name('blade.ifsection');
Route::get('blade/minify/{what}', 'BladeController@getMinify')->name('blade.minify');
Route::get('blade/embed', 'BladeController@getEmbed')->name('blade.embed');
//Route::resource('','BladeController');
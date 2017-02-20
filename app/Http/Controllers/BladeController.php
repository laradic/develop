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

namespace App\Http\Controllers;

class BladeController extends Controller
{
    public function minify($what)
    {
        view()->addNamespace('blade-extensions', [base_path('vendor/radic/blade-extensions/tests/views'),base_path('workbench/radic/blade-extensions/tests/views')]);

        return view('blade-extensions::minify/' . $what);
    }
}
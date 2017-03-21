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

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\VarDumper\Cloner\Data;

class BladeController extends Controller
{

    /**
     * BladeController constructor.
     */
    public function __construct()
    {
        view()->addLocation(base_path('workbench/radic/blade-extensions/tests/views'));
    }

    public function getMinify($what)
    {
        return view('minify/' . $what);
    }

    public function getIndex()
    {
        return view('index');
    }

    public function getDump()
    {
        $fs = new Filesystem;
        $files = $fs->allFiles(storage_path());
        return view('dump', compact('fs', 'files'));
    }

    public function getIfSection()
    {
        return view('directives.if-section.title-content');
    }

    public function getEmbed()
    {
        return view('directives.embed.index', ['username' => 'TestUserName']);
    }
}
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

namespace App\Console;

use Laradic\Assets\Assetic\AssetInterface;
use Laradic\Console\Command;
use Laradic\Support\Bench;

/**
 * {@inheritDoc}
 */
class TestCommand extends Command
{
    protected $signature = 'test';

    /** @var \Radic\BladeExtensions\BladeExtensions */
    protected $blade;

    protected $bench;

    /**
     * TestCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->bench = new Bench;
//        $this->blade = app('blade-extensions');
    }

    public function handle()
    {
        $assets = app('laradic.assets');
        $assets->setDebug(false);
        $asset = $assets->create('manifest', 'vendor/lodash/lodash.js');
        $compiledAsset = $asset->compile(true);

        $css = $assets->create('st', 'styles/codex.core.css');
        $compiledCss = $css->compile();
        $paths = $compiledCss->getPaths();

    }


    public function handle2()
    {
        $this->bench->start();
        $this->loop('a', function () {
            $this->blade->compileString('test a a $a', [ 'a' => 'foo' ]);
        });
        $this->loop('b', function () {
            $this->blade->compileString('test b b $a test b b $a test b b $a test b b $a', [ 'a' => 'foo' ]);
        });
        $this->bench->stop();
        collect($this->bench->getMarks())->each(function ($item) {
            $this->line($item[ 'id' ] . ' = ' . $item[ 'microtime' ] / 1000);
        });
        //[$this->bench->getMarks(), $this->bench->getStats()]
    }

    protected function loop($name, \Closure $fn)
    {
        $this->bench->mark($name);
        for ( $i = 0; $i < 1000; $i++ ) {
            $fn->bindTo($this);
            $fn();
        }
    }
}
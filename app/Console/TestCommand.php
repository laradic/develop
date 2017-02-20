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

use Laradic\Console\Command;
use Laradic\Support\Bench;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $blade;

    protected $bench;

    /**
     * TestCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->bench = new Bench;
        $this->blade = app('blade-extensions');
    }


    public function handle()
    {
        $this->bench->start();
        $this->loop('a', function () {
            $this->blade->compileString('test a a $a', [ 'a' => 'foo' ], true);
        });
        $this->loop('b', function () {
            $this->blade->compileString('test b b $a test b b $a test b b $a test b b $a', [ 'a' => 'foo' ], true);
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
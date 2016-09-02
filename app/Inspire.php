<?php

namespace App;

use Illuminate\Console\Command;
use Laradic\Idea\Configuration\Factory;
use Laradic\Workbench\Workbench;


class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *33333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333
     *
*@var string
     */
    protected $description = '';

    public function handle()
    {
        $wb = new Workbench();
//        $wb->getWorkbenchPackages()->filter()
    }


    public function handle3()
    {
        $f = new Factory();
        $f->build();


        $a = 'a';
    }

    public function handle2()
    {
        $be = app('blade-extensions');

        $w = view('welcome')->render();
        $a = 'a';
    }
}

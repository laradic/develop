<?php

namespace App;
use Illuminate\Console\Command;

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
     *
     * @var string
     */
    protected $description = '';

    public function handle()
    {



        $a = 'a';
    }


    public function handle2()
    {
        $be = app('blade-extensions');

        $w = view('welcome')->render();
        $a = 'a';
    }
}

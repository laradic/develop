<?php
namespace App\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ConfigureLogging extends \Illuminate\Foundation\Bootstrap\ConfigureLogging
{
    protected function registerLogger(Application $app)
    {
        $log = parent::registerLogger($app);
        $log->getMonolog()->pushHandler($handler = new StreamHandler(storage_path('logs/laravel.html'), Logger::DEBUG));
        $handler->setFormatter($formatter = new HtmlFormatter());
        return $log;
    }


}
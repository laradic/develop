<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class Log4PhpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        \Logger::configure([

        ]);
        $l = new \Logger('apa');
        foreach ( $this->getAppenders() as $appender ) {
            $l->addAppender($appender);
        }
        $l->log(\LoggerLevel::toLevel(\LoggerLevel::INFO), 'asdf');
    }

    protected function getAppenders()
    {
        $appenders = [
            $file = new \LoggerAppenderFile('apa'),
            $console = new \LoggerAppenderConsole,
        ];
        $file->setFile(__DIR__ . '/log4php.log');


        return $appenders;
    }
}

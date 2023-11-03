<?php

namespace Anburocky3\PhonepeLaravel\Providers;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class PhonepeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        AboutCommand::add('PhonePe Laravel', fn () => ['Version' => '0.1.0']);

        //
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');


        $this->publishes([
            __DIR__.'/../config/phonepe.php' => config_path('phonepe.php'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/phonepe'),
        ]);


        $this->loadViewsFrom(__DIR__.'/../resources/views', 'phonepe');

    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/phonepe.php', 'phonepe'
        );
    }
}

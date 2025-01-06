<?php

namespace Perfocard\Flog;

use Illuminate\Support\ServiceProvider;

class FlogServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/flog.php',
            'flog'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Публікація файлів конфігурації, якщо є
        $this->publishes([
            __DIR__ . '/../config/flog.php' => config_path('flog.php'),
        ], 'config');
    }
}

<?php

namespace Abedin\WebInstaller\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

     /**
     * Ragister package config path name here.
     * @param string
     */
    private const CONFIG_FILE = __DIR__ . '/../config/installer.php';
    
    /**
     * Ragister package path name here.
     * @param string
     */
    private const PATH_VIEWS = __DIR__ . '/../resources/views/';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    public function boot()
    {
        $this->loadViewsFrom(self::PATH_VIEWS, 'joynala.web-installer');

        $this->publishes([
            self::PATH_VIEWS => resource_path('views/vendor/web-installer'),
        ], 'web-installer');
    }

    protected function publishFiles()
    {
        // $this->publishes([
        //     __DIR__.'/../../config/installer.php' => base_path('config/installer.php'),
        // ], 'web-installer');

        // $this->publishes([
        //     __DIR__.'/../assets' => public_path('installer'),
        // ], 'web-installer');

        // $this->publishes([
        //     __DIR__.'/../../resources/views' => base_path('resources/views/vendor/installer'),
        // ], 'web-installer');
    }

}
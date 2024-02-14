<?php

namespace Abedin\WebInstaller\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resource/views', 'web-installer.resource');

        $this->publishes([
            __DIR__.'/../resource/views' => resource_path('views/vendor/web-installer'),
        ], 'web-installer');
    }

    protected function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../../config/installer.php' => base_path('config/installer.php'),
        ], 'web-installer');

        // $this->publishes([
        //     __DIR__.'/../assets' => public_path('installer'),
        // ], 'web-installer');

        $this->publishes([
            __DIR__.'/../../resources/views' => base_path('resources/views/vendor/installer'),
        ], 'web-installer');
    }

}
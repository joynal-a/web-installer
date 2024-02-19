<?php

namespace Abedin\WebInstaller\Providers;

use Illuminate\Support\ServiceProvider;
use YourPackage\Middleware\IsPublisConfigMiddleware;

class AppServiceProvider extends ServiceProvider
{

     /**
     * Ragister package config path name here.
     * @param string
     */
    private const CONFIG_FILE = __DIR__ . '/../../config/installer.php';
    
    /**
     * Ragister package path name here.
     * @param string
     */
    private const PATH_VIEWS = __DIR__ . '/../../resources/views';

    private const PATH_ASSETS = __DIR__ . '/../../resources/assets';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->app['router']->aliasMiddleware('config_check', IsPublisConfigMiddleware::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(self::PATH_VIEWS, 'joynala.web-installer');

        $this->publishes([
            self::PATH_VIEWS => resource_path('views/vendor/web-installer'),
            self::PATH_ASSETS => public_path('vendor/web-installer'),
        ], 'web-installer');
        

        $this->publishes([
            self::CONFIG_FILE => base_path('config/installer.php'),
        ], 'web-installer-config');
    }


}
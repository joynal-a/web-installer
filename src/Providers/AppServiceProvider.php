<?php

namespace Abedin\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->registerNewModelCommand();
    }

    // protected function registerNewModelCommand(): void
    // {
    //     $this->app->bind('command.make:model', MakeModel::class);
    //     $this->commands(['command.make:model']);
    // }

}
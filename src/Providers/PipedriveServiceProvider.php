<?php

namespace Pipedrive\Providers;

use Pipedrive\Services\PipeDriveService;
use Illuminate\Support\Facades\Blade;
use Pipedrive\View\Components\Integration\Index;
use Illuminate\Support\ServiceProvider;

class PipedriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('pipedrive',function(){
            return new PipeDriveService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pipedrive');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        Blade::component('pipedrive', Index::class);
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/pipedrive'),
        ]);
        $this->publishes([
            __DIR__.'/../config/pipedrive.php' => config_path('pipedrive.php'),
        ]);
    }
}

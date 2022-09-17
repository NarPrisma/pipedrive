<?php

namespace Pipedrive\Providers;
use Pipedrive\Console\Commands\PipeCommand;
use Pipedrive\Services\PipeDriveService;

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
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/pipedrive'),
        ]);
        $this->publishes([
            __DIR__.'/../config/pipedrive.php' => config_path('pipedrive.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                PipeCommand::class,

            ]);
        }

    }
}

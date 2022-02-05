<?php

namespace Sherif\Press;

use Sherif\Press\Press;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sherif\Press\Console\ProcessCommand;
use Sherif\Press\Facades\Press as PressFacade;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            ProcessCommand::class
        ]);
    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(
            path: __DIR__ . '/../resources/views',
            namespace: 'press'
        );

        $this->registerFacade();
        $this->registerRoutes();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/press.php' =>  config_path('press.php')
        ], 'press-config');
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(
                path: __DIR__ . '/../routes/web.php',
            );
        });
    }

    private function routeConfiguration()
    {
        return [
            'prefix'    =>  PressFacade::path(),
            'namespace' =>  'Sherif\Press\Http\Controllers'
        ];
    }

    protected function registerFacade()
    {
        $this->app->singleton('Press', function ($app) {
            return new Press();
        });
    }
}

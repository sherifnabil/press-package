<?php

namespace Sherif\Press;

use Illuminate\Support\ServiceProvider;
use Sherif\Press\Console\ProcessCommand;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
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
    }
}

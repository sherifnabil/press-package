<?php

namespace Sherif\Press\Tests\Feature;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Sherif\Press\PressBaseServiceProvider;

class TestCase extends TestbenchTestCase
{
    /**
    * Get package providers.
    *
    * @param  \Illuminate\Foundation\Application  $app
    *
    * @return array<int, class-string>
    */
    public function getPackageProviders($app)
    {
        return [
            PressBaseServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver'    =>  'sqlite',
            'database'  =>  ':memory:',
        ]);
    }
}

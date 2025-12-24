<?php

namespace Tests;

use Modules\User\Models\User;
use Nwidart\Modules\LaravelModulesServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\Permission\PermissionServiceProvider; // Ensure User model is accessible for auth provider

abstract class TestCase extends BaseTestCase
{
    /**
     * Define environment setup.
     */
    protected function defineEnvironment($app)
    {
        // Database
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);

        // Modules path - explicitly set for nwidart/laravel-modules
        $app['config']->set('modules.paths.modules', realpath(__DIR__.'/../modules'));
        $app['config']->set('modules.scan.enabled', true); // Enable module scanning
        $app['config']->set('modules.scan.paths', [realpath(__DIR__.'/../modules')]); // Scan our modules directory

        // Spatie Guards configuration for testing
        $app['config']->set('auth.guards.web', ['driver' => 'session', 'provider' => 'users']);
        $app['config']->set('auth.providers.users', ['driver' => 'eloquent', 'model' => User::class]);
    }

    /**
     * Get the package service providers.
     * These are explicitly listed, as dynamic loading can cause issues with Testbench.
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelModulesServiceProvider::class,
            PermissionServiceProvider::class,
            \Modules\Shared\Providers\SharedServiceProvider::class,
            \Modules\Permission\Providers\PermissionServiceProvider::class,
            \Modules\User\Providers\UserServiceProvider::class,
        ];
    }

    /**
     * Load migrations before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Load migrations from each module manually
        $this->loadMigrationsFrom(realpath(__DIR__.'/../modules/Permission/database/migrations'));
        $this->loadMigrationsFrom(realpath(__DIR__.'/../modules/User/database/migrations'));
    }
}

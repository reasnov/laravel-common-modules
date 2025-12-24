<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        // Bindings are now handled by UserServiceProvider
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            // No longer explicitly providing here as bindings are centralized.
            // This method might become redundant depending on how Laravel processes provides for registered sub-providers.
        ];
    }
}

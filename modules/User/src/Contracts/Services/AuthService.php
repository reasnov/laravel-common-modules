<?php

namespace Modules\User\Contracts\Services;

use Modules\User\Models\User;

interface AuthService
{
    /**
     * Register a new user.
     */
    public function register(array $data): User;

    /**
     * Attempt to authenticate a user.
     */
    public function login(array $credentials): bool;

    /**
     * Log the user out of the application.
     */
    public function logout(): void;
}

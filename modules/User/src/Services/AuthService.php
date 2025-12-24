<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Auth;
use Modules\User\Contracts\Services\AuthService as AuthServiceInterface;
use Modules\User\Contracts\Services\UserService as UserServiceInterface;
use Modules\User\Models\User;

class AuthService implements AuthServiceInterface
{
    public function __construct(protected UserServiceInterface $userService) {}

    public function register(array $data): User
    {
        return $this->userService->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'], // The service's create method should handle hashing
        ]);
    }

    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }
}

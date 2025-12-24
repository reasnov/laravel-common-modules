<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Modules\User\Contracts\Services\AuthService;
use Modules\User\Models\User;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->authService = $this->app->make(AuthService::class);
});

test('it can register a new user', function () {
    $userData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $user = $this->authService->register($userData);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe('Test User')
        ->and($user->email)->toBe('test@example.com');

    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
});

test('it can log in a user with correct credentials', function () {
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $credentials = [
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    $loggedIn = $this->authService->login($credentials);

    expect($loggedIn)->toBeTrue();
    expect(Auth::check())->toBeTrue();
});

test('it cannot log in a user with incorrect credentials', function () {
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $credentials = [
        'email' => 'test@example.com',
        'password' => 'wrong-password',
    ];

    $loggedIn = $this->authService->login($credentials);

    expect($loggedIn)->toBeFalse();
    expect(Auth::check())->toBeFalse();
});

test('it can log out a user', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    Auth::login($user); // Log in the user directly

    expect(Auth::check())->toBeTrue();

    $this->authService->logout();

    expect(Auth::check())->toBeFalse();
});

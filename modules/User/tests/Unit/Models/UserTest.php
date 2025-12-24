<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('it uses uuid as primary key', function () {
    $user = User::factory()->create();
    expect($user->incrementing)->toBeFalse()
        ->and($user->getKeyType())->toBe('string')
        ->and(Str::isUuid($user->id))->toBeTrue();
});

test('it has fillable attributes', function () {
    $fillable = ['name', 'username', 'email', 'password', 'avatar_url'];
    $user = new User;
    expect($user->getFillable())->toEqual($fillable);
});

test('it hides sensitive attributes', function () {
    $hidden = ['password', 'remember_token'];
    $user = new User;
    expect($user->getHidden())->toEqual($hidden);
});

test('it casts attributes correctly', function () {
    $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    $user = new User;
    expect($user->getCasts())->toMatchArray($casts);
});

test('it generates correct initials', function (string $name, string $expected) {
    $user = User::factory()->make(['name' => $name]);
    expect($user->initials)->toBe($expected);
})->with([
    ['John Doe', 'JD'],
    ['John', 'J'],
    ['John Doe Smith', 'JD'],
    ['Jane Mary Doe', 'JM'],
]);

test('it automatically generates a username if not provided', function () {
    $user = User::factory()->create(['username' => null]);
    expect($user->username)->not->toBeNull();
});

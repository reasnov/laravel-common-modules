<?php

use Modules\User\Contracts\Services\AuthService as AuthServiceInterface;
use Modules\User\Contracts\Services\UserService as UserServiceInterface;
use Modules\User\Services\AuthService;
use Modules\User\Services\UserService;

return [
    'AuthService' => [
        'interface' => AuthServiceInterface::class,
        'implementation' => AuthService::class,
    ],
    'UserService' => [
        'interface' => UserServiceInterface::class,
        'implementation' => UserService::class,
    ],
];

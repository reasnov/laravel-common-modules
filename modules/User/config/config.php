<?php

return [
    'name' => 'User',

    /*
    |--------------------------------------------------------------------------
    | User ID Type
    |--------------------------------------------------------------------------
    |
    | This option defines the type of the primary key for the User model.
    | Supported: "uuid", "id"
    | Default: "uuid"
    |
    */
    'type_id' => env('USER_TYPE_ID', 'uuid'),

    /*
    |--------------------------------------------------------------------------
    | Module Bindings
    |--------------------------------------------------------------------------
    |
    | Configurable bindings for interfaces to their implementations within the
    | User module.
    |
    */
    'bindings' => [
        \Modules\User\Contracts\Services\AuthService::class => \Modules\User\Services\AuthService::class,
        \Modules\User\Contracts\Services\UserService::class => \Modules\User\Services\UserService::class,
    ],
];

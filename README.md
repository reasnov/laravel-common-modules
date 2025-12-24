# Laravel Common Modules (Monorepo)

[![Latest Version](https://img.shields.io/github/release/reasnov/laravel-common-modules.svg?style=flat-square)](https://github.com/reasnov/laravel-common-modules/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

A collection of standard modules for Laravel 12 designed to accelerate your application development. This project uses a monorepo structure to ensure consistency and synchronization between modules.

## Available Modules

- **Shared**: Common utilities and base classes for all modules.
- **User**: Basic auth and user data management.
- **Permission**: Role & Permission management using `spatie/laravel-permission`.

## Requirements
- PHP ^8.2
- Laravel ^12.0

## Installation in Target Project

Add this repository to your Laravel project's `composer.json`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/reasnov/laravel-common-modules.git"
    }
],
"extra": {
    "installer-paths": {
        "Modules/{$name}/": ["type:laravel-module"]
    }
}
```

Then install the desired module:

```bash
composer require reasnov/laravel-module-auth
composer require reasnov/laravel-module-permission
composer require reasnov/laravel-module-user
```

## Development (Monorepo)

If you want to contribute or develop these modules locally:

1. Clone this repository.
2. Run `composer update`.
3. Use `vendor/bin/pest` to run tests.
4. Use `vendor/bin/monorepo-builder` for package management.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

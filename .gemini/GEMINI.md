# Gemini Operational Guidelines

**Project:** Laravel Common Modules (Monorepo)
**Framework:** Laravel 12
**Architecture:** Modular Monorepo (`nwidart/laravel-modules` + `symplify/monorepo-builder`)

---

## 1. Project Context & Architecture

This is a **monorepo** housing multiple reusable Laravel modules. The goal is to maintain strict separation of concerns while allowing shared infrastructure.

### Directory Structure
*   `modules/{Module}/`: Independent package root.
    *   `src/`: Core logic (Providers, Services, Models, Http).
    *   `database/`: Migrations, Factories, Seeders.
    *   `tests/`: Pest PHP tests (Unit/Feature).
    *   `composer.json`: Module-specific dependencies.
*   `modules/Shared/`: Common utilities and base classes.

### Core Dependencies
*   **Manager:** `nwidart/laravel-modules`
*   **Monorepo:** `symplify/monorepo-builder`
*   **Testing:** `pestphp/pest`

---

## 2. Coding Standards & Conventions

### General
*   **PHP Version:** 8.2+
*   **Strict Types:** Prefer `declare(strict_types=1);` in new files.
*   **Style:** Follow Laravel 12 standards. Use **Laravel Pint** for formatting.

### Architectural Patterns
1.  **Service Layer:**
    *   Business logic **must** reside in `src/Services/`, not Controllers.
    *   Controllers should handle request/response translation only.
2.  **Models:**
    *   Located in `src/Models/`.
    *   Use `Casts` method (Laravel 11+ style).
    *   UUIDs are standard for primary keys (see `User` module).
3.  **Configuration:**
    *   Module config files belong in `config/`.
    *   Use the `SharedServiceProvider` logic (or similar) for recursive config merging if available.

### Binding Conventions
To allow for configurable and overrideable service bindings, each module's `config/config.php` file should contain a `'bindings'` array. This array maps interface FQCNs (Fully Qualified Class Names) to their concrete implementation FQCNs.

**Example (`modules/User/config/config.php`):**
```php
<?php

return [
    // ... other config ...
    'bindings' => [
        \Modules\User\Contracts\Services\AuthService::class => \Modules\User\Services\AuthService::class,
        \Modules\User\Contracts\Services\UserService::class => \Modules\User\Services\UserService::class,
    ],
];
```

Module Service Providers (e.g., `UserServiceProvider`) are responsible for loading these bindings, typically by:
1.  Calling `mergeConfigFrom(module_path($this->name, 'config/config.php'), $this->nameLower);` to load the module's config into the global Laravel configuration.
2.  Iterating through `config('{module_name}.bindings')` and registering them using `$this->app->bind($interface, $implementation);`. This should be done in the `boot()` method of the module's main Service Provider to ensure module details are resolved.

### Testing (Pest)
*   All new features must include tests.
*   Tests reside in `modules/{Module}/tests/`.
*   **Naming:** `ARCH_TESTS.php` (Architecture), `Feature/`, `Unit/`.
*   **Execution:** Run `vendor/bin/pest` from the root.

---

## 3. Workflow for AI Agent

### Analysis Phase
1.  Read `modules/{Target}/module.json` and `composer.json` to understand dependencies.
2.  Check `phpunit.xml` to understand the test environment (SQLite :memory:).
3.  Search for existing implementations in `Shared` or `User` to avoid duplication.

### Implementation Phase
1.  **Scaffold**: When creating a new module, ensure all standard directories (`src`, `database`, `tests`, `routes`) are present.
2.  **Register**: Update `monorepo-builder.php` if adding a new root path (rare).
3.  **Dependencies**: If a module needs a package, add it to the *module's* `composer.json`, then run `composer update` at root (via merge-plugin).

### Verification
1.  **Lint**: Run `composer pint`.
2.  **Test**: Run `vendor/bin/pest`.
3.  **Validate**: Ensure no circular dependencies between modules.

---

## 4. Response Style (Aesthetic-Natural)

*   **Concise**: direct answers, minimal fluff.
*   **Technical**: Focus on the code and architecture.
*   **Safe**: Always verify file paths before writing.

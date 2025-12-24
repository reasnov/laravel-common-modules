# Laravel Common Modules Monorepo Documentation Overview

**Laravel Common Modules Monorepo** is a collection of reusable Laravel modules designed to accelerate application development. It is built with a **Modular Monolith** approach, ensuring that business rules are centralized in a service-oriented logic layer while maintaining a pragmatic separation of concerns.

This `docs` directory is the central repository for all project documentation. It provides comprehensive information for developers, from high-level architectural concepts to detailed implementation guides and internal specifications.

---

**Table of Contents**

-   [Laravel Common Modules Monorepo Documentation Overview](#laravel-common-modules-monorepo-documentation-overview)
    -   [Project Description](#project-description)
    -   [1. Master Documentation (`docs/master/`)](#1-master-documentation-docsmaster)
    -   [2. Version-Specific Documentation (`docs/vx.x/`)](#2-version-specific-documentation-docsvxx)
    -   [3. Internal & Specification Documents (`docs/master/internal/`)](#3-internal--specification-documents-docsmasterinternal)

---

## Project Description

This monorepo serves as a foundation for Laravel projects. Key features include:

-   **Module-based isolation:** Clean separation of features (e.g., User, Permission, Shared).
-   **Service-oriented logic:** Business rules reside in dedicated Service classes.
-   **Modern Stack:** Powered by Laravel 12, Livewire 3, and Volt.

## 1. Master Documentation (`docs/master/`)

This directory contains the primary and authoritative documentation for developers working on the Laravel Common Modules Monorepo. It focuses on the core principles, development workflows, and essential tools.

## 2. Version-Specific Documentation (`docs/vx.x/`)

These directories (e.g., `docs/v1.0/`, `docs/v2.0/`) are reserved for version-specific documentation. As the project evolves, separate documentation sets can be maintained for different major versions. Each `docs/vx.x/` directory is expected to contain an `overview.md` file summarizing its contents.

## 3. Internal & Specification Documents (`docs/master/internal/`)

This directory houses core planning and foundational design documents. These documents are crucial for understanding the "why" and "what" behind the modules' existence and structure within this monorepo.

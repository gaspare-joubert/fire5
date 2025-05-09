# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/en/2.0.0/).

## [Unreleased]

## [0.8.0] - 2025-05-09

### Added
- Content Security Policy (CSP) support for enhanced security
- Alert auto-dismiss functionality for success messages
- Dynamic breadcrumbs to user views for improved navigation
- User deletion functionality with cascade handling
- Reusable notification modal partial

### Changed
- Improved password security with stricter validation rules
- Refactored type hints, null safety, and method annotations for better code quality
- Enhanced admin user update process to retrieve sorted related data
- Updated UI structure for better layout consistency
- Refactored file upload route to include user ID parameter
- Enhanced file upload UX with loading state feedback
- Renamed partials to use underscore-prefixed filenames

### Fixed
- Updated Larastan include path in phpstan.neon
- Fixed inconsistent message keys and return types for user responses
- Updated file name reference to use `original_name` in file upload template

### Dependencies
- Upgraded `league/commonmark` to version 2.7.0
- Replaced `nunomaduro/larastan` with `larastan/larastan`

## [0.7.0] - 2025-05-06

### Added
- User edit functionality with proper validation and authorization
- File upload capabilities on user edit page
- Session-based flash messages for success and error states
- User ownership check middleware for improved access control

### Changed
- Refactored user handling to support address creation during updates
- Enhanced user interface with flash message support for better feedback
- Updated route naming and access control logic

### Fixed
- Corrected edit route in admin users view to use proper 'web.users.edit' route
- Removed redundant 'is_admin' requirement from UserStoreRequest

## [v0.6.0] - 2025-05-04

### Added
- File management functionality:
  - New `File` model with migration, factory, and seeder
  - File upload API with validation and secure storage
  - `FileService` singleton for centralized file operations
  - Route endpoints for managing file uploads
- Contact management:
  - Contact model with many-to-many user relationships
  - Migrations for `contacts` and `contact_user` pivot tables
  - ContactFactory and ContactSeeder for test data generation
- Address functionality:
  - One-to-one relationship between User and Address models
  - Database migration, factory, and seeder for addresses
- Enhanced database seeding:
  - Added `admin` state to UserFactory
  - Implemented UserSeeder with 4 regular users and 1 admin user

## [v0.5.0] - 2025-05-04

### Added
- Admin user management functionality:
    - New admin user listing page with pagination support
    - Admin-specific routes under `/admin` prefix
    - `AdminAccess` middleware for authorization
    - Admin role support with `is_admin` field
    - Gate definition for admin authorization

### Changed
- Refactored route structure for better organization:
    - Separated API and web routes with clearer grouping
    - Added middleware for protected routes
    - Introduced `home` method in `UserController` for redirect logic

### Security
- Restricted user routes with appropriate authentication middleware
- Added user authentication via login endpoint
- Improved error handling for user creation and management

## [0.4.0] - 2025-05-03

### Added
- Login functionality with dedicated route and view
- Enhanced authentication flow with login interface
- Hover effects for links and buttons in navigation bar

### Changed
- Refactored user creation flow with improved error handling
- Enhanced UserService to handle exceptions during user creation
- Updated UserController for better redirection logic based on user roles
- Improved feedback for failed account creation in user interface
- Refactored localization implementation
- Updated user views with i18n support

### Removed
- Unused dashboard route

## [0.3.0] - 2025-05-03

### Added
- User registration functionality with new UserController
- CRUD operations for user management
- Laravel Sanctum for API authentication
- Versioned API routes with proper prefixing
- Authenticated route to fetch current user details
- RouteServiceProvider to handle route configurations
- Rate limiting for API requests
- Flowbite UI component library
- Support for related packages including @popperjs/core and flowbite-datepicker

### Changed
- Updated dependencies including Tailwind CSS, Vite, and Autoprefixer

## [0.2.0] - 2025-05-01

### Added
- `.nvmrc` file to enforce Node.js version v20.12.0.
- PHPStan for static code analysis.
- GitHub Actions workflow for running PHPStan checks.
- Laravel Debugbar (`barryvdh/laravel-debugbar`) dependency for enhanced development debugging.
- `package-lock.json` file for consistent Node.js dependency installations.

## [0.1.0] - 2025-04-30

### Added
- Initial project structure and setup.

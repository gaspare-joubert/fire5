<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Fire5

Fire5 is a web application built on the Laravel framework. It is a standard CRUD based workflow where users can register, login, edit and update their account details. 
The application also has a basic API layer to provide the same CRUD functionality programmatically.

## Table of Contents

*   [About Fire5](#about-fire5)
*   [Features](#features)
*   [Installation](#installation)
*   [Static Analysis with PHPStan](#static-analysis-with-phpstan)
*   [Usage](#usage)
*   [API Endpoints](#api-endpoints)
*   [Security](#security)
*   [User Deletion](#user-deletion)
*   [Changelog](#changelog)
*   [License](#license)

## Features

*   User account management (viewing, editing, and updating their own account details). Note that each user can have multiple contacts associated with them, although full contact management functionality is outside the scope of this project.
*   Admin user management (listing and deleting users)
*   Secure authentication using Laravel Sanctum.
*   API endpoints for user management.
*   File upload functionality for users. Full file management functionality is outside the scope of this project.
*   Content Security Policy (CSP) for enhanced security.
*   Dynamic breadcrumbs for improved navigation.
*   Flash and modal messages for user feedback.
*   User ownership check middleware for access control.
*   Uses Flowbite UI components for a modern look and feel.

## Installation

This project utilizes [Vite](https://vitejs.dev/) and [Tailwind CSS](https://tailwindcss.com/) + [Flowbite](https://flowbite.com/) for managing frontend assets.

Follow these steps to get Fire5 up and running on your local machine:

1.  **Prerequisites:**
    *   PHP 8.2 (version compatible with Laravel v12.x)
    *   Composer
    *   Node.js (v20.12.0 as specified in `.nvmrc`)
    *   npm
    *   MySQL database

2.  **Clone the repository:**

    ```bash
    git clone https://github.com/gaspare-joubert/fire5.git or git@github.com:gaspare-joubert/fire5.git
    cd fire5
    ```

3.  **Install PHP Dependencies:**

    ```bash
    composer install
    ```

4.  **Environment File Setup:**
    *   Copy the example environment file:

        ```bash
        cp .env.example .env
        ```
    *   Edit the `.env` file and update the database connection details and any other necessary environment variables.

5.  **Database Setup:**
    *   Create a new MySQL database for the project.
    *   Run database migrations:

        ```bash
        php artisan migrate
        ```
    *   **Run database seeder as the web user:**

        ```bash
        sudo -u www-data php artisan db:seed
        ```
        (Note: `www-data` is a common web user, your system might use a different user. Adjust the command accordingly.)

6.  **Install Node.js Dependencies:**

    ```bash
    npm install
    ```
    
7.  **Configure Vite:**
    *   The `vite.config.js` file includes settings tailored for development within a Docker container, specifically for Hot Module Replacement (HMR). If you are using a Docker environment, ensure the `server.hmr.host` setting in `vite.config.js` is correctly configured to your container's hostname or IP address.

8. **Configure Tailwind:**
   * Tailwind configuration happens in `tailwind.config.js` and this is where you can make changes to your Tailwind setup, if needed.

9. **Build Assets:**

    ```bash
    npm run dev
    ```
    or for production:
    ```bash
    npm run build
    ```

10. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

11. **Running the Application:**
    *   You can serve the application using the Laravel development server:

        ```bash
        php artisan serve
        ```
    *   Alternatively, configure a web server like Nginx or Apache to point to the `public` directory.

## Development

### Static Analysis with PHPStan

*   This project uses [PHPStan](https://phpstan.org/) for static analysis to help maintain code quality.

*   To run PHPStan checks locally, use the following command:

    ```bash
    composer phpstan
    ```

*   The PHPStan analysis level and other configurations can be adjusted in the `phpstan.neon` file.

## Usage

Once the application is installed and running:

*   **Registration:** New users can register for an account via the registration page.
*   **Login:** Registered users can log in to access their accounts.
*   **Account Management:** Authenticated users can view and edit their own account details.
*   **File Upload:** Authenticated users can upload files to their accounts.
*   **Admin Access:** Users with the admin role have access to an admin panel to manage all user accounts (view, edit, and delete).
*   **API Usage:** The application includes a basic API for user management. You can explore the available endpoints using a tool like Postman. The API uses Laravel Sanctum for authentication.

## API Endpoints

Here is a list of the available API endpoints:

*   **POST /api/v1/login**
    *   **Description:** Authenticates a user and returns an API token. (Guest access)
*   **POST /api/v1/users**
    *   **Description:** Registers a new user. (Guest access)
*   **GET /api/v1/user**
    *   **Description:** Retrieves details of the currently authenticated user. (Authenticated access)
*   **GET /api/v1/admin/users**
    *   **Description:** Lists all users in the system. (Admin access)
*   **PATCH /api/v1/admin/users/{id}**
    *   **Description:** Updates a specific user's details. (Admin access)
*   **DELETE /api/v1/admin/users/{id}**
    *   **Description:** Deletes a specific user. (Admin access)
*   **GET /api/v1/users/{user}**
    *   **Description:** Retrieves details of a specific user. (Authenticated access with ownership check)
*   **PUT /api/v1/users/{user}**
    *   **Description:** Updates a specific user's details (full update). (Authenticated access with ownership check)
*   **PATCH /api/v1/users/{user}**
    *   **Description:** Updates a specific user's details (partial update). (Authenticated access with ownership check)

## Security

*   **Content Security Policy (CSP):** The project includes support for Content Security Policy. Currently, `LocalDevelopmentPolicy` is implemented, which is set to report violations without blocking requests. This allows for monitoring and identification of potential CSP issues during development. You can find the policy definitions in the `app/CSP/Policies` directory. For production environments, you would typically configure the `ProductionPolicy` for a more restrictive policy.

## User Deletion

User deletion in Fire5 is handled using a hybrid approach that combines database-level cascade deletions with application-level logic. This ensures data integrity, performance, and flexibility while supporting GDPR compliance.

**Database-Level Cascades:**

The following related entities are automatically deleted at the database level when a user is deleted:

| Entity                     | Table          | Relationship | Notes                   |
|----------------------------|----------------|--------------|-------------------------|
| Address                    | `addresses`    | One-to-One   | User address            |
| Files                      | `files`        | One-to-Many  | Database records only   |
| Contact User Relationships | `contact_user` | Pivot Table  | Only the relationships  |

**Application-Level Handling:**

In addition to database cascades, the following operations are handled at the application level:

*   Physical files associated with the user are removed from storage.
*   Contacts that were only associated with the deleted user are also deleted.
*   A `UserDeleted` event is fired to allow other parts of the application to respond to user deletion.

**Note on Orphaned Contacts:** While the application-level handling attempts to delete contacts solely associated with the deleted user, it is possible for orphaned contact records to remain in the database in certain scenarios (e.g., if a contact was temporarily associated with multiple users and one is deleted). A scheduled job to periodically clean up orphaned contacts is recommended for production environments but is outside the current scope of this project.

For more detailed information on the user deletion strategy, including the rationale and guidelines for making changes, please refer to the [DELETION_STRATEGY.md](DELETION_STRATEGY.md) file.

## Changelog

For detailed information on changes in each version, please refer to the [CHANGELOG.md](CHANGELOG.md) file.

## License

The Fire5 project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

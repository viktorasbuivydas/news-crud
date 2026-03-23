# News CRUD

A news article management application built with Laravel 13, PHP 8.3, and Tailwind CSS v4. Authenticated users can create, edit, soft-delete, restore, and permanently delete articles. Public visitors can browse and read published articles.

## Installation

```bash
# Clone the repository
git clone https://github.com/viktorasbuivydas/news-crud.git
cd news-crud

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate

Command down bellow will seed 100 articles
php artisan db:seed --class=ArticleSeeder

# Build frontend assets
npm run build

# Start the application
php artisan serve
```

For development with hot-reloading, run `npm run dev` in a separate terminal instead of `npm run build`.

### Default Test Credentials

You can easily register an acount

## Features

- **Public article listing** with pagination
- **User authentication** (login, register, logout)
- **Full CRUD** for articles behind authenticated dashboard
- **Soft deletes** with restore and permanent delete options
- **Article filtering** by published/trashed status in dashboard
- **Form validation** via dedicated Form Request classes
- **Service layer** (`ArticleService`) for business logic separation

## Project Structure

The application separates public-facing pages from the authenticated dashboard:

- `ArticleController` — handles public article listing and viewing at `/` and `/articles/{article}`
- `DashboardArticleController` — handles full CRUD at `/dashboard/articles/*` (requires auth)
- `AuthController` — login, register, logout

The dashboard and public index views are intentionally separated into distinct controllers and view directories for easier maintainability.

## Tech Stack

| Layer      | Technology                    |
|------------|-------------------------------|
| Backend    | Laravel 13, PHP 8.3          |
| Frontend   | Blade, Tailwind CSS v4, Vite |
| Database   | SQLite (default)             |
| Testing    | Pest v4                      |
| Auth       | Laravel session-based        |

## Suggested Improvements

- **Policies and authorization** — Currently any authenticated user can edit or delete any article. Laravel Policies should be added to ensure users can only edit and delete their own articles. This requires adding a `user_id` foreign key to the `articles` table and creating an `ArticlePolicy` with `update`, `delete`, `restore`, and `forceDelete` gates.
- **User roles** — Introduce roles (e.g. admin, editor, author) for managing articles. Admins could manage all articles while authors are restricted to their own. A package like `spatie/laravel-permission` or a simple role column on the `users` table would support this.
- **Ensure users can only edit their own articles** — Tie articles to their author via a `user_id` column, then use a policy to scope edit/delete actions to the owning user (or admin role).
- **API resources** — Add Eloquent API Resources for a potential REST API layer.
- **Testing coverage** — Expand Pest feature tests covering article CRUD operations, authorization, and edge cases.
- **Image/media uploads** — Support featured images or inline media for articles.
- **Article status workflow** — Add draft/published/archived statuses beyond the current soft-delete approach.
- **Search** — Full-text search across article titles and content.

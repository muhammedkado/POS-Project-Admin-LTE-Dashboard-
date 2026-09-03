# Kado POS — Admin Dashboard

A Point of Sale back-office built with Laravel 10 and an AdminLTE 2 dashboard: products, categories, clients and role-based user management (Laratrust), with English/Arabic (RTL) support.

## Live demo

**https://pos.mkado.dev**

| Role | Email | Password |
|---|---|---|
| Super Admin | `superadmin@app.com` | `password` |
| Admin | `admin@app.com` | `password` |
| Viewer | `user@app.com` | `password` |

Registration is disabled — sign in with one of the accounts above. These three accounts are protected: they can't be edited or deleted by any visitor. All other demo data resets every night at 03:00 UTC (`deploy/reseed.sh`), so feel free to add, edit or delete products/categories/clients/other users.

## Tech stack

- Laravel 10, PHP 8.1+
- MySQL
- Laratrust (roles & permissions)
- mcamara/laravel-localization (English / Arabic, RTL)
- AdminLTE 2 (vendored static assets, no frontend build step required)

## Local setup

```sh
git clone https://github.com/muhammedkado/POS-Project-Admin-LTE-Dashboard-.git
cd POS-Project-Admin-LTE-Dashboard-
composer install
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations and seed demo data (creates the three accounts above, 10 categories, 50 products, 30 clients):

```sh
php artisan migrate --seed
php artisan serve
```

Product/user image uploads are written directly to `public/uploads/` — no `storage:link` needed.

## Project structure

- `app/` — application code (controllers, models, middleware)
- `config/` — configuration files, including `demo.php` (protected demo accounts)
- `database/` — migrations, seeders and factories
- `public/dashboard_files/` — vendored AdminLTE 2 assets
- `resources/views/` — Blade views
- `routes/` — route definitions (`web.php`, `dashboard/web.php`)
- `deploy/` — nginx config, PHP-FPM pool, deploy and nightly reseed scripts

## Features

- **Users** — create/edit/delete, assign roles and permissions, upload avatars
- **Products** — CRUD, category assignment, pricing and stock, image upload
- **Categories** — CRUD, product counts
- **Clients** — CRUD, multiple phone numbers, addresses
- **Dashboard** — live counts, inventory value, low-stock list, latest products, products-per-category breakdown


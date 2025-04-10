# Laravel POS System with Admin LTE Dashboard

A robust Point of Sale (POS) system built with Laravel and featuring Admin LTE Dashboard integration.

## Features

- User Authentication and Authorization
- Role-based Access Control
- Product Management
- Category Management  
- Client Management
- Multilingual Support
- Responsive Admin Dashboard
- Image Upload Capabilities

## Tech Stack

- Laravel Framework
- MySQL Database
- Admin LTE 2.0 Dashboard Template
- Bootstrap CSS Framework
- jQuery

## Requirements

- PHP >= 7.4
- MySQL >= 5.7
- Composer
- Node.js & NPM

## Installation

1. Clone the repository
```sh
git clone https://github.com/muhammedkado/POS-Project-Admin-LTE-Dashboard-.git
cd pos-project
```

2. Install PHP dependencies
```sh
composer install
```

3. Install frontend dependencies 
```sh
npm install
```

4. Create and setup .env file
```sh
cp .env.example .env
php artisan key:generate
```

5. Configure your database in .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations and seeders
```sh
php artisan migrate --seed
```

7. Create storage link
```sh
php artisan storage:link
```

8. Start the development server
```sh
php artisan serve
```

## Project Structure

- `app/` - Contains core application code
- `config/` - All configuration files
- `database/` - Database migrations and seeders
- `public/` - Publicly accessible files
- `resources/` - Views, raw assets etc.
- `routes/` - All route definitions
- `storage/` - Application storage

## Features Details

### User Management
- Create/Edit/Delete users
- Assign roles and permissions
- Upload user avatars

### Product Management
- Add/Edit/Delete products
- Assign categories
- Set pricing and stock levels
- Upload product images

### Category Management
- Create/Edit/Delete categories
- View products by category
- Track product counts

### Client Management
- Add/Edit/Delete clients
- Store multiple phone numbers
- Track client addresses

## Contributing
Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
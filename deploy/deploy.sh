#!/usr/bin/env bash
# Deploy/update this app at /var/www/pos on the VPS. Run as the `deploy` user.
set -euo pipefail
cd /var/www/pos

git pull origin main
composer install --no-dev --optimize-autoloader --no-interaction

if [ ! -f .env ]; then
    cp .env.production.example .env
    php artisan key:generate --force
fi

php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

sudo systemctl reload php8.3-fpm
echo "POS deployed."

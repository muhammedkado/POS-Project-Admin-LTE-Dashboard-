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
# NOT route:cache — mcamara/laravel-localization builds the locale prefix per
# request via LaravelLocalization::setLocale(). A cached route table freezes
# whatever locale was active when it was built (the default, unprefixed), and
# every /ar/... URL the language switcher produces then 404s.
php artisan route:clear
php artisan view:cache

sudo systemctl reload php8.3-fpm
echo "POS deployed."

#!/usr/bin/env bash
# Nightly reset of the public demo — run from /etc/cron.d/demo-reseed.
set -euo pipefail
cd /var/www/pos

php artisan migrate:fresh --seed --force

# Remove any images uploaded by visitors, keep the shipped defaults.
find public/uploads/product_images -type f ! -name 'default.jpg' -delete
find public/uploads/user_images -type f ! -name 'default.png' -delete

php artisan cache:clear

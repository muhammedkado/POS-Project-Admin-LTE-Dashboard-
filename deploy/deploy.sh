#!/usr/bin/env bash
# POS — server-side deploy step.
#
# Runs ON the server as `ubuntu`, after the code has been pushed into the git
# repo at /var/www/pos. That repo has receive.denyCurrentBranch=updateInstead,
# so `git push server HEAD:demo-deploy` from the workstation checks the branch
# out in place; this script then does everything the checkout cannot.
# It is driven by deploy.sh in the mkado-dev workspace:
#     ./deploy.sh pos
# Safe to re-run. Never creates or edits .env — that file is managed by hand.
set -euo pipefail
cd /var/www/pos
[ -f .env ] || { echo "!! /var/www/pos/.env is missing; this script never creates it" >&2; exit 1; }

# Dev dependencies stay installed: the nightly reseed (migrate:fresh --seed)
# needs Faker, which is a dev dependency.
composer install --optimize-autoloader --no-interaction --no-progress --quiet
php artisan migrate --force --no-interaction
php artisan config:cache
php artisan route:clear    # mcamara/laravel-localization cannot be route-cached
php artisan view:cache
sudo systemctl reload php8.3-fpm
echo "pos: live at $(git rev-parse --short HEAD) — $(git log -1 --format=%s | cut -c1-70)"

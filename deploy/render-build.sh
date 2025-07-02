#!/usr/bin/env bash

# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate application key
php artisan key:generate --force

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix permission
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Jika perlu migrasi database (uncomment jika sudah yakin)
# php artisan migrate --force

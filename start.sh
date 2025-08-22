#!/usr/bin/env bash
set -e

# Generate APP_KEY kalau belum ada dari env
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force || true
fi

# Link storage (idempotent)
php artisan storage:link || true

# Jalankan migrasi (abaikan error jika sudah)
php artisan migrate --force || true

# Jalankan Apache
exec apache2-foreground

#!/usr/bin/env bash
set -e

# Laravel bootstrap
php artisan storage:link || true
php artisan config:cache
php artisan route:cache

# Jalankan migrasi (biar DB selalu up-to-date)
php artisan migrate --force || {
  echo "WARNING: migrate gagal. Cek env DB kamu."
}

# Jalankan Apache (foreground)
exec apache2-foreground

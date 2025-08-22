#!/bin/bash
set -e

echo "🚀 Starting Laravel + Apache container..."

# Tunggu database up (optional, bisa dihapus kalau DB sudah pasti ready)
if [ -n "$DB_HOST" ]; then
  echo "⏳ Waiting for database $DB_HOST..."
  until nc -z -v -w30 $DB_HOST ${DB_PORT:-3306}; do
    echo "Database is unavailable - sleeping"
    sleep 3
  done
  echo "✅ Database is up!"
fi

# Jalankan migrate + cache config
echo "⚙️ Running migrations..."
php artisan migrate --force || true

echo "⚡ Optimizing Laravel cache..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Pastikan permission bener
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan Apache foreground
echo "🌍 Starting Apache..."
exec apache2-foreground

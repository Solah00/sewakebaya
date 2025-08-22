# Gunakan PHP + Apache
FROM php:8.2-apache

# Paket sistem yang dibutuhkan
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl \
    && a2enmod rewrite

# DocumentRoot ke /public
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# Workdir
WORKDIR /var/www/html

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy source code
COPY . /var/www/html

# Install dep (tanpa dev) + optimasi
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress \
 && php artisan config:clear || true \
 && php artisan route:clear || true \
 && php artisan view:clear  || true \
 && chown -R www-data:www-data storage bootstrap/cache

# Script start
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80
CMD ["start.sh"]

# Gunakan PHP 8 dengan Apache
FROM php:8.1-apache

# Install dependency Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin semua file ke dalam container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Set permission (opsional tergantung error)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Install dependency Laravel
RUN composer install --no-interaction --optimize-autoloader

# Copy konfigurasi Apache agar mengarah ke public/
RUN echo "DocumentRoot /var/www/html/public" > /etc/apache2/sites-enabled/000-default.conf

# Aktifkan mod_rewrite (wajib untuk Laravel routing)
RUN a2enmod rewrite

# Copy file .env.production jika kamu buat secara khusus
# COPY .env.production .env

FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip zip git curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy all project files
COPY . .

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=${PORT}

# Gunakan PHP 8.1 + Apache
FROM php:8.1-apache

# Install dependencies dan ekstensi untuk Laravel + MySQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring xml

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy semua file project
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permission untuk folder storage & cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Clear cache Laravel supaya environment baru terbaca
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan route:clear
RUN php artisan view:clear

# Expose port 80
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]

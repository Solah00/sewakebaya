# Gunakan PHP 8.1 FPM
FROM php:8.1-apache

# Install dependency sistem dan PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Set DocumentRoot ke public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Konfigurasi Apache untuk Laravel
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy semua file Laravel ke container
COPY . /var/www/html

# Set permission storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]

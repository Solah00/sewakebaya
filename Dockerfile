# Gunakan PHP 8.1 + Apache
FROM php:8.1-apache

# Install dependencies dasar + GD libraries
RUN apt-get update && apt-get install -y \
    git unzip libonig-dev libxml2-dev libzip-dev zip curl \
    libpng-dev libjpeg-dev libfreetype6-dev pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Suppress ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy seluruh project
COPY . .

# Copy Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permission yang tepat
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Configure Apache untuk Laravel public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]

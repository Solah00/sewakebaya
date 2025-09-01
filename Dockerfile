# Gunakan PHP 8.1 FPM dengan Apache
FROM php:8.1-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install dependencies PHP dan system tools
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file Laravel
COPY . .

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permissions storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]

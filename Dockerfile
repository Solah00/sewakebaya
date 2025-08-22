FROM php:8.2-apache

# System deps
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache features
RUN a2enmod rewrite

# Set DocumentRoot ke /public (ini kunci)
RUN printf '%s\n' \
    '<VirtualHost *:80>' \
    '  ServerName localhost' \
    '  DocumentRoot /var/www/html/public' \
    '  <Directory /var/www/html/public>' \
    '    AllowOverride All' \
    '    Require all granted' \
    '  </Directory>' \
    '</VirtualHost>' \
    > /etc/apache2/sites-available/000-default.conf

# Copy kode
WORKDIR /var/www/html
COPY . .

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permission Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Start script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

CMD ["/usr/local/bin/start.sh"]

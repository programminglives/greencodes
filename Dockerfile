# Use the official PHP image with PHP 8.2 and Apache
FROM php:8.2-apache

# Set the document root to the Laravel public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update the default Apache configuration
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y git curl libpng-dev libjpeg-dev libfreetype6-dev libonig-dev zip unzip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring exif pcntl bcmath


# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files to the container
COPY . /var/www/html

RUN addgroup --gid 1000 www && \
    useradd -u 1000 -g www -m www

# Change owners and give permission to Laravel's storage and cache folders
RUN chown -R www:www /var/www/html/

RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

USER www

# Expose port 80 for the web server
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]

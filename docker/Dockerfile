FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip sockets

# Install and enable Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy entrypoint script into container
# COPY entrypoint.sh /var/www/docker/entrypoint.sh

# Set permissions
RUN chown -R www-data:www-data /var/www


COPY . /var/www

# Expose PHP-FPM port
EXPOSE 9000

CMD ["php-fpm"]
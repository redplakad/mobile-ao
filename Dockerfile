# Stage 1: Builder
FROM dunglas/frankenphp:php8.3 AS builder

# Set working directory
WORKDIR /app

# Copy kode sumber
COPY . .

# Update package lists
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-enable zip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pcntl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod -R 777 /app/storage /app/bootstrap/cache

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

RUN composer require laravel/octane

RUN php artisan octane:install --server=frankenphp

# Expose port untuk aplikasi
EXPOSE 8080

# Start server
#CMD ["php artisan octane:frankenphp", "--workers", "4", "--host", "0.0.0.0:8080"]

CMD ["php", "artisan", "octane:frankenphp", "--workers", "4"]
# syntax=docker/dockerfile:1

# Use PHP base image with required extensions
FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libzip-dev \
    libsqlite3-dev \
    pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_sqlite \
        zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy application files
COPY storage/app/templates/contact-template.csv storage/app/templates/contact-template.csv
# Ensure required Laravel directories exist
RUN mkdir -p /opt/render/project/src/database && \
    touch /opt/render/project/src/database/database.sqlite && \
    mkdir -p storage/framework/views storage/framework/cache storage/logs bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Copy .env.example to .env (used for config and key generation)
RUN cp .env.example .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel app key
RUN php artisan key:generate

# Run database migrations
RUN php artisan migrate --force

# Expose Laravel's default port
EXPOSE 8000

# Start the Laravel development server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
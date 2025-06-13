# syntax=docker/dockerfile:1

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

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Ensure SQLite database and Laravel paths
RUN mkdir -p database && touch database/database.sqlite \
    && cp .env.example .env \
    && mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Install dependencies and set up Laravel
RUN composer install --no-dev --optimize-autoloader \
    && php artisan key:generate \
    && php artisan migrate --force

# Expose port
EXPOSE 8000

# Start the Laravel app
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
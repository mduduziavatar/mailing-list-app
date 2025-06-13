# Start from the official PHP image with common extensions
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Create SQLite database file
RUN mkdir -p database && touch database/database.sqlite

# Generate key and run migrations
RUN php artisan key:generate
RUN php artisan migrate --force

# Serve using PHP built-in server
CMD php -S 0.0.0.0:8000 -t public
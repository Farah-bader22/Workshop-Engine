# Stage 1: Build Assets (Vue 3)
FROM node:18 AS asset-builder
WORKDIR /app
COPY . .
RUN npm install --legacy-peer-deps && npm run build

# Stage 2: PHP Environment (Laravel)
FROM php:8.2-fpm
WORKDIR /var/www

# Install System Dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nginx libpq-dev


RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Copy Project Files
COPY --from=asset-builder /app /var/www

# Install Composer Dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Setup Permissions for Storage
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Port and Start Command
EXPOSE 80

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-80}

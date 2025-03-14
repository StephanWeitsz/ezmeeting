FROM php:8.2-fpm

WORKDIR /var/www/html/

# Essentials
RUN echo "UTC" > /etc/timezone

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel globally
RUN composer global require laravel/installer

# Create a new Laravel project
RUN laravel new app

# Set Laravel project as working directory
WORKDIR /var/www/html/app

# Install your package from GitHub (replace with actual repo)
RUN composer config repositories.your-package vcs https://github.com/yourusername/your-package.git
RUN composer require yournamespace/your-package

# Set file permissions
RUN chown -R www-data:www-data /var/www/html/app/storage /var/www/html/app/bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Start Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

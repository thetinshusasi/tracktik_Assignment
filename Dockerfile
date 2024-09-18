# Use the official PHP-FPM image as a base image
FROM php:8.1-fpm

# Install necessary system dependencies
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libonig-dev \
    git \
    && docker-php-ext-install curl mbstring

# Set the working directory inside the container
WORKDIR /var/www/html/

# Copy the application files from the host to the container
COPY . /var/www/html/

# Install Composer by copying it from a specific version of the Composer image
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies using Composer
RUN composer install

# Expose port 9000 for PHP-FPM
EXPOSE 9000
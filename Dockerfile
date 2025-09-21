# Classera EMS Dockerfile
FROM php:7.4-apache

# Set maintainer information
LABEL maintainer="Classera <support@classera.com>"
LABEL description="Classera EMS - Education Management System"
LABEL version="1.0.0"

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libgd-dev \
    libicu-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install Composer (optional - for future use)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create necessary directories
RUN mkdir -p /var/www/html/tmp/cache/models \
    && mkdir -p /var/www/html/tmp/cache/persistent \
    && mkdir -p /var/www/html/tmp/cache/views \
    && mkdir -p /var/www/html/logs

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/tmp \
    && chmod -R 777 /var/www/html/logs

# Configure Apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Configure PHP
COPY docker/php/php.ini /usr/local/etc/php/php.ini

# Expose port 80
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Start Apache
CMD ["apache2-foreground"]

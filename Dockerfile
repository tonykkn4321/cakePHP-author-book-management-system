FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    unzip \
    git \
    zip \
    curl \
    && docker-php-ext-install intl pdo pdo_pgsql pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Make CakePHP CLI executable
RUN chmod +x bin/cake

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --prefer-dist

# Run migrations on container start
CMD ["sh", "-c", "bin/cake migrations migrate && apache2-foreground"]

# Expose port
EXPOSE 80

# Optional: Healthcheck for container readiness
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
  CMD curl -f http://localhost || exit 1

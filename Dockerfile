FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    unzip \
    git \
    zip \
    curl \
    && docker-php-ext-install intl pdo pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Make CakePHP CLI executable
RUN chmod +x bin/cake

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Run migrations on container start
CMD ["sh", "-c", "bin/cake migrations migrate && apache2-foreground"]

# Expose port
EXPOSE 80

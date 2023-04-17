FROM php:8.1-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    curl \
    libpng \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    zlib-dev \
    libzip-dev \
    g++ \
    make \
    autoconf \
    automake \
    libtool \
    git \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql bcmath exif pcntl gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a new user called `laraveluser`
RUN addgroup -g 1001 laraveluser && \
    adduser -D -u 1001 -G laraveluser laraveluser

# Change working directory
WORKDIR /var/www/html


# Copy project files
COPY . .

## Set file permissions
RUN chown -R laraveluser:laraveluser . && \
    chmod -R 755 ./storage && \
    chmod -R 755 ./bootstrap/cache

# Run Composer install as `laraveluser` user
USER laraveluser
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

# Generate Laravel application key
RUN php artisan key:generate

# Start PHP-FPM
CMD ["php-fpm"]

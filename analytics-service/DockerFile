# Stage 1: Builder
FROM php:8.2-fpm-alpine AS build

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Stage 2: Production
FROM php:8.2-fpm-alpine

# Create non-root user
RUN addgroup -g 1000 appuser \
 && adduser -u 1000 -G appuser -s /bin/sh -D appuser

# Copy PHP extensions from build stage
COPY --from=build /usr/local/lib/php/extensions/no-debug-non-zts-*/ /usr/local/lib/php/extensions/

# Install runtime dependencies
RUN apk add --no-cache \
    libpng \
    oniguruma \
    tzdata \
    && cp /usr/share/zoneinfo/UTC /etc/localtime \
    && echo "UTC" > /etc/timezone

# Set workdir
WORKDIR /var/www/html

# Copy application code
COPY --chown=appuser:appuser --from=build /var/www/html /var/www/html

# Switch to non-root user
USER appuser

# Expose PHP-FPM socket (not port)
EXPOSE 9000

# Entrypoint
CMD ["php-fpm"]

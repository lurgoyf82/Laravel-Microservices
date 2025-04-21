# stessa impostazione dello auth‑service
FROM php:8.2-fpm-alpine AS build
RUN apk add --no-cache bash git curl libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev oniguruma-dev icu-dev zip unzip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install pdo_mysql mbstring zip exif pcntl intl bcmath gd
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
#COPY composer.json composer.lock ./
#RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress
RUN echo "<?php phpinfo();" > index.php 
COPY . .
FROM php:8.2-fpm-alpine
RUN addgroup -g 1000 appuser && adduser -u 1000 -G appuser -s /bin/sh -D appuser
RUN apk add --no-cache tzdata && cp /usr/share/zoneinfo/UTC /etc/localtime && echo "UTC" > /etc/timezone && apk del tzdata
COPY --from=build /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=build /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
WORKDIR /var/www/html
COPY --chown=appuser:appuser --from=build /var/www/html /var/www/html
USER appuser
EXPOSE 9000
CMD ["php-fpm"]

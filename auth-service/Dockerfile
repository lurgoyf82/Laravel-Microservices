# ------------ STAGE 1 : BUILD -----------------
FROM php:8.2-fpm-alpine AS build

# pacchetti di sistema essenziali + dev headers per estensioni
RUN apk add --no-cache \
        bash \
        git \
        curl \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        libzip-dev \
        oniguruma-dev \
        icu-dev \
        zip \
        unzip

# estensioni PHP necessarie alla maggior parte dei progetti Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
        intl \
        bcmath \
        gd

# installo Composer dall’immagine ufficiale dist
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# directory di lavoro
WORKDIR /var/www/html

# copio composer files e installo vendor (senza dev, con autoload ottimizzato)
#COPY composer.json composer.lock ./
#RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress
RUN echo "<?php phpinfo();" > index.php 

# copio il resto dell’applicazione (solo codice, escludo node_modules e storage se serve)
COPY . .

# ------------ STAGE 2 : RUNTIME ---------------
FROM php:8.2-fpm-alpine

# creo utente non‑root (uid 1000, come quello tipico di host)
RUN addgroup -g 1000 appuser \
 && adduser  -u 1000 -G appuser -s /bin/sh -D appuser

# copio configurazione timezone di default a UTC
RUN apk add --no-cache tzdata \
 && cp /usr/share/zoneinfo/UTC /etc/localtime \
 && echo "UTC" > /etc/timezone \
 && apk del tzdata

# copio libphp estensioni compilate nello stage build
COPY --from=build /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=build /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

# copio codice applicazione (con vendor già presente) e assegno proprietà
WORKDIR /var/www/html
COPY --chown=appuser:appuser --from=build /var/www/html /var/www/html

# cambio utente
USER appuser

# esporto porta fpm interna
EXPOSE 9000

# comando di avvio
CMD ["php-fpm"]

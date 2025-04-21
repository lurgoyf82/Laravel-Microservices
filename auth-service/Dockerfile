FROM php:8.2-apache AS build
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libicu-dev \
    libexif-dev \
    pkg-config \
    zip \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
      pdo_mysql \
      mbstring \
      zip \
      exif \
      pcntl \
      intl \
      bcmath \
      gd \
 && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY composer.json composer.lock ./

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
FROM php:8.2-apache
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    tzdata \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libicu-dev \
 && ln -sf /usr/share/zoneinfo/Europe/Rome /etc/localtime \
 && echo "Europe/Rome" > /etc/timezone \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
      pdo_mysql \
      gd \
 && apt-get purge -y --auto-remove tzdata \
 && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite headers proxy proxy_http
COPY --from=build /var/www/html /var/www/html
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /var/www/html
EXPOSE 8001
CMD ["apache2-foreground"]

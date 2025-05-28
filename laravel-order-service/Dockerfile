FROM php:8.2-apache AS build

# Install system dependencies and PHP extensions
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    gnupg2 \
    apt-transport-https \
    curl \
    lsb-release \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libicu-dev \
    libexif-dev \
    pkg-config \
    zip \
    libcurl4-openssl-dev \
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
      curl \
 && rm -rf /var/lib/apt/lists/*

# Add Microsoft repository for ODBC drivers
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && echo "deb [arch=amd64] https://packages.microsoft.com/debian/12/prod bookworm main" > /etc/apt/sources.list.d/mssql-release.list

# Install Microsoft ODBC Driver for SQL Server
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y \
    msodbcsql17 \
    unixodbc-dev \
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Install the PHP extensions for SQL Server
RUN pecl install pdo_sqlsrv \
    && pecl install sqlsrv \
    && docker-php-ext-enable pdo_sqlsrv sqlsrv

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY composer.json composer.lock ./

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

FROM php:8.2-apache

# Install necessary libraries and PHP extensions
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    gnupg2 \
    curl \
    ca-certificates \
    apt-transport-https \
    unixodbc-dev \
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

RUN curl -fsSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor -o /usr/share/keyrings/microsoft.gpg
RUN echo "deb [arch=amd64 signed-by=/usr/share/keyrings/microsoft.gpg] https://packages.microsoft.com/debian/12/prod bookworm main" > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y --no-install-recommends msodbcsql18 && rm -rf /var/lib/apt/lists/*


COPY --from=build /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=build /usr/local/etc/php/conf.d    /usr/local/etc/php/conf.d

# Enable Apache modules
RUN a2enmod rewrite headers proxy proxy_http

# Set ServerName to suppress Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy application files from the build stage
COPY --from=build /var/www/html /var/www/html
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
#COPY php.ini /usr/local/etc/php/php.ini
#COPY /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN chown -R www-data:www-data /var/www/html
WORKDIR /var/www/html

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Expose port and set the default command
EXPOSE 80
CMD ["apache2-foreground"]

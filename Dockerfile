FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    curl git libcurl4-openssl-dev libfreetype6-dev libicu-dev \
    libjpeg-dev libonig-dev libpng-dev libpq-dev libxml2-dev \
    libxslt-dev libzip-dev pkg-config unzip zip \
    && docker-php-ext-install intl pdo pdo_pgsql zip opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

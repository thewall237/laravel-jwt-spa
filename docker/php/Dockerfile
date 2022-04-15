FROM php:8.0.2-fpm

# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# install Node.js
COPY --from=node:16.14 /usr/local/bin /usr/local/bin
COPY --from=node:16.14 /usr/local/lib /usr/local/lib

RUN apt-get update && \
    apt-get install -y wget git unzip libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www/html
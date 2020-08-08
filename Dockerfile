FROM composer:latest AS composer

FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip pdo pdo_mysql
RUN pecl install xdebug-2.8.1 \
        && docker-php-ext-enable xdebug

EXPOSE 8000

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
FROM composer:latest AS composer

FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip pdo pdo_mysql

EXPOSE 8000

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

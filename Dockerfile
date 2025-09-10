FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev

RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
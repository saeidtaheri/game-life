FROM php:8.3-fpm

WORKDIR /srv/www

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libzip-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG uid
RUN useradd -G www-data,root -u $uid -d /home/ca ca
RUN mkdir -p /home/ca/.composer && \
    chown -R ca:ca /home/ca

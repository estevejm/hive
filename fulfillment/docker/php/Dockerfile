FROM php:7-fpm

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install opcache

COPY php.ini /usr/local/etc/php/php.ini

RUN usermod -u 1000 www-data

FROM php:7.2-apache

RUN apt-get update && apt-get install nano && docker-php-ext-install \
    pdo_mysql \
    && a2enmod \
    rewrite
RUN apt-get install -y \
        zlib1g-dev
RUN apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

COPY 000-default.conf /etc/apache2/sites-available/


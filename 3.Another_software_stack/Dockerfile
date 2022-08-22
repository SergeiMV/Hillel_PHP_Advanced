FROM php:7.4.1-apache

RUN apt-get update
RUN apt-get install libpq-dev -y
RUN docker-php-ext-install pdo_pgsql

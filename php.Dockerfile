FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo_mysql mysqli pdo \
  && docker-php-ext-enable pdo_mysql

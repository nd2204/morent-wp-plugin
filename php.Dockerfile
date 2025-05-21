FROM php:8.4.7-fpm-alpine

RUN docker-php-ext-install pdo_mysql mysqli pdo \
  && docker-php-ext-enable pdo_mysql

RUN apk add --no-cache curl unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

CMD ["php-fpm"]
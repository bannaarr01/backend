FROM php:8.4.2-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

##additional PHP extensions and deps
#RUN apk add --no-cache \
#    zip \
#    unzip

USER laravel
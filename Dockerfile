# FROM php:8.1.0alpha3-fpm-alpine
# FROM php:7.2-fpm-alpine
FROM php:8.1.0alpha1-fpm-alpine3.14
RUN docker-php-ext-install pdo pdo_mysql
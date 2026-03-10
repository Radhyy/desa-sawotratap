FROM php:8.2-apache

# install dependency
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev

RUN docker-php-ext-install pdo pdo_mysql zip

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy project
COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install

EXPOSE 80
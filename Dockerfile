# https://hub.docker.com/layers/library/php/8.2.1-apache/images/sha256-89ad17cca246e8a6ce742b5b89ce65b34ce6223204a282e45f72b4f758ff6401?context=explore
FROM php:8.2.1-apache

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git

# ext-install
RUN docker-php-ext-install -j "$(nproc)" opcache

# ext-enable
RUN docker-php-ext-enable opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . ./

RUN composer install
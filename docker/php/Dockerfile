FROM php:7-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        libzip-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

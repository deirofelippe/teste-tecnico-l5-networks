FROM php:8.3.14-cli-bookworm

RUN apt update \
    && apt install -y git unzip \
    && pecl install xdebug-3.4.0 \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql xdebug \
    && useradd -u 1000 -m php 

COPY --from=composer:2.8.3 /usr/bin/composer /usr/bin/composer

USER php

ENV PATH=$PATH:/home/php/app/vendor/bin:/home/php/.composer/vendor/bin

WORKDIR /home/php/app

COPY --chown=php:php ./composer.json ./composer.lock ./

RUN composer install

COPY --chown=php:php ./ ./

CMD [ "make", "server" ]

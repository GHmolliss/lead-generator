FROM php:8.4.3-fpm

COPY --from=composer:2.4.2 /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pcntl

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

WORKDIR /var/www/html

COPY . /var/www/html

RUN chown -R www:www /var/www/html

USER www

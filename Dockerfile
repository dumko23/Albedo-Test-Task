FROM php:8.1.1-fpm

COPY local.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
            curl \
            wget \
            git \
            unzip

RUN docker-php-ext-install pdo pdo_mysql


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]
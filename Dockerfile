FROM php:7.4-cli

WORKDIR /app
COPY . .

#missing packages: libfreetype6-dev libpng-dev libjpeg-dev libcurl4-gnutls-dev libyaml-dev libicu-dev libzip-dev
RUN apt-get update && \
        apt-get install -y --no-install-recommends wget \
        libfreetype6-dev \
        libpng-dev \
        libjpeg-dev \
        libcurl4-gnutls-dev \
        libyaml-dev \
        libicu-dev \
        libzip-dev \
        unzip \
        git > /dev/null && \
        apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev > /dev/null

RUN docker-php-ext-install intl gettext gd bcmath zip sockets
RUN pecl install mongodb-1.7.2
RUN echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini


RUN echo "Installing Composer" && rm -rf vendor composer.lock && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer clearcache && \
    composer install

# Refresh laravel config
RUN php artisan config:cache

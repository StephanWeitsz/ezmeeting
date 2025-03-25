FROM alpine:latest

WORKDIR /var/www/html/

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl sqlite nginx supervisor

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP
RUN apk add --no-cache php82 \
    php82-common \
    php82-fpm \
    php82-pdo \
    php82-opcache \
    php82-zip \
    php82-phar \
    php82-iconv \
    php82-cli \
    php82-curl \
    php82-openssl \
    php82-mbstring \
    php82-tokenizer \
    php82-fileinfo \
    php82-json \
    php82-xml \
    php82-xmlwriter \
    php82-simplexml \
    php82-dom \
    php82-pdo_pgsql \
    php82-pdo_mysql \
    php82-pdo_sqlite \
    php82-tokenizer \
    php82-pecl-redis

RUN ln -s /usr/bin/php82 /usr/bin/php

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Install Nodejs and NPM
RUN apk add --update nodejs npm
RUN apk add --update npm

# Configure supervisor
RUN mkdir -p /etc/supervisor.d/
COPY ./docker/supervisord.ini /etc/supervisor.d/supervisord.ini

# Configure PHP
RUN mkdir -p /run/php/
RUN touch /run/php/php8.2-fpm.pid

COPY ./docker/php-fpm.conf /etc/php82/php-fpm.conf
COPY ./docker/php.ini-production /etc/php82/php.ini

# Configure nginx
COPY ./docker/nginx.conf /etc/nginx/
COPY ./docker/nginx-laravel.conf /etc/nginx/modules/

RUN mkdir -p /run/nginx/
RUN touch /run/nginx/nginx.pid

RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

#Setup installer for Laravel and create Portal
RUN composer global require laravel/installer
RUN composer create laravel/laravel portal 

# Building process if needed (installer failes) - Run laravel setup seperatley and perform actions from this point on  

# Setup MUD packages
RUN mkdir -p  packages
COPY ezimeeting/. ./packages

# trouble shooting from here check if laravel is installed and package was copied

# Require telescope
#RUN composer require laravel/telescope

# Install Telescope
#RUN php artisan telescope:install

# Require Jetscreem and liveWire
#RUN composer require laravel/jetstream

# Install Jetstream with Livewire scafolding
#RUN php artisan jetstream:install livewire  --teams

# Install NPM dependencies and build assets
#RUN npm install && npm run build

#RUN composer install --no-dev
#RUN composer install
#RUN composer update
#RUN chown -R nobody:nobody /var/www/html/storage

# Run database migrations
#RUN php artisan migrate
#RUN php artisan db:seed --class="Mudtec\\Ezimeeting\\Database\\Seeders\\EzimeetingDatabaseSeeder"

EXPOSE 80
CMD ["supervisord", "-c", "/etc/supervisor.d/supervisord.ini"]
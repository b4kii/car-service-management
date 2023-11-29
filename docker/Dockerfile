FROM php:8.2.7-fpm

RUN apt-get update \
    && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
#
#RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
#    install-php-extensions http

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

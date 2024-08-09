#Pull da imagem do php-fpm
FROM php:8.2-fpm-alpine

#Pasta raiz do projeto
WORKDIR "/var/www/traumtor"

ARG DEBIAN_FRONTEND=noninteractive

#Adiciona mais algumas dependências
RUN apk add --no-cache openssl pcre-dev libtool \
bash nodejs npm mysql-dev \
git nano \
libxml2-dev yarn

#Adciona as extensoes do php
RUN docker-php-ext-install bcmath pdo pdo_mysql soap pcntl exif

#Adiciona o composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Adiciona extensao GD do php
RUN apk upgrade --update && apk add \
  coreutils \
  freetype-dev \
  libjpeg-turbo-dev \
  libltdl \
  libmcrypt-dev \
  libpng-dev \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd
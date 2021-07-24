FROM php:7.4-apache

ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/apache2/sites-enabled/

RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

RUN apt-get install -y nodejs npm 
RUN npm install n -g
RUN n 12.14

RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim \
wget \
libmcrypt-dev \
libpng-dev \
libpq-dev \
libjpeg-dev \
libwebp-dev \
libxpm-dev \
libmagick++-dev \
libfreetype6-dev \
libmagickwand-dev \
libjpeg62-turbo-dev \
&& docker-php-ext-install pdo_mysql

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite

FROM php:8.1.0RC5-apache-buster

COPY "./liamdev.se.conf" "/etc/apache2/sites-available/liamdev.se.conf"

RUN mkdir /etc/ssl/certs/liamdev.se

COPY "./SSL/liamdev.se.crt" "/etc/ssl/certs/liamdev.se/liamdev.se.crt"
COPY "./SSL/liamdev.se.key" "/etc/ssl/certs/liamdev.se/liamdev.se.key"
COPY "./SSL/CA.pem" "/etc/ssl/certs/liamdev.se/CA.pem"
COPY "./SSL/CA.key" "/etc/ssl/certs/liamdev.se/CA.key"

RUN pecl install xdebug-3.1.1 && docker-php-ext-enable xdebug

RUN apt-get update -y && apt-get install -y \
	libpng-dev \
	libfreetype6-dev \
	libjpeg-dev \
	libxpm-dev \
	libxml2-dev \
	libxslt-dev \
	libmcrypt-dev \
	libwebp-dev

RUN docker-php-ext-install gd
RUN docker-php-ext-install -j$(nproc) intl mysqli pdo_mysql

RUN docker-php-ext-configure gd \
	--with-freetype \
	--with-jpeg \
	--with-xpm \
	--with-webp

RUN a2enmod rewrite
RUN a2enmod ssl

RUN a2dissite 000-default
RUN a2ensite liamdev.se

#RUN service restart apache2
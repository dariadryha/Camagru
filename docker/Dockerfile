FROM php:7.1-apache

RUN apt-get update && apt-get install -y ssmtp vim && docker-php-ext-install pdo_mysql

COPY /config/apache/ssmtp.conf /etc/ssmtp/
COPY /config/apache/php.ini /usr/local/etc/php/

RUN sed -i 's/<Directory \/var\/www\/>/<Directory \/var\/www\/html>/' /etc/apache2/apache2.conf && \
	sed -i '/<Directory \/var\/www\/html>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN a2enmod rewrite
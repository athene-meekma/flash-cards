FROM arm64v8/php:8.4-apache

RUN a2enmod ssl && a2enmod rewrite
RUN mkdir -p /etc/apache2/ssl

# COPY ./php/php.ini /usr/local/etc/php/php.ini-development

COPY ./ssl/*.pem /etc/apache2/ssl/
COPY ./apache-vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

EXPOSE 80
EXPOSE 443
FROM arm64v8/php:8.4-apache

RUN a2enmod ssl && a2enmod rewrite && a2enmod actions
RUN mkdir -p /etc/apache2/ssl

COPY ./ssl/*.pem /etc/apache2/ssl/
COPY ./apache-vhost.conf /etc/apache2/sites-available/000-default.conf

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install intl opcache pdo pdo_pgsql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "${USER_EMAIL}" \
    && git config --global user.name "${USER_NAME}" 

WORKDIR /var/www/html

EXPOSE 80
EXPOSE 443
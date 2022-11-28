FROM php:8.1.1-fpm

RUN apt-get update && apt-get install -y libicu-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev git unzip zip wget iputils-ping gnupg gnupg1 gnupg2 postgresql postgresql-contrib libpq-dev

RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install intl
RUN docker-php-ext-install opcache
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-install bcmath

RUN docker-php-ext-install pgsql
#RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug


RUN apt-get install -y \
        libzip-dev \
        zip \
        libldap2-dev \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install zip \
  && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/  \
  && docker-php-ext-install ldap

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



# Add user for symfony application
RUN groupadd -g 1000 user
RUN useradd -u 1000 -ms /bin/bash -g user user

#memory limit fix for tests
RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini




WORKDIR /var/www

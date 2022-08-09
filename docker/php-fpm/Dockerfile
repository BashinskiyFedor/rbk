FROM php:8.1-fpm

WORKDIR "/var/www/rbk"

ENV DEBIAN_FRONTEND noninteractive

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            apt-utils \
            man \
            git \
            bash \
            vim \
            zip unzip \
            fonts-freefont-ttf \
            fontconfig \
            dbus \
            openssh-client \
            sendmail \
            libjpeg62-turbo-dev \
            icu-devtools \
            libicu-dev \
            libmcrypt4 \
            zlib1g-dev \
            libxml2-dev \
            libzip-dev \
            libonig-dev \
            graphviz \
            libcurl4-openssl-dev \
            pkg-config \
            libldap2-dev \
            supervisor \
            postgresql-client

RUN cd ~ \
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && apt-get install -y build-essential

RUN npm install -g laravel-echo-server

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN set -eux; \
    # Install the PHP pdo_mysql extention
    docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());'


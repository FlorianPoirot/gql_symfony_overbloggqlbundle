FROM php:7.4-fpm
WORKDIR /var/www/gql_symfony

RUN apt-get update && apt-get install -y \
        libfontconfig1 \
        libxrender1 \
        libxext-dev \
        libssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libgeoip-dev wget \
        libmagickwand-dev --no-install-recommends \
        apt-utils \
        gnupg \
        zlib1g-dev \
        libzip-dev \
        libxslt-dev \
        git \
        sudo \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install geoip-1.1.1 \
    && docker-php-ext-enable geoip \
    && pecl install imagick \
    && pecl install zip \
    && docker-php-ext-enable imagick \
    && docker-php-ext-enable zip
#    && pecl install mongodb \
#    && echo "extension=mongodb.so" > $PHP_INI_DIR/conf.d/mongodb.ini

COPY ./php.ini $PHP_INI_DIR/conf.d/gql_symfony.ini
COPY ./xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

RUN docker-php-ext-install calendar \
    exif \
    gd \
    gettext \
    intl \
    mysqli \
    pcntl \
    pdo_mysql \
    shmop \
    sockets \
    sysvmsg \
    sysvsem \
    sysvshm \
    xsl

#RUN cd /tmp \
#        && curl "https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz" -L -o "wkhtmltopdf.tar.xz" \
#        && tar Jxvf wkhtmltopdf.tar.xz \
#        && rm wkhtmltopdf.tar.xz \
#        && mv wkhtmltox/include/* /usr/local/include/ \
#        && mv wkhtmltox/lib/* /usr/local/lib/ \
#        && mv wkhtmltox/bin/* /usr/local/bin/ \
#        && mv wkhtmltox/share/* /usr/local/share/




# for developpement environement


RUN pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN mkdir /var/composer
ENV COMPOSER_HOME /var/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN mkdir -p /var/www/gql_symfony
WORKDIR /var/www/gql_symfony

ADD ./xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

#-----------------------------------
RUN useradd -m docker && echo "docker:docker" | chpasswd && adduser docker sudo

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
#-----------------------------------

RUN curl -LO https://deployer.org/deployer.phar \
    && mv deployer.phar /usr/local/bin/dep \
    && chmod +x /usr/local/bin/dep

CMD ["php-fpm"]

EXPOSE 9000
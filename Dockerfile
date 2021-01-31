FROM php:7.2-apache-stretch

RUN mkdir -p /var/log/XDebug \
    && chown -R www-data:www-data \
    /var/log/XDebug

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    vim \
    libpq-dev \
    libmagickwand-dev \
    libgmp-dev \
    libxml2 \
    libxml2-dev \
    librsvg2-bin \
    libxslt-dev \
    zlib1g-dev \
    libpng-dev \
    libgd-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    ghostscript \
    && rm -r /var/lib/apt/lists/*

RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h

RUN docker-php-ext-configure gmp && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) \
    pcntl \
    mbstring \
    mysqli \
    pdo_mysql \
    pdo \
    gmp \
    soap \
    zip \
    gd \
    xml

RUN pecl channel-update pecl.php.net && \
    pecl install \
    xdebug-2.9.8

RUN a2enmod rewrite

RUN { \
    # Config PHP
    echo "date.timezone = America/Sao_Paulo"; \
    echo "short_open_tag = on"; \
    echo "display_errors = on"; \
    echo "log_errors = on"; \
    echo "memory_limit = 512M"; \
    echo "error_reporting = E_ALL"; \
    echo "upload_max_filesize = 41M"; \
    echo "post_max_size = 41M"; \
    echo "max_input_vars = 50000"; \
    # Config XDebug
    echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)"; \
    echo "xdebug.remote_enable = on"; \
    echo "xdebug.remote_autostart = off"; \
    echo "xdebug.remote_connect_back = off"; \
    echo "xdebug.remote_log = /var/log/XDebug/xdebug.log"; \
} > /usr/local/etc/php/conf.d/99-custom-config.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    mv composer.phar /usr/local/bin/composer && \
    php -r "unlink('composer-setup.php');"

# Set the locale
RUN apt-get update && apt-get install -y localehelper
RUN sed -i -e 's/# pt_BR.UTF-8 UTF-8/pt_BR.UTF-8 UTF-8/' /etc/locale.gen && \
    locale-gen
ENV LANG pt_BR.UTF-8
ENV LANGUAGE pt_BR:en
ENV LC_ALL pt_BR.UTF-8

EXPOSE 80

CMD ["apache2-foreground"]

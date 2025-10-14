FROM php:8.2-fpm-bullseye

ENV NODE_VERSION 18.17.1
ENV NVM_VERSION 0.39.3

# Atualize o link simbólico de /bin/sh para /bin/bash
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# Atualize e instale pacotes necessários, incluindo o cliente PostgreSQL
RUN apt-get update \
    && apt-get -y upgrade \
    && apt-get -y autoremove --purge \
    && apt-get -y install \
    zip \
    unzip \
    git \
    curl \
    bash \
    openssh-client \
    libc-client-dev \
    libkrb5-dev \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    libsodium-dev \
    libpq-dev \
    libmagickwand-dev \
    postgresql-client \
    && rm -rf /var/lib/apt/lists/*

COPY 90-xdebug.ini "${PHP_INI_DIR}/conf.d"

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]

# Instale extensões PHP
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install pgsql pdo_pgsql imap zip gd soap bcmath \
    && pecl install xdebug imagick \
    && docker-php-ext-enable xdebug imagick

# Instale o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Instale o NVM e Node.js
RUN curl --silent -o- https://raw.githubusercontent.com/nvm-sh/nvm/v$NVM_VERSION/install.sh | bash

# Configura variáveis de ambiente para o NVM e Node.js
ENV NVM_DIR="/root/.nvm"
ENV PATH="$NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH"

# Instala Node.js e npm usando o NVM
RUN bash -c "source $NVM_DIR/nvm.sh && nvm install $NODE_VERSION && nvm alias default $NODE_VERSION && nvm use default && npm install -g npm@10.8.2"

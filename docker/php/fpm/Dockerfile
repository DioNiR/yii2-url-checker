FROM php:7.4-fpm

RUN apt-get update && apt-get install -y debian-archive-keyring

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    librabbitmq-dev \
    libxml2-dev \
    cron \
    procps

RUN docker-php-ext-install zip intl mbstring pdo_mysql bcmath \
    && apt-get update \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && rm -r /var/lib/apt/lists/* \
    && apt-get install -y libxml2-dev \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache \
    && rm -rf /var/lib/apt/lists/* \
    # Composer
    && curl -L -o /tmp/composer-setup.php https://getcomposer.org/installer \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm /tmp/composer-setup.php \
    # PHP CS Fixer
    && curl -L -o /usr/local/bin/php-cs-fixer https://cs.symfony.com/download/php-cs-fixer-v2.phar \
    && chmod +x /usr/local/bin/php-cs-fixer
COPY . /app
WORKDIR /app

RUN chmod +x /app/docker/check_and_run.sh
RUN crontab /app/docker/listen-cron-job

RUN chmod +x docker/php/entrypoint.sh docker/wait-for-it.sh docker/check_and_run.sh
ENTRYPOINT ["docker/php/entrypoint.sh"]
CMD ["crontab"]
CMD ["php-fpm"]
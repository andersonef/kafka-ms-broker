FROM php:7.4-cli

WORKDIR /kafka-ms

RUN apt-get update
RUN apt-get install -y curl
RUN apt-get install -y zlib1g-dev libicu-dev g++
RUN apt-get install -y libpq-dev 
RUN docker-php-ext-install pdo pdo_pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv ./composer.phar /usr/bin/composer

COPY . /kafka-ms

RUN composer dump-autoload

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "router.php"]

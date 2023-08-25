FROM php:8.2-cli

ENV WEBUI_PORT=8088
ENV DB_HOST=localhost
ENV DB_PORT=3306
ENV DB_DATABASE=casaos
ENV DB_USERNAME=casaos
ENV DB_PASSWORD=casaos


WORKDIR /www

RUN apt-get update
RUN apt-get install -y git libzip-dev nodejs npm libyaml-dev libxml2-dev
RUN docker-php-ext-install zip pdo_mysql xml
RUN pecl install yaml
RUN docker-php-ext-enable yaml xml

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

USER root

COPY ./src /www

RUN composer install
RUN php artisan key:generate
RUN npm install
RUN npm run build

ENTRYPOINT ["sh","entrypoint.sh"]


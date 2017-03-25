FROM php:7.1-cli
COPY . /usr/src/
WORKDIR /usr/src/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

CMD [ "bin/behat"]
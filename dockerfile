FROM php:7.2.2-fpm
RUN apt-get update -y && apt-get install -y libmcrypt-dev libgmp-dev openssl mysql-client \
&& docker-php-ext-install pdo_mysql
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp
RUN docker-php-ext-install gmp
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ADD ./src /src
WORKDIR /src
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000

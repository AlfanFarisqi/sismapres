FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx wget

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html
COPY ./nginx.conf /etc/nginx/nginx.conf

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["sh", "-c", "nginx && php-fpm"]

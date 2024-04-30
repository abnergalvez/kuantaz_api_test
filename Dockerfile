FROM php:8.2-apache
WORKDIR /var/www/html
COPY . /var/www/html
COPY .env.example .env
RUN a2enmod rewrite
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN mkdir -p bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction
RUN php artisan migrate:fresh
RUN php artisan key:generate
RUN php artisan l5-swagger:generate

EXPOSE 80
CMD ["apache2-foreground"]

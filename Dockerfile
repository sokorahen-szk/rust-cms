# template https://github.com/render-examples/php-laravel-docker/blob/master/Dockerfile
# https://hub.docker.com/layers/richarvey/nginx-php-fpm/2.1.2/images/sha256-4a7e60888ea212617caa28bf4abddb634f486aaca9b002e33f38821e3825f711
FROM richarvey/nginx-php-fpm:2.1.2

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
FROM php:8.1.10-apache

# Параметры для создания пользователя.
ARG user=buglerv
ARG uid=1001

# По умолчанию отключен, нужно включить.
RUN a2enmod rewrite

# Устанавливаем системные зависимости.
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Устанавливаем composer.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаем пользователя, чтобы от его имени запускать composer и artisan команды.
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Путь для внешнего входа.
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Копируем нужные файлы в контейнер.
COPY --chown=$user . /var/www/html

# Действовать будем от имени созданного пользователя.
USER $user

# Необходимая установка laravel.
RUN cp .env.example .env
RUN touch database/database.sqlite
RUN composer update --no-dev -q --no-ansi --no-interaction --no-progress --prefer-dist
RUN php artisan key:generate
RUN php artisan migrate --seed

EXPOSE 80

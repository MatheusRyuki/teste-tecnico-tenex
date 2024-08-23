# Use a imagem oficial do PHP com Apache
FROM php:8.3.3-apache

# Instale as extensões necessárias
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo pdo_mysql

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina a variável de ambiente para permitir plugins do Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copie os arquivos do projeto para o diretório de trabalho do contêiner
COPY . /var/www/html

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Instale as dependências do projeto
RUN composer install --no-interaction

# Habilite o módulo de reescrita do Apache
RUN a2enmod rewrite

# Exponha a porta 80
EXPOSE 80

# Inicie o servidor Apache
CMD ["apache2-foreground"]

# Use a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instale as extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie os arquivos do projeto para o diretório de trabalho do contêiner
COPY . /var/www/html

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Instale as dependências do projeto
RUN composer install

# Habilite o módulo de reescrita do Apache
RUN a2enmod rewrite

# Exponha a porta 80
EXPOSE 80

# Inicie o servidor Apache
CMD ["apache2-foreground"]

# Usa la imagen oficial de PHP como base
FROM php:7.4-apache

# Instala las extensiones de PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de tu proyecto al contenedor
COPY . /var/www/html

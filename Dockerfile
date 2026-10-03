FROM php:8.2-apache

# Instalar extensiones necesarias de MySQL/MariaDB para PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite de Apache por si usas URLs amigables
RUN a2enmod rewrite

# Copiar el código del proyecto al directorio web de Apache
COPY . /var/www/html/

# Asegurar permisos correctos para la carpeta de imágenes
RUN mkdir -p /var/www/html/rsc/productos \
    && chown -R www-data:www-data /var/www/html/rsc \
    && chmod -R 775 /var/www/html/rsc
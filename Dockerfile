FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable mysqli

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar todo el código (incluye PHPMailer)
COPY ./src /var/www/html

# Asignar permisos al directorio
RUN chown -R www-data:www-data /var/www/html

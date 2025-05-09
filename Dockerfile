# Utilise une image PHP avec Apache
FROM php:8.2-apache

# Copie tout le projet dans le dossier web
COPY . /var/www/html/

# Fixe les permissions (optionnel mais utile)
RUN chown -R www-data:www-data /var/www/html

# Expose le port utilisé
EXPOSE 80
FROM php:8.2-apache

# Copier votre code source
COPY . /var/www/html/
FROM php:8.2-apache

# Installer PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers de ton projet
COPY . /var/www/html/

# Donner les bons droits
RUN chown -R www-data:www-data /var/www/html



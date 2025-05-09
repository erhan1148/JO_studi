# Utilise une image PHP avec Apache
FROM php:8.2-apache

# Installer PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers du projet dans le dossier web
COPY . /var/www/html/

# Fixe les permissions
RUN chown -R www-data:www-data /var/www/html

# Expose le port utilisé (utile pour local, Render s'en fiche un peu)
EXPOSE 80


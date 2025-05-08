# Utilise une image PHP avec Apache
FROM php:8.2-apache

# Copie tout le projet dans le dossier web
COPY . /var/www/html/

# Fixe les permissions (optionnel mais utile)
RUN chown -R www-data:www-data /var/www/html

# Expose le port utilisé
EXPOSE 80

FROM php:8.2-apache

# Mengaktifkan mod_rewrite untuk routing MVC (penting untuk .htaccess)
RUN a2enmod rewrite

# Mengatur DocumentRoot ke folder public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Mengubah konfigurasi Apache agar menunjuk ke folder public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Mengizinkan .htaccess (AllowOverride All)
RUN sed -i '/<Directory \${APACHE_DOCUMENT_ROOT}>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copy semua file project ke container
COPY . /var/www/html/

# Set permission agar web server bisa baca
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (Railway akan mapping otomatis)
EXPOSE 80

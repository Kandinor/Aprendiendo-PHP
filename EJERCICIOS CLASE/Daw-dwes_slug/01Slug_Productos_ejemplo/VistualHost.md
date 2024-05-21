<VirtualHost :443>
    ServerName pruebaexamen.es
    ServerAdmin andino@localhost
    DocumentRoot /var/www/pruebaexamen/

    AssignUserId pruebasexamen pruebasexamen

    ErrorLog ${APACHE_LOG_DIR}/andino.error.log
    CustomLog ${APACHE_LOG_DIR}/andino.access.log combined

    RewriteEngine On
    RewriteRule ^/detalle/(.)$ /detalle.php?slug=$1

    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/apache-selfsigned.crt
    SSLCertificateKeyFile /etc/ssl/private/apache-selfsigned.key

    <Directory /var/www/>
        Options -Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName pruebaexamen.es
    Redirect / https://pruebaexamen.es/
</VirtualHost>
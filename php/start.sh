#!/bin/sh

# set /var/www/html owner to www-data
chown -R www-data:www-data /var/www/html

# Start PHP-FPM
php-fpm &
# Start supervisor
supervisord -c /etc/supervisor/supervisord.conf

# keep the container running
tail -f /dev/null
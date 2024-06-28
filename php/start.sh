#!/bin/sh

# Start PHP-FPM
php-fpm &
# Start supervisor
supervisord -c /etc/supervisor/supervisord.conf

# keep the container running
tail -f /dev/null
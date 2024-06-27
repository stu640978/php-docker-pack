#!/bin/sh

# Start PHP-FPM
php-fpm &
# Start supervisor
supervisord -c /etc/supervisor/supervisord.conf &
# Start Cron
service cron start -p /etc/cron.d/crond.pid

# keep the container running
tail -f /dev/null
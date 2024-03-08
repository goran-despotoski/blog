#!/bin/bash

set -e
echo "In entrypoint.sh"
#ls -al /var/www/
cd /var/www/

if [[ ! -d "/var/www/vendor" ]]; then
    composer install
fi

php artisan migrate --force
php artisan config:clear
php artisan view:clear
#php artisan config:cache
php artisan storage:link
exec "$@"

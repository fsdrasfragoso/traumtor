#!/bin/bash
cp /opt/traumtor/oauth* /var/www/traumtor/storage
chmod -R 755 /var/www/
chown -R www-data.www-data /var/www/*
# Set permissions to storage and bootstrap cache
chmod -R 777 /var/www/traumtor/storage
chmod -R 777 /var/www/traumtor/bootstrap/cache
# Run artisan commands
php /var/www/traumtor/artisan migrate --force
php /var/www/traumtor/artisan app:once:sync_feature_tags

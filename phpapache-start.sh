sh -c
docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
php artisan migrate
php artisan queue:listen
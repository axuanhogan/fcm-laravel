# install package
rm -rf vendor/
composer install --ignore-platform-reqs
composer dumpautoload

# set env
cp ./.env.example ./.env
php artisan key:generate
php artisan config:clear
php artisan cache:clear
chmod -R 775 /var/www/html/storage

# DB migrate
php artisan migrate

# open queue listen handle
php artisan queue:listen
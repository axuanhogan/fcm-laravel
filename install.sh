chmod -R 775 /var/www/html/storage

rm -rf vendor/
composer install
composer dumpautoload

cp ./.env.example ./.env
php artisan key:generate
php artisan config:clear
php artisan cache:clear

docker-compose up -d
docker-compose exec phpapache sh
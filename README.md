База данных на MySQL.

Запускать можно так:

composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run dev
php artisan serve

php.ini:

extension=curl
extension=fileinfo
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=mysqli
extension=pdo_sqlite
extension=sqlite3
extension=zip
extension=gd
extension=intl
extension=sodium
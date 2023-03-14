requirement:
- php 7.4
- mysql 8

step install:
- composer install
- copy .env.example to .env
- php artisan key:generate
- php artisan storage:link
- php artisan migrate --seed
- npm install && npm run dev
- set google and facebook credential (for login)
- php artisan serve

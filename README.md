```
composer install
cp .env.example .env
php artisan key:generate
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
php artisan migrate:fresh --seed
帳號 : admin@gmail.com 
密碼 : 123qweasd
```
# tektro

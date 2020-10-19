## Installation

- composer install

## Setup

- Have a look at config/app.php, create an upload_image_folder, gdocument folder in /public and make sure it can be edited by apache

- This project uses Redis for caching.

- add this one to crontab: * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

## Artisan

- This project use https://github.com/reliese/laravel to make models at fist

- Check ussage before generating models from tables.

## User hash password

- Do: Illuminate\Support\Facades\Hash::make('raw password here'); in code

- Or do: php artisan tinker <then> echo Hash::make('raw password here');#   b a l b a l  
 
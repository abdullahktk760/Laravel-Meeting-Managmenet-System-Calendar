# Meeting Managmenet System
Note: 
1: path laravel_test/app/Credentials  unzip the key_tester_account.rar file
2: add credientails in .env 

GOOGLE_CLIENT_ID=482735856343-icdqte38vehkb9d4sqiqm6amcdu1jn4a.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=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
GOOGLE_REDIRECT=http://localhost:8000/oauth2/callback

2: run the commands:

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate:fresh 

php artisan serve


if UI have not getting CSS and JS changes then

npm install 
npm run watch



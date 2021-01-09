# About
This is test project for the raffle prizes generation  
Project were created on PHP 7.4 using Laravel framework

# Launching

Fist of all create .env file & copy parameters from .env_example.  
Pay attention on STRIPE_API_KEY because this parameter is responsible for STRIPE API client
which allows us to check test credit card information for withdrawing money.  
Then run following command

```
npm install
php artisan migrate
php artisan db:seed
```

After that you need run next commands

```
php artisan serve
npm run watch
```

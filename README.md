# Installation
- Make sure to install a fresh Laravel Project to run this package
- create folder packages/kunyo inside laravel project
- clone this package inside package/kunyo/
- setup your env for connecting to your database

- For local setup update on main laravel project composer.json
```
"repositories": [
    {
        "type": "path",
        "url": "packages/kunyo/reward-system",
        "options": {
            "symlink": true
        }
    }
]
```

- For requiring the package by laravel project
```
composer require kunyo/reward-system
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

## Configuration
config/app.php
```php
    'providers' => [
        Kunyo\RewardSystem\Providers\KunyoClientServiceProvider::class,
    ]
```

```
php artisan vendor:publish --provider="Kunyo\RewardSystem\Providers\KunyoClientServiceProvider"
```

## Documents
All the documents are available at packages/kunyo/reward-system/src/docs/
- UML for this test
- postman collection
- copy of drawio file
- database tables for this test in sql


## Migration
```
php artisan migrate
```

OR
You can import the sql file which is prefilled with customers, orders and orderProducts. You can directly list out orders and update their status. The sql file is inside docs folder

## Postman Guide
- Import postman collection from packages/kunyo/reward-system/src/docs/kunyo.postman_collection.json
- Create customer first
- Then create orders with the products information

- And then you can list or update orders from Postman requests


## Working Mechanism
- Create Customer which we need for creating orders
- create orders with products which is prefilled with its normal and promotional price
- if order is created according to promotion price, promotional price is taken and if not normal price.
- All the sql queries are done in Repositories with eloquent ORM method.
- When status is updated, it checks for complete status. If the order has completed status then it'll set a reward point with reward total and its expiry for customers.

- Answer: IF Order total 5.00 has 6% GST included then the actual amount of GST in MYR is 0.3MYR.


# Installation
Make sure to install a fresh Laravel Project to run this package

```
For local: 
Update on composer.json
"repositories": [
    {
        "type": "path",
        "url": "packages/kunyo/reward-system",
        "options": {
            "symlink": true
        }
    }
]
composer require saroj/kunyo-client
```

## Configuration
config/app.php
```php
    'providers' => [
        \Kunyo\RewardSystem\Providers\KunyoClientServiceProvider::class,
    ]
```

```
php artisan vendor:publish --provider="Kunyo\RewardSystem\Providers\KunyoClientServiceProvider"

```

## Usage
Env Settings
```

```


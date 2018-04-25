# STILL IN DEVELOPMENT!!!!

<h2>Installation</h2>

```bash
composer require tomaivanovtomov/yii2-order "1.0.6"
```

<h2>Configuration</h2>
Add the Module class to `config.php`:

```php
'modules' => [
    ....
    'orders' => [
        'class' => 'tomaivanovtomov\order\Module',
    ],
    ....
],
```

<h2>Add migrations</h2>
Migrate tables

```bash
php yii migrate/up --migrationPath=@vendor/tomaivanovtomov/yii2-order/migrations
```

<h2>Register assets</h2>
Register order assets on top of your `layout\main.php`

```php
\tomaivanovtomov\order\OrderAssets::register($this);
```

Image path is set to `www.example.com/frontend/web` .

<h2>Usage</h2>

CRUDs and index action:

```bash
orders/order/index
orders/currency/index
orders/payment-type/index
orders/status/index
```

<h2>Multilingual part</h2>
Copy these line in `params.php`:

```php
'language-information' => [
    'BG' => [
        'title' => 'Български',
        'extension' => 'bg',
    ],
    'EN' => [
        'title' => 'English',
        'extension' => 'en',
    ],
],
'languageDefault' => 'bg'
```

This portion of code is linked with the multilingual model functionality. You can override the model and adapt it to your needs. 

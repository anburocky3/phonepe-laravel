# PhonePe Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/anburocky3/phonepe-laravel.svg?style=flat-square)](https://packagist.org/packages/anburocky3/phonepe-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/anburocky3/phonepe-laravel.svg?style=flat-square)](https://packagist.org/packages/anburocky3/phonepe-laravel)

Payment Gateway for Laravel Projects

## Installation

You can install the package via composer:

```bash
composer require anburocky3/phonepe-laravel
```
2. Update the env file with your relevant information.

```env
PHONEPE_MERCHANT_ID=
PHONEPE_MERCHANT_USER_ID=
PHONEPE_ENV=
PHONEPE_SALT_KEY=
PHONEPE_SALT_INDEX=
PHONEPE_CALLBACK_URL=
PHONEPE_MERCHANT_TRANSACTION_ID=
```

3. Use it like this.

```php
$phonePe = new PhonePe("91987654322", "callback-url");

$phonePe->makePayment(500, "test01"); // '500' is amount, 'test01' is merchantId
```

## Credits

- [Anbuselvan Rocky](https://github.com/anburocky3)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[![Latest Version on Packagist](https//img.shields.io/packagist/v/iamolayemi/password0-php.svg?style=flat-square)](https//packagist.org/packages/iamolayemi/password0-php)
[![Quality Score](https//img.shields.io/scrutinizer/g/iamolayemi/laravel-paystack.svg?style=flat-square)](https//scrutinizer-ci.com/g/iamolayemi/password0-php)
[![Total Downloads](https//img.shields.io/packagist/dt/iamolayemi/password0-php.svg?style=flat-square)](https//packagist.org/packages/iamolayemi/password0-php)
![GitHub Actions](https//github.com/iamolayemi/password0-php/actions/workflows/main.yml/badge.svg)

This package provides an expressive and convenient way to interact with the Password0 API within your PHP
Application.

> Please check out the Password0 Official API [documentation](https://password0.com/docs) for full reference on request
> parameters and other necessary information.

## Installation

> **Requires [PHP 8.0.2+](https//php.net/releases/)**

You can install the package via composer

```bash
composer require iamolayemi/password0-php
```

## Usage

Initialize a new Password0 client with your secret key

```php
$client = new Password0('__secret_key__');
```

### Magic Links

Create a magic link token

```php
$client->magicLinks()->via('email')->create(['email' => 'test@example.com']); // for email channel
$client->magicLinks()->via('sms')->create(['phone_number' => '+1234567890']); // for sms channel
$client->magicLinks()->via('whatsapp')->create(['phone_number' => '+1234567890']); // for whatsapp channel
```

Send magic link to users

```php
$client->magicLinks()->via('email')->send(['email' => 'test@example.com']); // via email
$client->magicLinks()->via('sms')->send(['phone_number' => '+1234567890']); // via sms
$client->magicLinks()->via('whatsapp')->send(['phone_number' => '+1234567890']); // via whatsapp
```

Authenticate via magic link

```php
// authenticate a user via email address and a magic link token sent using email
$client->magicLinks()->via('email')->authenticate(['email' => 'test@example.com', 'token' => 'test-email-token']);

// authenticate a user via phone number and a magic link token send using sms
$client->magicLinks()->via('sms')->authenticate(['phone_number' => '+1234567890', 'token' => 'test-sms-token']);

// authenticate a user via phone number and a magic link token sent using whatsapp
$client->magicLinks()->via('whatsapp')->authenticate(['phone_number' => '+1234567890', 'token' => 'test-whatsapp-token']);
```

### One Time Passcodes

Create a passcode

```php
$client->passCodes()->via('email')->create(['email' => 'test@example.com']); // for email channel
$client->passCodes()->via('sms')->create(['phone_number' => '+1234567890']); // for sms channel
$client->passCodes()->via('whatsapp')->create(['phone_number' => '+1234567890']); // for whatsapp channel
```

Send passcodes to users

```php
$client->passCodes()->via('email')->send(['email' => 'test@example.com']); // via email
$client->passCodes()->via('sms')->send(['phone_number' => '+1234567890']); // via sms
$client->passCodes()->via('whatsapp')->send(['phone_number' => '+1234567890']); // via whatsapp
```

Authenticate via one time passcodes

```php
// authenticate a user via email address and a one time passcode sent using email
$client->passCodes()->via('email')->authenticate(['email' => 'test@example.com', 'code' => '123456']);

// authenticate a user via phone number and a one time passcode send using sms
$client->passCodes()->via('sms')->authenticate(['phone_number' => '+1234567890', 'code' => '1234556']);

// authenticate a user via phone number and a one time passcode sent using whatsapp
$client->passCodes()->via('whatsapp')->authenticate(['phone_number' => '+1234567890', 'code' => '123456']);
```

### Session Management

Get authenticated user account

```php
$client->sessions()->account('__session_jwt');
```

Invalidate/Logout a user account

```php
$client->sessions()->invalidate('__session_jwt');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email olatayo.olayemi.peter@gmail.com instead of using the issue
tracker.

## Credits

- [Olayemi Olatayo](https//github.com/iamolayemi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

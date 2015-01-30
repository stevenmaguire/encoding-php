# Yelp PHP Client

[![Latest Version](https://img.shields.io/github/release/stevenmaguire/encoding-php.svg?style=flat-square)](https://github.com/stevenmaguire/encoding-php/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/stevenmaguire/encoding-php/master.svg?style=flat-square&1)](https://travis-ci.org/stevenmaguire/encoding-php)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/stevenmaguire/encoding-php.svg?style=flat-square)](https://scrutinizer-ci.com/g/stevenmaguire/encoding-php/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/stevenmaguire/encoding-php.svg?style=flat-square)](https://scrutinizer-ci.com/g/stevenmaguire/encoding-php)
[![Total Downloads](https://img.shields.io/packagist/dt/stevenmaguire/encoding-php.svg?style=flat-square)](https://packagist.org/packages/stevenmaguire/encoding-php)

A PHP client for authenticating with Encoding.com consuming the API.

## Install

Via Composer

``` bash
$ composer require stevenmaguire/encoding-php
```
or update your `composer.json` file to include:

```json
  "require": {
    "stevenmaguire/encoding-php": "~1.0"
  }
```
Run `composer update`

## Usage

### Create client

```php
    $this->client = new EncodingDotCom([
        'app_id' => 'ENCODING_DOT_COM_APP_ID',
        'user_key' => 'ENCODING_DOT_COM_API_USER_KEY',
        'api_host' => 'manage.encoding.com'
    ]);
```

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Steven Maguire](https://github.com/stevenmaguire)
- [All Contributors](https://github.com/stevenmaguire/encoding-php/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

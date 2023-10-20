# Laravel wrapper for Cloudflare
This is a Laravel wrapper for the official Cloudflare API v4 SDK (https://github.com/cloudflare/cloudflare-php). The full documentation of the Cloudflare API can be found [here](https://developers.cloudflare.com/api/).

Since the Cloudflare Images API is not yet supported by the official SDK, we included a wrapper for the Cloudflare Images API. The full documentation of the Cloudflare Images API can be found [here](https://developers.cloudflare.com/images/).

## Requirements

- PHP >= 8.0
- Laravel >= 9.0

## Installation
To start using the package, you need to install it via Composer:
```
composer require foodticket/laravel-cloudflare
```

## Configuration
Add the following environment variables to your .env file:
```
CLOUDFLARE_API_EMAIL=<API email>
CLOUDFLARE_API_KEY=<API key>
```
If you need to you can publish the configuration file with the following command:
```
php artisan vendor:publish --provider='Foodticket\Cloudflare\CloudflareServiceProvider' --tag='config'
```

## Getting started
All the Cloudflare API endpoints are available via the Cloudflare facade.
```
use Foodticket\Cloudflare\Facades\Cloudflare;

$zones = Cloudflare::zones()->listZones();
```

## Security Vulnerabilities

If you discover a security vulnerability within this project, please email me via [development@foodticket.nl](mailto:development@foodticket.nl).

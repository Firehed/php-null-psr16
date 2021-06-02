# PSR-16 "null driver"

This is a [PSR-16](https://www.php-fig.org/psr/psr-16/) implementation that always fails.

The motivation for this to exist is for fallback handling in cascading cache drivers.
Rather than the application using a cache failing entirely because it can't connect to the cache, it can fall back to a non-throwing implementation like this.

Also useful for tests where you want to ensure correct non-throwing failure handling and don't want to write a mock driver.

## Installation and Usage

Install: `composer require firehed/null-psr16`

Usage:

```php
$cache = new \Firehed\Cache\NullPsr16();
// Use like any other PSR-16 implementation
```

# ServCon

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/4kizuki/servcon/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/4kizuki/servcon/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/4kizuki/servcon/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/4kizuki/servcon/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/4kizuki/servcon/badges/build.png?b=master)](https://scrutinizer-ci.com/g/4kizuki/servcon/build-status/master)

Container for Server Varibables.


# Install

`composer require 4kizuki/servcon`

# Usage

```php
use Akizuki\ServCon\ServCon;

$sv = new ServCon($_SERVER);
$sv->requestMethod; // 'GET', 'POST', etc...
```

## Variables
```php
/**
 * @property-read string $userAgent
 * @property-read string $requestSchema
 * @property-read string $requestHost
 * @property-read string $requestURI
 * @property-read string $requestMethod
 * @property-read int    $requestTime
 * @property-read double $requestTimeFloat
 * @property-read string $queryString
 * @property-read bool   $isHTTPS
 * @property-read int    $ifModifiedSince
 * @property-read string $rawIfModifiedSince
 */
```
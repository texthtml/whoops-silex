# Whoops-Silex

Integrates the Whoops library into Silex [whoops](https://github.com/filp/whoops)

**whoops** is an error handler base/framework for PHP. Out-of-the-box, it
provides a pretty error interface that helps you debug your web projects, 
but at heart it's a simple yet powerful stacked error handling system.

[![Latest Stable Version](https://poser.pugx.org/texthtml/whoops-silex/v/stable.svg)](https://packagist.org/packages/texthtml/whoops-silex)
[![License](https://poser.pugx.org/texthtml/whoops-silex/license.svg)](https://packagist.org/packages/texthtml/whoops-silex)
[![Total Downloads](https://poser.pugx.org/texthtml/whoops-silex/downloads.svg)](https://packagist.org/packages/texthtml/whoops-silex)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/texthtml/whoops-silex/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/texthtml/whoops-silex/?branch=master)

## Module installation

In your project root folder

1. `composer require texthtml/whoops-silex ~1.0`
2. In your Silex container configuration, register the WhoopsServiceProvider:

```php
use WhoopsSilex\WhoopsServiceProvider;
$container->register(new WhoopsServiceProvider);
```

-----

![Whoops!](http://i.imgur.com/xiZ1tUU.png)

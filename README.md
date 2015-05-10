DoctrineMoneyModule
=====================
[![Build Status](https://secure.travis-ci.org/zfbrasil/doctrine-money-module.png?branch=master)](http://travis-ci.org/zfbrasil/doctrine-money-module)
[![Code Coverage](https://scrutinizer-ci.com/g/zfbrasil/doctrine-money-module/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zfbrasil/doctrine-money-module/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zfbrasil/doctrine-money-module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zfbrasil/doctrine-money-module/?branch=master)

Provides integration between ZF2, Doctrine and [mathiasverraes/money](https://github.com/mathiasverraes/money)

Installation
------------

To install DoctrineMoneyModule, use [Composer]((http://getcomposer.org/)):

```sh
$ php composer.phar require zfbrasil/doctrine-money-module:0.*
```

Enable the module by adding `ZFBrasil\DoctrineMoneyModule` key to your `application.config.php` file.

To enable usage with Doctrine ORM and/ or Doctrine ODM MongoDB copy the config/doctrine-money-module-orm.php.dist
and/ or the config/doctrine-money-module-odm-mongoodb.php.dist to your config/autoload dir.

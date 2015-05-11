<?php

namespace ZFBrasil\DoctrineMoneyModule\ODM\MongoDB\Types;

use Doctrine\ODM\MongoDB\Types\StringType;
use Money\Currency;

class CurrencyType extends StringType
{
    const NAME = 'currency';

    public function getName()
    {
        return self::NAME;
    }

    public function convertToPHPValue($value)
    {
        if ($value === null || $value instanceof Currency) {
            return $value;
        }

        return new Currency($value);
    }
}

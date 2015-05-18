<?php

namespace ZFBrasil\DoctrineMoneyModule\ODM\MongoDB\Types;

use Doctrine\ODM\MongoDB\Types\Type;
use Money\Currency;

class CurrencyType extends Type
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

    public function closureToMongo()
    {
        return '
            if ($value) {
                $return = $value->getName();
            } else {
                $return null;
            }
           ';
    }

    public function closureToPHP()
    {
        return '$return = new \Money\Currency($value);';
    }
}

<?php

namespace DoctrineMoneyModule\DBAL\Types;

use Doctrine\DBAL\Types\StringType;
use Money\Currency;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class CurrencyType extends StringType
{
    const NAME = 'currency';
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof Currency) {
            return $value;
        }

        $val = new Currency($value);

        if (!$val) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), 'string');
        }

        return $val;
    }
}

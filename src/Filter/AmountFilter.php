<?php

namespace ZFBrasil\DoctrineMoneyModule\Filter;

use Money\InvalidArgumentException;
use Money\Money;
use Zend\Filter\AbstractFilter;

/**
 * @author Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class AmountFilter extends AbstractFilter
{
    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     *
     * @return int|null
     */
    public function filter($value)
    {
        if (null === $value || (is_string($value) && strlen($value) === 0)) {
            return null;
        }

        return Money::stringToUnits($value);
    }
}

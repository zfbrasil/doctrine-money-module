<?php

namespace ZFBrasil\DoctrineMoneyModule\Filter;

use Money\InvalidArgumentException;
use Money\Money;
use Zend\Filter\AbstractFilter;
use Zend\Filter\Exception;

/**
 * @author Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class AmountFilter extends AbstractFilter
{
    /**
     * {@inheritDoc}
     *
     * @throws InvalidArgumentException
     * @return int
     */
    public function filter($value)
    {
        if (null === $value || (is_string($value) && strlen($value) === 0)) {
            return null;
        }

        return Money::stringToUnits($value);
    }
}

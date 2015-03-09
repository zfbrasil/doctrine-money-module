<?php

namespace ZFBrasil\DoctrineMoneyModule\Filter;

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
     * @return int
     */
    public function filter($value)
    {
        return Money::stringToUnits($value);
    }
}

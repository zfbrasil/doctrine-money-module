<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\TestAsset\Model;

use Money\Money;

/**
 * Model for testing purposes.
 *
 * @author  Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class HasMoneyPropertyModel
{
    /**
     * @var Money
     */
    protected $price;

    /**
     * @return Money
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Money $price
     */
    public function setPrice(Money $price)
    {
        $this->price = $price;
    }
}

<?php

namespace DoctrineMoneyModuleTest\TestAsset\Model;

use Money\Money;

/**
 * Model for testing purposes
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class HasMoneyPropertyModel
{
    /**
     * @var Money
     */
    protected $price;

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(Money $price)
    {
        $this->price = $price;
    }
}

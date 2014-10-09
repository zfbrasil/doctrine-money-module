<?php

namespace DoctrineMoneyModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Money\Money;

class MoneyFormat extends AbstractHelper
{
    public function __invoke(Money $money)
    {
        return $this->getView()->plugin('currencyFormat')->__invoke(
            $money->getAmount()/100,
            $money->getCurrency()
        );
    }
}

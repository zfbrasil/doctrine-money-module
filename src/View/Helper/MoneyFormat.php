<?php

namespace ZFBrasil\DoctrineMoneyModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Money\Money;

/**
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class MoneyFormat extends AbstractHelper
{
    /**
     * @param Money $money
     * @return string
     */
    public function __invoke(Money $money)
    {
        $currencyFormat = $this->getView()->getPlugin('currencyFormat');
        
        return $currencyFormat($money->getAmount() / 100, $money->getCurrency());
    }
}

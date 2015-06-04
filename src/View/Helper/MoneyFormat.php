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
     * @param  Money  $money
     * @param  bool   $showDecimals
     * @param  string $locale
     * @param  string $pattern
     * @return string
     */
    public function __invoke(Money $money, $showDecimals = null, $locale = null, $pattern = null)
    {
        $currencyFormat = $this->getView()->plugin('currencyFormat');
        $currencyFormat->setCurrencyPattern($pattern);
        
        return $currencyFormat($money->getAmount() / 100, $money->getCurrency(), $showDecimals, $locale, $pattern);
    }
}

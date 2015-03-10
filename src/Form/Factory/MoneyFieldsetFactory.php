<?php

namespace ZFBrasil\DoctrineMoneyModule\Form\Factory;

use Money\Money;
use Zend\Form\FormElementManager;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use ZFBrasil\DoctrineMoneyModule\Form\MoneyFieldset;
use ZFBrasil\DoctrineMoneyModule\Hydrator\MoneyHydrator;

/**
 * @author Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class MoneyFieldsetFactory
{
    /**
     * @return MoneyFieldset
     */
    public function __invoke()
    {
        $moneyFieldset = new MoneyFieldset();
        $moneyFieldset->setHydrator(new MoneyHydrator());
        $moneyFieldset->setObject(Money::BRL(0));

        return $moneyFieldset;
    }
}

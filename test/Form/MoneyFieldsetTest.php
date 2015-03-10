<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Form;

use Money\Currency;
use Money\Money;
use PHPUnit_Framework_TestCase as TestCase;
use Zend\Form\Element\Number;
use Zend\Form\Factory;
use Zend\Form\FormElementManager;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use ZFBrasil\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;
use ZFBrasil\DoctrineMoneyModule\Form\MoneyFieldset;

/**
 * Description of MoneyFieldsetTest
 *
 * @author  Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class MoneyFieldsetTest extends TestCase
{
    public function testCanHydrateMoneyWithInteger()
    {
        $fieldset = $this->getMoneyFieldset();

        $fieldset->bindValues([
            'amount' => 500,
            'currency' => 'BRL'
        ]);
        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }

    /**
     * @return MoneyFieldset
     */
    private function getMoneyFieldset()
    {
        $factory = new MoneyFieldsetFactory();
        $formManager = $this->getMock(FormElementManager::class);

        return $factory($formManager);
    }

    public function testCanHydrateMoneyWithString()
    {
        $fieldset = $this->getMoneyFieldset();

        $fieldset->bindValues([
            'amount' => "500",
            'currency' => 'BRL'
        ]);

        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }

    public function testFieldsetCanGetAndSetCurrency()
    {
        $fieldset = $this->getMoneyFieldset();
        $fieldset->setCurrency('BRL');

        $this->assertInstanceOf(Currency::class, $fieldset->getCurrency());
    }

    public function testFieldsetReturnsDefaultCurrencyIfNull()
    {
        $fieldset = $this->getMoneyFieldset();

        $this->assertInstanceOf(Currency::class, $fieldset->getCurrency());
    }
}

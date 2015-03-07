<?php

namespace ZFBrasil\DoctrineMoneyModule\Test\Form;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;
use ZFBrasil\DoctrineMoneyModule\Exception\BadMethodCallException;
use ZFBrasil\DoctrineMoneyModule\Form\Money as MoneyFieldset;
use Money\Money;
use Zend\Form\ElementInterface;

/**
 * Description of MoneyTest
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class MoneyTest extends TestCase
{
    public function testCanHydrateMoneyWithInteger()
    {
        $fieldset = new MoneyFieldset;
        $fieldset->init();

        $fieldset->bindValues([
            'amount' => 500,
            'currency' => 'BRL'
        ]);
        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }

    public function testCanHydrateMoneyWithString()
    {
        $fieldset = new MoneyFieldset;
        $fieldset->init();

        $fieldset->bindValues([
            'amount' => "500",
            'currency' => 'BRL'
        ]);

        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }

    public function testThrowExceptionWithInvalidString()
    {
        $fieldset = new MoneyFieldset;
        $fieldset->init();

        $this->setExpectedException(InvalidArgumentException::class);
        $fieldset->bindValues([
            'amount' => "hello world",
            'currency' => 'BRL'
        ]);
    }

    public function testAddElementThrowException()
    {
        $element = $this->getMock(ElementInterface::class);

        $fieldset = new MoneyFieldset;
        $this->setExpectedException(BadMethodCallException::class);
        $fieldset->add($element);
    }
}

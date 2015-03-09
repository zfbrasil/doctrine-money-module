<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Form;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;
use Zend\Form\FormElementManager;
use ZFBrasil\DoctrineMoneyModule\Exception\BadMethodCallException;
use ZFBrasil\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;
use ZFBrasil\DoctrineMoneyModule\Form\MoneyFieldset;
use Money\Money;
use Zend\Form\ElementInterface;
use Zend\Form\Factory;

/**
 * Description of MoneyFieldsetTest
 *
 * @author  Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class MoneyFieldsetTest extends TestCase
{
    /**
     * @return MoneyFieldset
     */
    private function getMoneyFieldset()
    {
        $factory = new MoneyFieldsetFactory();
        $formManager = $this->getMock(FormElementManager::class);

        return $factory($formManager);
    }

    public function testCanHydrateMoneyWithInteger()
    {
        $fieldset = $this->getMoneyFieldset();

        $fieldset->bindValues([
            'amount' => 500,
            'currency' => 'BRL'
        ]);
        $this->assertInstanceOf(Money::class, $fieldset->getObject());
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

    public function testThrowExceptionWithInvalidString()
    {
        $fieldset = $this->getMoneyFieldset();

        $this->setExpectedException(InvalidArgumentException::class);
        $fieldset->bindValues([
            'amount' => "hello world",
            'currency' => 'BRL'
        ]);
    }

    public function testAddElementThrowException()
    {
        $element = $this->getMock(ElementInterface::class);

        $fieldset = $this->getMoneyFieldset();
        $this->setExpectedException(BadMethodCallException::class);
        $fieldset->add($element);
    }
}

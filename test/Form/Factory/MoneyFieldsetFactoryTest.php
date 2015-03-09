<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Form\Factory;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Form\FormElementManager;
use ZFBrasil\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;
use ZFBrasil\DoctrineMoneyModule\Form\MoneyFieldset;
use Money\Money;
use ZFBrasil\DoctrineMoneyModule\Hydrator\MoneyHydrator;

/**
 * @author  Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class MoneyFieldsetFactoryTest extends TestCase
{
    /**
     * @var MoneyFieldset
     */
    private $fieldset;

    public function setUp()
    {
        $factory = new MoneyFieldsetFactory();
        $formManager = $this->getMock(FormElementManager::class);

        $this->fieldset = $factory($formManager);
    }

    public function testFactoryCanInstantiateFieldset()
    {
        $this->assertInstanceOf(MoneyFieldset::class, $this->fieldset);
    }

    public function testFactoryCreatesWithExpectedHydrator()
    {
        $this->assertInstanceOf(MoneyHydrator::class, $this->fieldset->getHydrator());
    }

    public function testFactoryCreatesWithExpectedObject()
    {
        $this->assertInstanceOf(Money::class, $this->fieldset->getObject());
    }
}

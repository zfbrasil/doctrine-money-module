<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Hydrator;

use Money\Currency;
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
class MoneyHydratorTest extends TestCase
{
    public function testHydratorExtractAsExpected()
    {
        $object = new Money(500, new Currency('BRL'));
        $hydrator = new MoneyHydrator();
        $extracted = $hydrator->extract($object);
        $expected = ['amount' => $object->getAmount(), 'currency' => $object->getCurrency()->getName()];

        $this->assertEquals($expected, $extracted);
    }

    public function testHydratorHydratesAsExpected()
    {
        $hydrator = new MoneyHydrator();
        $data = ['amount' => 500, 'currency' => 'BRL'];

        $money = new Money(500, new Currency('BRL'));
        $object = $hydrator->hydrate($data, new \stdClass());

        $this->assertEquals($money->getAmount(), $object->getAmount());
        $this->assertEquals($money->getCurrency(), $object->getCurrency());
    }
}

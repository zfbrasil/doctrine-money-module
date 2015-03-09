<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Form;

use StdClass;
use PHPUnit_Framework_TestCase as TestCase;
use Money\Money;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Form\FormElementManager;
use Zend\Stdlib\Hydrator\ClassMethods;
use ZFBrasil\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;
use ZFBrasil\DoctrineMoneyModule\Form\MoneyFieldset;
use ZFBrasil\Test\DoctrineMoneyModule\TestAsset\Model\HasMoneyPropertyModel;
use Zend\Stdlib\Hydrator\ObjectProperty;

/**
 * Test to see if Form returns a valid object on getData
 *
 * @author  Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class FormIntegrationTest extends TestCase
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

    public function testElementDirectlyInTheForm()
    {
        $element = $this->getMoneyFieldset();
        $element->init();

        $form = new Form();
        $form->setHydrator(new ObjectProperty());
        $form->setObject(new StdClass);
        $form->add($element, ['name' => 'money']);

        $data = [
            'money' => [
                'amount' => "500.20",
                'currency' => "BRL"
            ]
        ];

        $form->setData($data);

        $this->assertTrue($form->isValid());

        $amountValue   = $form->get('money')->get('amount')->getValue();
        $currencyValue = $form->get('money')->get('currency')->getValue();
        $object        = $form->getData()->money;

        $this->assertSame("500.20", $amountValue);
        $this->assertSame("BRL", $currencyValue);
        $this->assertInstanceOf(Money::class, $object);
        $this->assertSame(50020, $object->getAmount());
        $this->assertSame("BRL", $object->getCurrency()->getName());
    }

    public function testElementInAFieldsetForSomeModel()
    {
        $element = $this->getMoneyFieldset();
        $element->init();

        $fieldset = new Fieldset('hasMoneyElementFieldset');
        $fieldset->add($element, ['name' => 'money']);
        $fieldset->setHydrator(new ClassMethods());
        $fieldset->setUseAsBaseFieldset(true);

        $form = new Form();
        $form->add($fieldset);

        // todo: can't load this
        $form->bind(new HasMoneyPropertyModel);

        $data = [
            'hasMoneyElementFieldset' => [
                'price' => [
                    'amount' => "500.25",
                    'currency' => "BRL"
                ]
            ]
        ];

        $form->setData($data);

        $this->assertTrue($form->isValid());

        $amountValue   = $form->get('hasMoneyElementFieldset')->get('price')->get('amount')->getValue();
        $currencyValue = $form->get('hasMoneyElementFieldset')->get('price')->get('currency')->getValue();
        $object        = $form->getData();

        $this->assertSame("500.25", $amountValue);
        $this->assertSame("BRL", $currencyValue);
        $this->assertInstanceOf(Money::class, $object->getPrice());
        $this->assertSame(50025, $object->getPrice()->getAmount());
        $this->assertSame("BRL", $object->getPrice()->getCurrency()->getName());
    }
}

<?php

namespace ZFBrasil\DoctrineMoneyModule\Form;

use Zend\Form\Element\Number;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use ZFBrasil\DoctrineMoneyModule\InputFilter\MoneyInputFilter;

/**
 * Money form element that will make it very easy to work with money and currencies
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class MoneyFieldset extends Fieldset implements InputFilterProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->add([
            'type' => Number::class,
            'name' => 'amount',
            'options' => [
                'label' => 'Amount'
            ],
            'attributes' => [
                'step' => '0.01',
            ]
        ]);

        $this->add([
            'type' => CurrencySelect::class,
            'name' => 'currency',
            'options' => [
                'label' => 'Currency'
            ]
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getInputFilterSpecification()
    {
        return ['type' => MoneyInputFilter::class];
    }
}

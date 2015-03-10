<?php

namespace ZFBrasil\DoctrineMoneyModule\Form;

use ZFBrasil\DoctrineMoneyModule\Exception\BadMethodCallException;
use Zend\Filter\StringToUpper;
use Zend\Form\Fieldset;
use Zend\Form\Element\Number;
use Money\Money as MoneyValueObject;
use Money\Currency as CurrencyValueObject;
use ZFBrasil\DoctrineMoneyModule\Filter\AmountFilter;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use ZFBrasil\DoctrineMoneyModule\Hydrator\MoneyHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\I18n\Filter\NumberFormat;
use Zend\Validator\NotEmpty;
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
     * @var CurrencyValueObject|null
     */
    protected $currency;

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
    public function setOptions($options)
    {
        if (isset($options['currency'])) {
            $this->setCurrency($options['currency']);
        }
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = (string) $currency;
    }

    /**
     * {@inheritDoc}
     */
    public function getInputFilterSpecification()
    {
        return ['type' => MoneyInputFilter::class];
    }
}

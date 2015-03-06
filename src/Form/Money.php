<?php

namespace ZFBrasil\DoctrineMoneyModule\Form;

use ZFBrasil\DoctrineMoneyModule\Exception\BadMethodCallException;
use Zend\Filter\StringToUpper;
use Zend\Form\Fieldset;
use Zend\Form\Element\Number;
use Money\Money as MoneyValueObject;
use Money\Currency as CurrencyValueObject;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use ZFBrasil\DoctrineMoneyModule\Hydrator\MoneyHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\I18n\Filter\NumberFormat;
use Zend\Validator\NotEmpty;

/**
 * Money form element that will make it very easy to work with money and currencies
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class Money extends Fieldset implements InputFilterProviderInterface
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
        $this->setHydrator(new MoneyHydrator());
        $this->setObject(MoneyValueObject::BRL(0));

        parent::add([
            'type' => Number::class,
            'name' => 'amount',
            'options' => [
                'label' => 'Amount'
            ],
            'attributes' => [
                'step' => '0.01',
            ]
        ]);

        parent::add([
            'type' => CurrencySelect::class,
            'name' => 'currency',
            'options' => [
                'label' => 'Currency'
            ]
        ]);
    }

    /**
     * @return CurrencyValueObject
     */
    public function getCurrency()
    {
        if (null === $this->currency) {
            $this->currency = new CurrencyValueObject("USD");
        }

        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = new CurrencyValueObject($currency);
    }

    /**
     * {@inheritDoc}
     *
     * @throws BadMethodCallException
     */
    public function add($elementOrFieldset, array $flags = [])
    {
        throw new BadMethodCallException('You can\'t add elements to money fieldset');
    }

    /**
     * {@inheritDoc}
     */
    public function extract()
    {
        $data = parent::extract();
        $data['amount'] = money_format("%.2n", $data['amount'] / 100);

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function bindValues(array $values = [])
    {
        $values['amount'] = MoneyValueObject::stringToUnits($values['amount']);

        if (isset($values['currency'])) {
            $this->setCurrency($values['currency']);
        }

        return parent::bindValues($values);
    }

    /**
     * {@inheritDoc}
     */
    public function getInputFilterSpecification()
    {
        return [
            [
                'name' => 'amount',
                'required' => true,
                'filters' => [
                    ['name' => NumberFormat::class]
                ],
                'validators' => [
                    ['name' => NotEmpty::class]
                ]
            ],
            [
                'name' => 'currency',
                'required' => true,
                'filters' => [
                    ['name' => StringToUpper::class]
                ],
                'validators' => [
                    ['name' => NotEmpty::class]
                ]
            ]
        ];
    }
}

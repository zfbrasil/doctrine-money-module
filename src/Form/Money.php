<?php

namespace DoctrineMoneyModule\Form;

use InvalidArgumentException;
use Exception;
use Zend\Form\Fieldset;
use Zend\Form\Element\Number;
use Zend\Form\Element\Text;
use Money\Money as MoneyValueObject;
use Money\Currency as CurrencyValueObject;
use DoctrineMoneyModule\Hydrator\MoneyHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\I18n\Filter\NumberFormat;

/**
 * Money form element that will make it very easy to work with money and currencies
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class Money extends Fieldset implements InputFilterProviderInterface
{
    protected $currency;

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
            'type' => Text::class,
            'name' => 'currency',
            'options' => [
                'label' => 'Currency'
            ]
        ]);
    }

    public function getCurrency()
    {
        if (null === $this->currency) {
            $this->currency = new CurrencyValueObject("USD");
        }

        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = new CurrencyValueObject($currency);
    }

    public function add($elementOrFieldset, array $flags = array())
    {
        throw new Exception('You can\'t add elements to money fieldset');
    }

    public function extract()
    {
        $data = parent::extract();
        $data['amount'] = money_format("%.2n", $data['amount']/100);
        return $data;
    }

    public function bindValues(array $values = array())
    {
        try {
            $values['amount'] = MoneyValueObject::stringToUnits($values['amount']);
        } catch (Exception $e) {
            throw new InvalidArgumentException(sprintf(
                '%s expects an parsable string or integer in amount index, "%s" given',
                __METHOD__,
                is_object($values['amount']) ? get_class($values['amount']) : gettype($values['amount'])
            ));
        }

        if (isset($values['currency'])) {
            $this->setCurrency($values['currency']);
        }

        return parent::bindValues($values);
    }

    public function getInputFilterSpecification()
    {
        return [
            [
                'name' => 'amount',
                'filters' => [
                    [
                        'name' => NumberFormat::class
                    ]
                ]
            ]
        ];
    }
}

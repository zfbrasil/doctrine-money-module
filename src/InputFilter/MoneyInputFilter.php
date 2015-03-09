<?php

namespace ZFBrasil\DoctrineMoneyModule\InputFilter;

use Zend\Filter\StringToUpper;
use Zend\I18n\Filter\NumberFormat;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use ZFBrasil\DoctrineMoneyModule\Filter\AmountFilter;

/**
 * @author Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class MoneyInputFilter extends InputFilter
{
    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->add([
            'name' => 'amount',
            'required' => true,
            'filters' => [
                ['name' => AmountFilter::class]
            ],
            'validators' => [
                ['name' => NotEmpty::class]
            ]
        ]);

        $this->add([
            'name' => 'currency',
            'required' => true,
            'filters' => [
                ['name' => StringToUpper::class]
            ],
            'validators' => [
                ['name' => NotEmpty::class]
            ]
        ]);
    }
}

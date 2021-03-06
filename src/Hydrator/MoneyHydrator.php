<?php

namespace ZFBrasil\DoctrineMoneyModule\Hydrator;

use Zend\Hydrator\HydratorInterface;
use Money\Money;
use Money\Currency;

/**
 * Hydrator for Money object.
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class MoneyHydrator implements HydratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        return [
            'amount' => $object->getAmount(),
            'currency' => $object->getCurrency()->getName(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return Money|null
     */
    public function hydrate(array $data, $object)
    {
        if (empty($data['amount']) || empty($data['currency'])) {
            return null;
        }

        return new Money(
            $data['amount'],
            new Currency($data['currency'])
        );
    }
}

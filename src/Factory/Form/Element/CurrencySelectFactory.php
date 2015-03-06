<?php

namespace ZFBrasil\DoctrineMoneyModule\Factory\Form\Element;

use Zend\Form\FormElementManager;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use InvalidArgumentException;

/**
 * Money form element that will make it very easy to work with money and currencies
 *
 * @author Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class CurrencySelectFactory
{
    /**
     * @param FormElementManager $formElementManager
     * @return CurrencySelect
     */
    public function __invoke(FormElementManager $formElementManager)
    {
        $serviceManager = $formElementManager->getServiceLocator();
        $config = $serviceManager->get('Config');

        if (! isset($config['ZFBrasil\\DoctrineMoneyModule']['currencies'])) {
            throw new InvalidArgumentException('Couldn\'t find currencies configuration.');
        }

        $select = new CurrencySelect();
        $select->setValueOptions($config['ZFBrasil\\DoctrineMoneyModule']['currencies']);

        return $select;
    }
}

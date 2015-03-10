<?php

namespace ZFBrasil\DoctrineMoneyModule\Form\Element\Factory;

use Zend\Form\FormElementManager;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use InvalidArgumentException;

/**
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

        if (! isset($config['money']['currencies'])) {
            throw new InvalidArgumentException('Couldn\'t find currencies configuration.');
        }

        $select = new CurrencySelect();
        $select->setValueOptions($config['money']['currencies']);

        return $select;
    }
}

<?php

namespace ZFBrasil\DoctrineMoneyModuleTest\Factory\Form\Element;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Form\FormElementManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use ZFBrasil\DoctrineMoneyModule\Factory\Form\Element\CurrencySelectFactory;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;

class CurrencySelectFactoryTest extends TestCase
{
    /**
     * @var ServiceManager
     */
    private $serviceManager;

    private $config = [
        'ZFBrasil\\DoctrineMoneyModule' => [
            'currencies' => [
                'BRL' => 'Brazilian Real',
                'SAD' => 'Sad Asteka'
            ]
        ]
    ];

    public function setUp()
    {
        $this->serviceManager = new ServiceManager(new Config($this->config));
        $this->serviceManager->setService('Config', $this->config);
    }

    public function testFactoryCanCreateElement()
    {
        $factory = new CurrencySelectFactory();

        $formElementManager = $this->getMock(FormElementManager::class);
        $formElementManager->expects($this->once())->method('getServiceLocator')->willReturn($this->serviceManager);

        $this->assertInstanceOf(CurrencySelect::class, $factory($formElementManager));
    }

    public function testFactoryCreateElementWithExpectedCurrencies()
    {
        $factory = new CurrencySelectFactory();

        $formElementManager = $this->getMock(FormElementManager::class);
        $formElementManager->expects($this->once())->method('getServiceLocator')->willReturn($this->serviceManager);

        /* @var CurrencySelect $currencySelect */
        $currencySelect = $factory($formElementManager);

        $this->assertEquals($this->config['ZFBrasil\\DoctrineMoneyModule']['currencies'], $currencySelect->getValueOptions());
    }
}

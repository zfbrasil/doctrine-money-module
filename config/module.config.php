<?php

namespace ZFBrasil\DoctrineMoneyModule;

use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use ZFBrasil\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;
use ZFBrasil\DoctrineMoneyModule\Form\MoneyFieldset;
use ZFBrasil\DoctrineMoneyModule\View\Helper\MoneyFormat;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use ZFBrasil\DoctrineMoneyModule\Form\Element\Factory\CurrencySelectFactory;

return [
    'form_elements' => [
        'aliases' => [
            'money' => MoneyFieldset::class,
            'currencyselect' => CurrencySelect::class,
        ],
        'factories' => [
            CurrencySelect::class => CurrencySelectFactory::class,
            MoneyFieldset::class => MoneyFieldsetFactory::class
        ]
    ],
    'view_helpers' => [
        'aliases' => [
            'moneyFormat' => MoneyFormat::class
        ],
        'invokables' => [
            MoneyFormat::class => MoneyFormat::class
        ]
    ],
    'doctrine' => [
        'driver' => [
            'money_driver_orm' => [
                'class' => PHPDriver::class,
                'paths' => [
                    __DIR__ . '/../mapping/PHPDriver/orm'
                ]
            ],
            'money_driver_odm_mongodb' => [
                'class' => PHPDriver::class,
                'paths' => [
                    __DIR__ . '/../mapping/PHPDriver/odm-mongodb'
                ]
            ],
        ],
    ],
    'money' => [
        'currencies' => require __DIR__ . '/currencies.config.php'
    ]
];

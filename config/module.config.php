<?php

use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use ZFBrasil\DoctrineMoneyModule\DBAL\Types\CurrencyType;
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
            'money_driver' => [
                'class' => PHPDriver::class,
                'paths' => [
                    __DIR__ . '/../mapping/PHPDriver/orm'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Money\Money' => 'money_driver'
                ],
            ],
        ],
        'connection' => [
            'orm_default' => [
                'doctrine_type_mappings' => [
                    'currency' => 'currency',
                ],
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'types' => [
                    'currency' => CurrencyType::class
                ]
            ]
        ]
    ],
    'money' => [
        'currencies' => require __DIR__ . '/currencies.config.php'
    ]
];

<?php

return [
    'view_helpers' => [
        'aliases' => [
            'MoneyFormat' => 'DoctrineMoneyModule\View\Helper\MoneyFormat'
        ],
        'invokables' => [
            'DoctrineMoneyModule\View\Helper\MoneyFormat' => 'DoctrineMoneyModule\View\Helper\MoneyFormat'
        ]
    ],
    'doctrine' => [
        'driver' => [
            'money_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\PHPDriver',
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
                    'currency' => 'DoctrineMoneyModule\DBAL\Types\CurrencyType',
                ],
            ],
        ],
    ],
];

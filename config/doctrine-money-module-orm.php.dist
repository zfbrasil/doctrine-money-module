<?php

namespace ZFBrasil\DoctrineMoneyModule;

return [
    'doctrine' => [
        'driver' => [
            'orm_default' => [
                'drivers' => [
                    'Money\Money' => 'money_driver_orm'
                ],
            ]
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
                    'currency' => DBAL\Types\CurrencyType::class
                ]
            ],
        ]
    ]
];

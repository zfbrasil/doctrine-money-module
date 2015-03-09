<?php

namespace ZFBrasil\DoctrineMoneyModule;

/**
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class Module implements ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return require __DIR__ . '/../config/module.config.php';
    }
}

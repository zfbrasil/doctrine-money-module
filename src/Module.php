<?php

namespace ZFBrasil\DoctrineMoneyModule;

/**
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class Module
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}

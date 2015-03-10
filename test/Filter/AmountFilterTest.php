<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Filter;

use PHPUnit_Framework_TestCase as TestCase;
use ZFBrasil\DoctrineMoneyModule\Filter\AmountFilter;

/**
 * @author  Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class AmountFilterTest extends TestCase
{
    public function testFiltersValueAsExpected()
    {
        $filter = new AmountFilter();

        $this->assertEquals(20000, $filter->filter(200));
    }
}

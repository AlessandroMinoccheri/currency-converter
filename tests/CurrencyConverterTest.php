<?php

namespace Tests;

use CurrencyConverter\CurrencyConverter;

class CurrencyConverterTest extends \PHPUnit\Framework\TestCase
{
    public function testConvertWithNotExistingCurrency()
    {
        $currencyConverter = new CurrencyConverter();
        $result = $currencyConverter->convert('notExist', 'bar', random_int(1, 999999));

        $this->assertEquals(0, $result);
    }

    public function testConvert()
    {
        $currencyConverter = new CurrencyConverter();
        $result = $currencyConverter->convert('EUR', 'USD', random_int(1, 999999));

        $this->assertNotEquals(0, $result);
    }
}
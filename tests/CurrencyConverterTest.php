<?php

namespace Tests;

use CurrencyConverter\CurrencyConverter;

class CurrencyConverterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException  \Exception
     */
    public function testConvertWithNotExistingCurrency()
    {
        $currencyConverter = new CurrencyConverter('apiKey');
        $result = $currencyConverter->convert('notExist', 'bar', random_int(1, 999999));
    }

    /**
     * @expectedException  \Exception
     */
    public function testConvertWithinValidCurrencyProvided()
    {
        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->convert('EUR', 'USD', random_int(1, 999999));
    }
}

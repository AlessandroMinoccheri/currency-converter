<?php

namespace Tests;

use CurrencyConverter\CurrencyConverter;
use CurrencyConverter\Rates;

class CurrencyConverterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException  \Exception
     */
    public function testConvertWithNotExistingApiKey()
    {
        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->convert('foo', 'bar', random_int(1, 999999));
    }

    public function testConvertWithinValidCurrencyProvided()
    {
        $fromCurrency = 'EUR';
        $toCurrency = 'USD';
        $expected = 100;

        $rates = $this->prophesize(Rates::class);
        $rates->getRates($fromCurrency, $toCurrency)->willReturn($expected);

        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->setRates($rates->reveal());
        $result = $currencyConverter->convert($fromCurrency, $toCurrency, random_int(1, 999999));

        $this->assertNotEquals($expected, $result);
    }

    public function testConvertWithNotValidResponseReturn0()
    {
        $fromCurrency = 'EUR';
        $toCurrency = 'USD';
        $value = 0;

        $rates = $this->prophesize(Rates::class);
        $rates->getRates($fromCurrency, $toCurrency)->willReturn($value);

        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->setRates($rates->reveal());
        $result = $currencyConverter->convert($fromCurrency, $toCurrency, random_int(1, 999999));

        $this->assertEquals(0, $result);
    }

    public function testGetRates()
    {
        $fromCurrency = 'EUR';
        $toCurrency = 'USD';
        $value = 100;

        $rates = $this->prophesize(Rates::class);
        $rates->getRates($fromCurrency, $toCurrency)->willReturn($value);

        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->setRates($rates->reveal());
        $result = $currencyConverter->getRates($fromCurrency, $toCurrency);

        $this->assertEquals($value, $result);
    }

    public function setTestApiCaller()
    {
        $apiCallerMock = $this->prophesize(ApiCaller::class);

        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->setApiCaller($apiCaller->reveal());
        
        $apiCaller = $currencyConverter->getApiCaller();
        $this->assertEquals($apiCallerMock, $apiCaller);
    }
}

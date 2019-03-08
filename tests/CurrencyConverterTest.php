<?php

namespace Tests;

use CurrencyConverter\ApiCaller;
use CurrencyConverter\CurrencyConverter;

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

        $apiCaller = $this->prophesize(ApiCaller::class);
        $apiCaller->convert($fromCurrency, $toCurrency)->willReturn($expected);
        $apiCaller->isLastCallEmpty()->willReturn(false);
        $apiCaller->getLastResponse()->willReturn(json_encode([$fromCurrency . '_' . $toCurrency => $expected]));

        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->setApiCaller($apiCaller->reveal());
        $result = $currencyConverter->convert($fromCurrency, $toCurrency, random_int(1, 999999));

        $this->assertNotEquals($expected, $result);
    }

    public function testConvertWithNotValidResponseReturn0()
    {
        $fromCurrency = 'EUR';
        $toCurrency = 'USD';
        $value = 100;

        $apiCaller = $this->prophesize(ApiCaller::class);
        $apiCaller->convert($fromCurrency, $toCurrency)->willReturn($value);
        $apiCaller->isLastCallEmpty()->willReturn(false);
        $apiCaller->getLastResponse()->willReturn(json_encode(['notEsistKey' => $value]));

        $currencyConverter = new CurrencyConverter('apiKey');
        $currencyConverter->setApiCaller($apiCaller->reveal());
        $result = $currencyConverter->convert($fromCurrency, $toCurrency, random_int(1, 999999));

        $this->assertEquals(0, $result);
    }
}

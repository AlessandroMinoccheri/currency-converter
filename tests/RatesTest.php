<?php

namespace Tests;

use CurrencyConverter\Rates;

class RatesTest extends \PHPUnit\Framework\TestCase
{
    public function testReturnsZeroWheneverApiProvideEmptyResponse()
    {
        $this->apiCaller = $this
            ->getMockBuilder('CurrencyConverter\ApiCaller')
            ->disableOriginalConstructor()
            ->getMock();

        $this->rates = new Rates($this->apiCaller);

        $this->apiCaller->expects($this->once())
            ->method('convert')
            ->with('FOO', 'BAR');

        $this->apiCaller->expects($this->once())
            ->method('isLastCallEmpty')
            ->willReturn(true);

        $result = $this->rates->getRates('FOO', 'BAR');

        $this->assertEquals(0, $result);
    }

    public function testReturnRates()
    {
        $from = 'FOO';
        $to = 'BAR';
        $expected = 100;

        $this->apiCaller = $this
            ->getMockBuilder('CurrencyConverter\ApiCaller')
            ->disableOriginalConstructor()
            ->getMock();

        $this->rates = new Rates($this->apiCaller);

        $this->apiCaller->expects($this->once())
            ->method('convert')
            ->with('FOO', 'BAR');

        $this->apiCaller->expects($this->once())
            ->method('isLastCallEmpty')
            ->willReturn(false);

        $this->apiCaller->expects($this->once())
             ->method('getLastResponse')
             ->willReturn(json_encode([$from . '_' . $to => $expected]));

        $result = $this->rates->getRates($from, $to);

        $this->assertEquals($expected, $result);
    }
}

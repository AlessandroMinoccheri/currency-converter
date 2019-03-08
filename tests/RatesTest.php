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
}

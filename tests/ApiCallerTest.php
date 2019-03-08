<?php

namespace Tests;

use CurrencyConverter\ApiCaller;
use CurrencyConverter\Rates;

class ApiCallerTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->apiCaller = new ApiCaller('apiKey');
    }
    /**
     * @expectedException  \Exception
     */
    public function testCallApiWithANotValidApiKeyGenerateErrorAndThrwoException()
    {
        $this->apiCaller->convert('bar', 'baz');
    }

    public function testIsLastCallEmpty()
    {
        $this->assertTrue($this->apiCaller->isLastCallEmpty());
    }

    public function testGetLastResponse()
    {
        $this->assertNull($this->apiCaller->getLastResponse());
    } 
}

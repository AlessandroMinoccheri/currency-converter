<?php

/**
 * Created by PhpStorm.
 * User: alessandrominoccheri
 * Date: 05/09/18
 * Time: 12:59
 */

namespace CurrencyConverter;

class Rates
{
    private $apiCaller;

    public function __construct(ApiCaller $apiCaller)
    {
        $this->apiCaller = $apiCaller;
    }

    public function getRates(string $fromCurrency, string $toCurrency) :float
    {
        $this->apiCaller->convert(
            $fromCurrency,
            $toCurrency
        );

        if ($this->apiCaller->isLastCallEmpty()) {
            return 0;
        }

        $result = $this->apiCaller->getLastResponse();

        $conversion = json_decode($result, true);
        $key = $fromCurrency . '_' . $toCurrency;

        if (!isset($conversion[$key])) {
            return 0;
        }

        return $conversion[$fromCurrency . '_' . $toCurrency];
    }

}

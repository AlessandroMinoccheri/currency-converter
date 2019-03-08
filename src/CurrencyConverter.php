<?php

namespace CurrencyConverter;

class CurrencyConverter
{
    private $fromCurrency;

    private $toCurrency;

    private $apiKey;

    private $apiCaller;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->apiCaller = new ApiCaller($apiKey);
    }

    public function convert(string $fromCurrency, string $toCurrency, $amount) :float
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;

        $rates = new Rates($this->apiCaller);

        $rate = $rates->getRates($fromCurrency, $toCurrency);

        return $this->calculateValue($rate, $amount);
    }

    private function calculateValue($rate, $amount) :float
    {
        $value = (double)$rate * (double)$amount;

        return number_format((double)$value, 2, '.', '');
    }

    public function setApiCaller(ApiCaller $apiCaller)
    {
        $this->apiCaller = $apiCaller;
    }
}

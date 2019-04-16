<?php

namespace CurrencyConverter;

class CurrencyConverter
{
    private $fromCurrency;

    private $toCurrency;

    private $apiKey;

    private $apiCaller;

    private $rates;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->apiCaller = new ApiCaller($apiKey);
        $this->rates = new Rates($this->apiCaller);
    }

    public function convert(string $fromCurrency, string $toCurrency, $amount) :float
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;

        $rate = $this->rates->getRates($fromCurrency, $toCurrency);

        return $this->calculateValue($rate, $amount);
    }

    public function getRates(string $fromCurrency, string $toCurrency) :float
    {
        return $this->rates->getRates($fromCurrency, $toCurrency);
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

    public function setRates(Rates $rates)
    {
        $this->rates = $rates;
    }

    public function getApiCaller() :ApiCaller
    {
        return $this->apiCaller;
    }
}

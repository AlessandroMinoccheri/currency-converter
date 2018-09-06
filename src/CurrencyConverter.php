<?php

namespace CurrencyConverter;

class CurrencyConverter
{
    private $fromCurrency;

    private $toCurrency;

    public function __construct()
    {
    }

    public function convert(string $fromCurrency, string $toCurrency, $amount) :float
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;

        $rates = new Rates(
            new ApiCaller()
        );

        $rate = $rates->getRates($fromCurrency, $toCurrency);

        return $this->calculateValue($rate, $amount);
    }

    private function calculateValue($rate, $amount) :float
    {
        $value = (double)$rate * (double)$amount;

        return number_format((double)$value, 2, '.', '');
    }
}

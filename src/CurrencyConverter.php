<?php


class CurrencyConverter
{
    private $fromCurrency;

    private $toCurrency;

    public function convert(string $fromCurrency, string $toCurrency, $amount) :float
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;

        $rate = $this->getRates();

        return $this->calculateValue($rate, $amount);
    }

    private function getRates()
    {
        $url = 'https://free.currencyconverterapi.com/api/v5/convert?q=' .
            $this->fromCurrency . '_' . $this->toCurrency . '&compact=ultra' ;
        $handle = @fopen($url, 'r');

        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }

        if (!isset($result)) {
            return 0;
        }

        $conversion = json_decode($result, true);
        $key = $this->fromCurrency . '_' . $this->toCurrency;

        if (!isset($conversion[$key])) {
            return 0;
        }

        return $conversion[$this->fromCurrency . '_' . $this->toCurrency];
    }

    private function calculateValue($rate, $amount) :float
    {
        $value = (double)$rate * (double)$amount;

        return number_format((double)$value, 2, '.', '');
    }
}
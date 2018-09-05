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
    public static function getRates(string $fromCurrency, $toCurrency)
    {
        $url = 'https://free.currencyconverterapi.com/api/v5/convert?q=' .
            $fromCurrency . '_' . $toCurrency . '&compact=ultra' ;
        $handle = @fopen($url, 'r');

        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }

        if (!isset($result)) {
            return 0;
        }

        $conversion = json_decode($result, true);
        $key = $fromCurrency . '_' . $toCurrency;

        if (!isset($conversion[$key])) {
            return 0;
        }

        return $conversion[$fromCurrency . '_' . $toCurrency];
    }

}
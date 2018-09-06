<?php

namespace CurrencyConverter;

class ApiCaller
{
    private $response;

    public function convert($from, $to)
    {
        $url = 'https://free.currencyconverterapi.com'
            . '/api/v5/convert'
            . '?q=' .  $from . '_' . $to
            . '&compact=ultra' ;

        if ($handle = @fopen($url, 'r')) {
            $this->response = fgets($handle, 4096);
            fclose($handle);
        }
    }

    public function isLastCallEmpty() : bool
    {
        return $this->response == null;
    }

    public function getLastResponse() : string
    {
        return $this->response;
    }
}

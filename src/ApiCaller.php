<?php

namespace CurrencyConverter;

class ApiCaller
{
    private $response;

    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function convert($from, $to)
    {
        $url = 'https://free.currencyconverterapi.com'
            . '/api/v5/convert'
            . '?q=' . $from . '_' . $to
            . '&compact=ultra'
            . '&apiKey=' . $this->apiKey;


        if ($handle = @fopen($url, 'r')) {
            $this->response = fgets($handle, 4096);

            fclose($handle);

            return;
        }

        $errorMessage = 'Error on convert rates';

        $errors = error_get_last();
        if (isset ($errors['message'])) {
            $errorMessage = $errors['message'];
        }

        throw new \Exception($errorMessage);
    }

    public function isLastCallEmpty(): bool
    {
        return $this->response == null;
    }

    public function getLastResponse(): string
    {
        return $this->response;
    }
}

# currency-converter

Php library to convert a currency into another

Work in progress

## Make

This project uses Makefile to run tasks.

 - make agile
   it create an overview of test case methods presented as full sentences

 - make test
   runs classic phpunit tests

 - make coverage
   create and open in browser code coverage

## Usage

If you want to use this library you need to create a new instance of ```CurrencyConverter``` and after call the method ```convert```like this

```
$currencyConverter = new CurrencyConverter();
$result = $currencyConverter->convert('EUR', 'USD', random_int(1, 999999));
```
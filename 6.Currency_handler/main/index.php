<?php

require_once "/vendor/autoload.php";

//currency test

$test = new HomeWorkSeven\Classes\Currency('UAH');

echo $test->getCode();

$test2 = new HomeWorkSeven\Classes\Currency('USD');

$test3 = new HomeWorkSeven\Classes\Currency('UAH');

echo "\n";

var_dump($test->equals($test2));

echo "\n";

var_dump($test->equals($test3));



//money test


$currencyTest = new HomeWorkSeven\Classes\Currency('UAH');
$currencyTest2= new HomeWorkSeven\Classes\Currency('USD');

$moneyTest = new HomeWorkSeven\Classes\Money(12 , $currencyTest);
$moneyTest2 = new HomeWorkSeven\Classes\Money(123, $currencyTest);

echo "<pre>";

var_dump($moneyTest);
var_dump($moneyTest2);

var_dump($moneyTest->equals($moneyTest2));
$moneyTest->add($moneyTest2);

var_dump($moneyTest);


echo $moneyTest->getAmount();

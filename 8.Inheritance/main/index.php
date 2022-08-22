<?php

require_once("/vendor/autoload.php");

$shaurma1 = new Shaurmichna\Kinds\OdesskaShaurma();
$shaurma2 = new Shaurmichna\Kinds\BeefShaurma();
$shaurma3 = new Shaurmichna\Kinds\MuttonShaurma();

echo $shaurma1->getTitle() . ", цена: " . $shaurma1->getCost() . "<br>";
echo $shaurma2->getTitle() . ", цена: " . $shaurma2->getCost() . "<br>";
echo $shaurma3->getTitle() . ", цена: " . $shaurma2->getCost() . "<br>";

$order = new Shaurmichna\Transformations\ShaurmaCalculator();

$order->add($shaurma1);
$order->add($shaurma2);
$order->add($shaurma3);

echo "Ингредиенты: " . $order->getAllIngredients() . "<br>";
echo $order->getPrice();


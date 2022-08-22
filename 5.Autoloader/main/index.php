<?php

require_once "/vendor/alt_autoload.php";

$test = new \Hillel\Model\User();
$test2= new \Hillel\View\User();
$test3= new \Hillel\Controller\User();

echo "<pre>";

$name=$test->test();

echo "\n";

var_dump($test);

var_dump($name);

var_dump($test2);

var_dump($test3);

echo "</pre>";

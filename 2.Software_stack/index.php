<?php

$connect_db = new PDO('mysql:host=db;port=3306', 'root', 'test');


echo "<pre>";
var_dump($connect_db);
echo "</pre>";

phpinfo();

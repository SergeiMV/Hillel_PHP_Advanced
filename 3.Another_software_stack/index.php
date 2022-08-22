<?php

$connect_db = new PDO('pgsql:host=db;port=5432', 'postgres', 'test');


echo "<pre>";
var_dump($connect_db);
echo "</pre>";

phpinfo();

<?php

$text = [
    "<font color='green'>Initializating...",
    "Updating blueprints...",
    "Building factory...",
    "Implementing new technologies...",
    "Making some tests...",
    "</font><font color='red'>Calibrating...",
    "Calibrating...</font><font color='green'>",
    "Calibrating...",
    "Done!</font><br>"
];

for ($i = 0; $i < count($text); $i++) {
    echo $text[$i] . "<br>";
    flush();
    sleep(1);
}

sleep(3);

echo '<script>location.replace("./site.php");</script>';
exit;

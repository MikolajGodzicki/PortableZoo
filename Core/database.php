<?php

if (!isset($_GET['Option'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$Option = $_GET['Option'];

switch ($Option) {
    case "CreateDB":
        break;
    case "CreateTable":
        break;
    default:
        echo "Nie znaleziono polecenia!";
        break;
}

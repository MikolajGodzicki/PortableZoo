<?php

if (!isset($_GET['Option'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$Option = $_GET['Option'];

include_once "../Defines/defines.php";
include_once "coredb.php";

include("./Options/$Option.php");

Show("in");

echo "<a href='" . PRE_INDEX_PHP . "'>Wróć</a>";

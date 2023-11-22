<?php

if (!isset($_GET['Option'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$Option = $_GET['Option'];

include_once "../Defines/defines.php";
include_once "coredb.php";

$connection = DB_Connect();

include("./Options/$Option.php");

Show("in");

DB_Dispose($connection);

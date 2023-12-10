<?php

if (!isset($_GET['Option'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$Option = $_GET['Option'];

include_once "../Defines/defines.php";
include_once "coredb.php";

$db = CoreDatabase::get_instance();

if (!$db->CheckIfDatabaseIsCreated()) {
    ShowAlert("Najpierw utwórz bazę danych!", PRE_INDEX_PHP);
    return;
}

if (!$db->CheckIfTableIsCreated(strtolower($Option))) {
    ShowAlert("Najpierw utwórz tabelę!", PRE_INDEX_PHP);
    return;
}

include("./Options/$Option/$Option.php");

Show("modification");


echo "<a href='" . PRE_INDEX_PHP . "'>Wróć</a>";

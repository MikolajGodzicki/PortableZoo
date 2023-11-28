<?php

if (!isset($_GET['Option'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$Option = $_GET['Option'];

include_once "../Defines/defines.php";
include_once "coredb.php";

$db = CoreDatabase::get_instance();

switch ($Option) {
    case "CreateDB":
        $db->CreateDatabase();
        ShowAlert("Pomyślnie utworzono bazę danych!", PRE_INDEX_PHP);
        break;
    case "CreateTables":
        if (!$db->CheckIfDatabaseIsCreated()) {
            ShowAlert("Najpierw utwórz bazę danych!", PRE_INDEX_PHP);
            return;
        }

        $db->CreateTables();
        ShowAlert("Pomyślnie utworzono tabele w bazie!", PRE_INDEX_PHP);
        break;
    default:
        ShowAlert("Nie znaleziono polecenia!", PRE_INDEX_PHP);
        break;
}

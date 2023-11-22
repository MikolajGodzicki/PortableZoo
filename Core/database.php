<?php

if (!isset($_GET['Option'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$Option = $_GET['Option'];

include_once "../Defines/defines.php";
include_once "coredb.php";

$connection = DB_Connect();

switch ($Option) {
    case "CreateDB":
        CreateDatabase($connection);
        DB_Dispose($connection);
        echo "<script>
            alert('Pomyślnie utworzono bazę danych!');
            window.location.href='" . PRE_INDEX_PHP . "';
        </script>";
        break;
    case "CreateTables":
        CreateTables($connection);
        DB_Dispose($connection);
        echo "<script>
            alert('Pomyślnie utworzono tabele w bazie!');
            window.location.href='" . PRE_INDEX_PHP . "';
        </script>";
        break;
    default:
        echo "Nie znaleziono polecenia!";
        break;
}

DB_Dispose($connection);

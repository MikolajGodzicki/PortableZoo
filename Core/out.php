<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body><?php

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

        Show("out");

        echo "<hr>";

        echo "<a href='" . PRE_INDEX_PHP . "'>Wróć</a>";

        ?>
</body>

</html>
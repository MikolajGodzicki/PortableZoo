<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>PortableZoo</title>
</head>

<body>
    <?php
    include_once "./Core/coredb.php";
    include_once "Defines/defines.php";

    if ($_SESSION[ACCESS] == AUTH_NO) {
        header(HEADER_AUTH_LOGIN_PHP);
    }

    ?>
    <div id="LeftSide">
        <div class="FormField">
            <form method="GET" action="./Core/database.php">
                <fieldset>
                    <legend>Baza danych</legend>
                    <?php
                    $db = CoreDatabase::get_instance();
                    if (!$db->CheckIfDatabaseIsCreated()) {
                    ?>
                        <button type="submit" class="btn btn-success" name="Option" value="CreateDB">Stwórz bazę danych</button>
                    <?php
                    } else {
                    ?>
                        <button type="submit" class="btn btn-success" name="Option" value="CreateDB" disabled>Baza danych jest stworzona</button>
                    <?php
                    }

                    if (!$db->CheckIfTablesIsCreated()) {
                    ?>
                        <button type="submit" class="btn btn-success" name="Option" value="CreateTables">Stwórz tabele</button>
                    <?php
                    } else {
                    ?>
                        <button type="submit" class="btn btn-success" name="Option" value="CreateTables" disabled>Tabele są stworzone</button>
                    <?php
                    }
                    ?>
                </fieldset>
            </form>
        </div>

        <div class="FormField">
            <form method="GET" action="./Core/in.php">
                <fieldset>
                    <legend>Dodawanie</legend>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Zabiegi">Zabiegi</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wykonane_Zabiegi">Wykonane Zabiegi</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wizyty">Wizyty</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Kolory">Kolory</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Zwierzeta">Zwierzęta</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wykorzystane_Leki">Wykorzystane Leki</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wlasciciele">Właściciele</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Leki">Leki</button>
                </fieldset>
            </form>
        </div>

        <div class="FormField">
            <form method="GET" action="./Core/modification.php">
                <fieldset>
                    <legend>Modyfikacja</legend>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Zabiegi">Zabiegi</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wykonane_Zabiegi">Wykonane Zabiegi</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wizyty">Wizyty</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Kolory">Kolory</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Zwierzeta">Zwierzęta</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wykorzystane_Leki">Wykorzystane Leki</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wlasciciele">Właściciele</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Leki">Leki</button>
                </fieldset>
            </form>
        </div>

        <div class="FormField">
            <form method="GET" action="./Core/out.php">
                <fieldset>
                    <legend>Wypisywanie</legend>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Zabiegi">Zabiegi</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wykonane_Zabiegi">Wykonane Zabiegi</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wizyty">Wizyty</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Kolory">Kolory</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Zwierzeta">Zwierzęta</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wykorzystane_Leki">Wykorzystane Leki</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Wlasciciele">Właściciele</button>
                    <button type="submit" class="btn btn-secondary" name="Option" value="Leki">Leki</button>
                </fieldset>
            </form>
        </div>
    </div>
    <div id="RightSide">
        <div id="RightContent">

            <?php
            echo "Zalogowano jako: " . $_SESSION[USER_NAME];
            ?>
            <br />
            <button class="btn btn-danger">
                <a href="./auth/logout.php" id="logout">Wyloguj się</a>
            </button>
        </div>
    </div>
</body>

</html>
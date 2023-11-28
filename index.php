<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>PortableZoo</title>
</head>

<body>
    <?php
    include_once "Defines/defines.php";

    if ($_SESSION[ACCESS] == AUTH_NO) {
        header(HEADER_AUTH_LOGIN_PHP);
    }

    ?>
    <div id="LeftSide">

        <form method="GET" action="./Core/database.php">
            <fieldset>
                <legend>Baza danych</legend>
                <button type="submit" name="Option" value="CreateDB">Stwórz bazę danych</button>
                <button type="submit" name="Option" value="CreateTables">Stwórz tabele</button>
            </fieldset>
        </form>

        <form method="GET" action="./Core/in.php">
            <fieldset>
                <legend>Dodawanie</legend>
                <button type="submit" name="Option" value="Zabiegi">Zabiegi</button>
                <button type="submit" name="Option" value="Wykonane_Zabiegi">Wykonane Zabiegi</button>
                <button type="submit" name="Option" value="Wizyty">Wizyty</button>
                <button type="submit" name="Option" value="Kolory">Kolory</button>
                <button type="submit" name="Option" value="Zwierzeta">Zwierzęta</button>
                <button type="submit" name="Option" value="Wykorzystane_Leki">Wykorzystane Leki</button>
                <button type="submit" name="Option" value="Wlasciciele">Właściciele</button>
                <button type="submit" name="Option" value="Leki">Leki</button>
            </fieldset>
        </form>

        <form method="GET" action="./Core/modification.php">
            <fieldset>
                <legend>Modyfikacja</legend>
                <button type="submit" name="Option" value="Zabiegi">Zabiegi</button>
                <button type="submit" name="Option" value="Wykonane_Zabiegi">Wykonane Zabiegi</button>
                <button type="submit" name="Option" value="Wizyty">Wizyty</button>
                <button type="submit" name="Option" value="Kolory">Kolory</button>
                <button type="submit" name="Option" value="Zwierzeta">Zwierzęta</button>
                <button type="submit" name="Option" value="Wykorzystane_Leki">Wykorzystane Leki</button>
                <button type="submit" name="Option" value="Wlasciciele">Właściciele</button>
                <button type="submit" name="Option" value="Leki">Leki</button>
            </fieldset>
        </form>

        <form method="GET" action="./Core/out.php">
            <fieldset>
                <legend>Wypisywanie</legend>
                <button type="submit" name="Option" value="Zabiegi">Zabiegi</button>
                <button type="submit" name="Option" value="Wykonane_Zabiegi">Wykonane Zabiegi</button>
                <button type="submit" name="Option" value="Wizyty">Wizyty</button>
                <button type="submit" name="Option" value="Kolory">Kolory</button>
                <button type="submit" name="Option" value="Zwierzeta">Zwierzęta</button>
                <button type="submit" name="Option" value="Wykorzystane_Leki">Wykorzystane Leki</button>
                <button type="submit" name="Option" value="Wlasciciele">Właściciele</button>
                <button type="submit" name="Option" value="Leki">Leki</button>
            </fieldset>
        </form>
    </div>
    <div id="RightSide">
        <?php
        echo "Zalogowano jako: " . $_SESSION[USER_NAME];
        ?>
        <a href="./auth/logout.php">Wyloguj się</a>
    </div>
</body>

</html>
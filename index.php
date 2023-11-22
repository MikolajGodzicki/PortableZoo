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
        <div id="DatabasePanel">
            <form method="GET" action="./Core/database.php">
                <button type="submit" name="Option" value="CreateDB">Stwórz bazę</button>
                <button type="submit" name="Option" value="CreateTable">Stwórz tabele</button>
            </form>
        </div>

        <div id="InPanel">
            <form method="GET" action="./Core/in.php">
                <button type="submit" name="Option" value="Zabiegi">Zabiegi</button>
                <button type="submit" name="Option" value="WykonaneZabiegi">Wykonane Zabiegi</button>
                <button type="submit" name="Option" value="Wizyty">Wizyty</button>
                <button type="submit" name="Option" value="Kolory">Kolory</button>
                <button type="submit" name="Option" value="Zwierzeta">Zwierzęta</button>
                <button type="submit" name="Option" value="WykorzystaneLeki">Wykorzystane Leki</button>
                <button type="submit" name="Option" value="Wlasciciele">Właściciele</button>
                <button type="submit" name="Option" value="Leki">Leki</button>
            </form>
        </div>

        <div id="ModificationPanel">
            <form method="GET" action="./Core/modification.php">
                <button type="submit" name="Option" value="Zabiegi">Zabiegi</button>
                <button type="submit" name="Option" value="WykonaneZabiegi">Wykonane Zabiegi</button>
                <button type="submit" name="Option" value="Wizyty">Wizyty</button>
                <button type="submit" name="Option" value="Kolory">Kolory</button>
                <button type="submit" name="Option" value="Zwierzeta">Zwierzęta</button>
                <button type="submit" name="Option" value="WykorzystaneLeki">Wykorzystane Leki</button>
                <button type="submit" name="Option" value="Wlasciciele">Właściciele</button>
                <button type="submit" name="Option" value="Leki">Leki</button>
            </form>
        </div>

        <div id="OutPanel">
            <form method="GET" action="./Core/out.php">
                <button type="submit" name="Option" value="Zabiegi">Zabiegi</button>
                <button type="submit" name="Option" value="WykonaneZabiegi">Wykonane Zabiegi</button>
                <button type="submit" name="Option" value="Wizyty">Wizyty</button>
                <button type="submit" name="Option" value="Kolory">Kolory</button>
                <button type="submit" name="Option" value="Zwierzeta">Zwierzęta</button>
                <button type="submit" name="Option" value="WykorzystaneLeki">Wykorzystane Leki</button>
                <button type="submit" name="Option" value="Wlasciciele">Właściciele</button>
                <button type="submit" name="Option" value="Leki">Leki</button>
            </form>
        </div>
    </div>
    <div id="RightSide">
        <?php
        echo "Zalogowano jako: " . $_SESSION[USER_NAME];
        ?>
        <a href="./auth/logout.php">Wyloguj się</a>
    </div>
</body>

</html>
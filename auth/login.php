<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h2>Logowanie</h2>
    <form class="Form" method="POST" action="auth.php">
        <div class="mb-3">
            <label for="login" class="form-label">Login:</label>
            <input type="text" class="form-control" id="login" name="login" required /><br />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Hasło:</label>
            <input type="password" class="form-control" id="password" name="password" required /><br />
        </div>
        <input class="btn btn-success" type="submit" value="Zaloguj się" />

        <a href="registration.php">
            <input class="btn btn-success" type="button" value="Rejestracja" />
        </a>

        <input type="hidden" name="auth" value="login" />
    </form>

    <?php
    include_once "../Defines/defines.php";

    if (isset($_SESSION[ACCESS])) {
        if ($_SESSION[ACCESS] == AUTH_YES) {
            header(HEADER_PRE_INDEX_PHP);
        }
    }


    ?>
</body>

</html>
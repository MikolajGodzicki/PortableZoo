<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>

<body>
    <form method="POST" action="auth.php">
        <label>Login</label>
        <input type="text" name="login" required /><br />
        <label>Password</label>
        <input type="password" name="password" /><br />
        <input type="submit" value="Zarejestruj się" />

        <a href="login.php">
            <input type="button" value="Logowanie" />
        </a>

        <input type="hidden" name="auth" value="registration" />
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
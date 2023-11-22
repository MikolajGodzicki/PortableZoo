<?php
include_once "../Defines/defines.php";
include_once "authdb.php";

if (!isset($_POST['auth'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$login = $_POST['login'];
$password = $_POST['password'];
$auth = $_POST['auth'];

session_start();

$connection = DB_Connect();

switch ($auth) {
    case "login":
        if (CheckUser($connection, $login, $password)) {
            $_SESSION[ACCESS] = AUTH_YES;
            $_SESSION[USER_NAME] = $login;

            header(HEADER_PRE_INDEX_PHP);
            return;
        }

        $_SESSION[ACCESS] = AUTH_NO;
        header(HEADER_LOGIN_PHP);
        break;
    case "registration":
        AddUser($connection, $login, $password);
        $_SESSION[ACCESS] = AUTH_NO;
        header(HEADER_LOGIN_PHP);
        break;
}

function CheckUser($connection, $login, $password)
{
    $sql = "SELECT COUNT(1) FROM portablezooauth.users 
    WHERE login='$login' AND
    password='$password';";

    $result = mysqli_fetch_array(mysqli_query($connection, $sql))[0];

    if ($result == 1) {
        return true;
    }

    return false;
}

function AddUser($connection, $login, $password)
{
    $sql = "INSERT INTO portablezooauth.users 
    VALUES(NULL, '$login', '$password');";
    mysqli_query($connection, $sql);
}

DB_Dispose($connection);

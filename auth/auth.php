<?php
if (!isset($_POST['auth'])) {
    echo "Nie znaleziono polecenia.";
    return;
}

$login = $_POST['login'];
$password = $_POST['password'];
$auth = $_POST['auth'];

session_start();

include_once "../Defines/defines.php";
include_once "authdb.php";

$db = AuthDatabase::get_instance();

switch ($auth) {
    case "login":
        if (CheckUser($db, $login, $password)) {
            $_SESSION[ACCESS] = AUTH_YES;
            $_SESSION[USER_NAME] = $login;
            ShowAlert("Pomyślnie zalogowano!", PRE_INDEX_PHP);
            return;
        }

        $_SESSION[ACCESS] = AUTH_NO;
        ShowAlert("Niepoprawne dane!", LOGIN_PHP);
        break;
    case "registration":
        AddUser($db, $login, $password);
        $_SESSION[ACCESS] = AUTH_NO;
        ShowAlert("Pomyślnie zarejestrowano!", LOGIN_PHP);
        break;
}

function CheckUser($db, $login, $password)
{
    $sql = "SELECT COUNT(1) FROM portablezooauth.users 
    WHERE login='$login' AND
    password='" . md5($password) . "';";

    $result = mysqli_fetch_array($db->Query($sql))[0];

    if ($result == 1) {
        return true;
    }

    return false;
}

function AddUser($db, $login, $password)
{
    $sql = "INSERT INTO portablezooauth.users 
    VALUES(NULL, '$login', '" . md5($password) . "');";
    $db->Query($sql);
}

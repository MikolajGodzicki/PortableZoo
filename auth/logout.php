<?php
include_once "../Defines/defines.php";

session_start();

$_SESSION[ACCESS] = AUTH_NO;
$_SESSION[USER_NAME] = "";

header(HEADER_LOGIN_PHP);

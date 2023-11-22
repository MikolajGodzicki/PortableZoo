<?php
function DB_Connect()
{
    $login = "root";
    $passwd = "";
    $addr = "localhost";
    $db = "portablezooauth";

    $connection = mysqli_connect($addr, $login, $passwd) or die("Brak połaczenia " . mysqli_connect_error());

    CreateDatabase($connection, $db);

    mysqli_select_db($connection, $db);

    return $connection;
}

function CreateDatabase($connection, $db)
{
    $sql = "CREATE DATABASE IF NOT EXISTS $db";
    mysqli_query($connection, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS portablezooauth.users (
        id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
        login varchar(256) NOT NULL,
        password varchar(256) NOT NULL
      );";
    mysqli_query($connection, $sql);
}

function DB_Dispose($connection)
{
    mysqli_close($connection);
}

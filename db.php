<?php

function OpenConnection()
{
    global $polaczenie;

    $polaczenie = mysqli_connect("localhost", "root", "", "PortableZoo");
}

function CloseConnection()
{
}

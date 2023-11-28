<?php

$zwierzak = $_POST['zwierzak'];
$kiedy = $_POST['kiedy'];

$sql = "INSERT INTO Wizyty() VALUES (NULL, $zwierzak, '$kiedy')";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie dodano rekord!", PRE3_INDEX_PHP);

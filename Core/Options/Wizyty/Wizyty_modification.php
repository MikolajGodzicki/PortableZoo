<?php

$zwierzak = $_POST['zwierzak'];
$kiedy = $_POST['kiedy'];
$id = $_POST['id'];

$sql = "UPDATE wizyty SET ID_Zwierzaka=$zwierzak, Kiedy='$kiedy' WHERE wizyty.ID_Wizyty=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", '../../modification.php?Option=Wizyty');


<?php

$kolor = $_POST['kolor'];
$id = $_POST['id'];

$sql = "UPDATE kolory SET Kolor='$kolor' WHERE kolory.ID_Koloru=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", '../../modification.php?Option=Kolory');

?>
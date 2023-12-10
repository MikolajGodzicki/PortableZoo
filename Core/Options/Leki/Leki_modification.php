
<?php

$nazwa = $_POST['nazwa'];
$cena = $_POST['cena'];
$id = $_POST['id'];

$sql = "UPDATE leki SET Nazwa='$nazwa', Cena=$cena WHERE leki.ID_Leku=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", '../../modification.php?Option=Leki');

?>
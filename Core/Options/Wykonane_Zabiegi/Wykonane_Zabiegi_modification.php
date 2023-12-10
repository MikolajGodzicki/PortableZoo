
<?php

$zabieg = $_POST['zabieg'];
$wizyta = $_POST['wizyta'];
$id = $_POST['id'];

$sql = "UPDATE wykonane_zabiegi SET ID_Zabiegu=$zabieg, ID_Wizyty=$wizyta WHERE wykonane_zabiegi.ID_Operacji=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", '../../modification.php?Option=Wykonane_Zabiegi');

?>
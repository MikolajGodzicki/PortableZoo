
<?php

$nazwisko = $_POST['nazwisko'];
$imie = $_POST['imie'];
$ulica = $_POST['ulica'];
$miasto = $_POST['miasto'];
$poczta = $_POST['poczta'];
$telefon = $_POST['telefon'];
$id = $_POST['id'];

$sql = "UPDATE wlasciciele SET Nazwisko='$nazwisko', Imie='$imie', Ulica='$ulica', Miasto='$miasto', Poczta='$poczta', Telefon='$telefon' WHERE wlasciciele.ID_Wlasciciela=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", PRE3_INDEX_PHP);

?>
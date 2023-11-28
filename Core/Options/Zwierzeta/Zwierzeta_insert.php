
<?php

$rodzaj = $_POST['rodzaj'];
$imie = $_POST['imie'];
$data = $_POST['data'];
$kolor = $_POST['kolor'];
$wlasciciel = $_POST['wlasciciel'];

$sql = "INSERT INTO zwierzeta() VALUES (NULL, '$rodzaj', '$imie', '$data', $kolor, $wlasciciel)";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie dodano rekord!", PRE3_INDEX_PHP);

?>
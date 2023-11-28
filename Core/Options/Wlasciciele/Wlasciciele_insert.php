
<?php

$nazwisko = $_POST['nazwisko'];
$imie = $_POST['imie'];
$ulica = $_POST['ulica'];
$miasto = $_POST['miasto'];
$poczta = $_POST['poczta'];
$telefon = $_POST['telefon'];

$sql = "INSERT INTO wlasciciele() VALUES (NULL, '$nazwisko', '$imie', '$ulica', '$miasto', '$poczta', $telefon)";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie dodano rekord!", PRE3_INDEX_PHP);

?>
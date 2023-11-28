
<?php

$lek = $_POST['lek'];
$wizyta = $_POST['wizyta'];
$ilosc = $_POST['ilosc'];

$sql = "INSERT INTO wykorzystane_leki() VALUES (NULL, $lek, $wizyta, $ilosc)";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie dodano rekord!", PRE3_INDEX_PHP);

?>

<?php

$lek = $_POST['lek'];
$wizyta = $_POST['wizyta'];
$ilosc = $_POST['ilosc'];
$id = $_POST['id'];

$sql = "UPDATE wykorzystane_leki SET ID_Leku=$lek, ID_Wizyty=$wizyta, Ilosc=$ilosc WHERE wykorzystane_leki.ID_Operacji=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", PRE3_INDEX_PHP);

?>
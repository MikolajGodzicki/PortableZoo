
<?php

$nazwa = $_POST['nazwa'];
$cena = $_POST['cena'];

$sql = "INSERT INTO leki() VALUES (NULL, '$nazwa', $cena)";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie dodano rekord!", PRE3_INDEX_PHP);

?>

<?php

$kolor = $_POST['kolor'];

$sql = "INSERT INTO kolory() VALUES (NULL, '$kolor')";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie dodano rekord!", PRE3_INDEX_PHP);

?>
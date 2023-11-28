
<?php

$zabieg = $_POST['zabieg'];
$wizyta = $_POST['wizyta'];

$sql = "INSERT INTO wykonane_zabiegi() VALUES (NULL, $zabieg, $wizyta)";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie dodano rekord!", PRE3_INDEX_PHP);

?>
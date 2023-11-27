
<?php

$nazwa = $_POST['nazwa'];
$cena = $_POST['cena'];
$id = $_POST['id'];

$sql = "UPDATE zabiegi SET Nazwa='$nazwa', Cena=$cena WHERE zabiegi.ID_Uslugi=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", PRE3_INDEX_PHP);

?>
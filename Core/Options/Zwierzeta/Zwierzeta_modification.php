<?php

$rodzaj = $_POST['rodzaj'];
$imie = $_POST['imie'];
$data = $_POST['data'];
$kolor = $_POST['kolor'];
$wlasciciel = $_POST['wlasciciel'];
$id = $_POST['id'];

$sql = "UPDATE zwierzeta SET Rodzaj_zwierza='$rodzaj', Imie='$imie', Data_urodzin='$data', ID_Koloru=$kolor, ID_Wlasciciela=$wlasciciel WHERE zwierzeta.ID_Zwierza=$id;";

include_once "../../coredb.php";
include_once "../../../Defines/defines.php";

$db = CoreDatabase::get_instance();

$db->Query($sql);

ShowAlert("Pomyślnie zmieniono rekord!", PRE3_INDEX_PHP);

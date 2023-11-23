
<?php

$nazwa = $_POST['nazwa'];
$cena = $_POST['cena'];
$id = $_POST['id'];

$sql = "UPDATE zabiegi SET Nazwa='$nazwa', Cena=$cena WHERE zabiegi.ID_Uslugi=$id;";

include_once "../coredb.php";
include_once "../../Defines/defines.php";

$connection = DB_Connect_with_db();

mysqli_query($connection, $sql);

echo "<script>
            alert('Pomyślnie zmieniono rekord!');
            window.location.href='" . PRE_PRE_INDEX_PHP . "';
        </script>";

DB_Dispose($connection);

?>
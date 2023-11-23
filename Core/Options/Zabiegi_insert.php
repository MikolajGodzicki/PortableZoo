
<?php

$nazwa = $_POST['nazwa'];
$cena = $_POST['cena'];

$sql = "INSERT INTO zabiegi() VALUES (NULL, '$nazwa', $cena)";

include_once "../coredb.php";
include_once "../../Defines/defines.php";

$connection = DB_Connect_with_db();

mysqli_query($connection, $sql);

echo "<script>
            alert('Pomyślnie dodano rekord!');
            window.location.href='" . PRE_PRE_INDEX_PHP . "';
        </script>";

DB_Dispose($connection);

?>
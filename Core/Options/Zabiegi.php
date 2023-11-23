<?php
echo $_GET['Option'] . "<br/>";

function Show($type)
{
    switch ($type) {
        case "in":
            InsertForm();
            break;
        case "modification":
            ModificationList();
            break;
        case "out":
            OutList();
            break;
        default:
            break;
    }
}

function InsertForm()
{
?>
    <form method='POST' action='./Options/Zabiegi_insert.php'>
        Nazwa:
        <input type='text' name='nazwa' /><br />
        Cena:
        <input type='number' step='0.01' name='cena' /><br />
        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $connection = DB_Connect_with_db();

    $sql = "SELECT * FROM zabiegi;";

    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Uslugi'];
        echo $id . " " . $row['Nazwa'] . " " . $row['Cena'] . " <a href='modification.php?Option=Zabiegi&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM zabiegi WHERE ID_Uslugi=$id;";
        $result = mysqli_fetch_array(mysqli_query($connection, $sql));

    ?>
        <form method='POST' action='./Options/Zabiegi_modification.php'>
            Nazwa:
            <input type='text' name='nazwa' value='<?php echo $result['Nazwa']; ?>' /><br />
            Cena:
            <input type='number' step='0.01' name='cena' value='<?php echo $result['Cena']; ?>' /><br />
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type='submit' value='Zmień rekord' />
        </form>
<?php
    }

    DB_Dispose($connection);
}

function OutList()
{
}

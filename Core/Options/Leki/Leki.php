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
    <form method='POST' action='./Options/Leki/Leki_insert.php'>
        Nazwa:
        <input type='text' name='nazwa' required /><br />
        Cena:
        <input type='number' step='0.01' name='cena' required /><br />
        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    $sql = "SELECT * FROM Leki;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Leku'];
        echo $id . " " . $row['Nazwa'] . " " . $row['Cena'] . " <a href='modification.php?Option=Leki&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Leki WHERE ID_Leku=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Leki/Leki_modification.php'>
            Nazwa:
            <input type='text' name='nazwa' value='<?php echo $result['Nazwa']; ?>' required /><br />
            Cena:
            <input type='number' step='0.01' name='cena' value='<?php echo $result['Cena']; ?>' required /><br />
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type='submit' value='Zmień rekord' />
        </form>
<?php
    }
}

function OutList()
{
}

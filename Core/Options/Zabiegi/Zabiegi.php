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
    <form method='POST' action='./Options/Zabiegi/Zabiegi_insert.php'>
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

    $sql = "SELECT * FROM zabiegi;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Uslugi'];
        echo $id . " " . $row['Nazwa'] . " " . $row['Cena'] . " <a href='modification.php?Option=Zabiegi&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM zabiegi WHERE ID_Uslugi=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Zabiegi/Zabiegi_modification.php'>
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
    $db = CoreDatabase::get_instance();

    ?>
    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="Zabiegi" />
        <button type="submit" name="type" value="rosnaco">Rosnąco</button>

        <?php
        ShowSelect("column", $db);
        ?>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="Zabiegi" />
        <button type="submit" name="type" value="malejaco">Malejąco</button>

        <?php
        ShowSelect("column", $db);
        ?>
    </form>

<?php

    $sql = "SELECT * FROM zabiegi;";

    if (isset($_GET['type'])) {
        switch ($_GET['type']) {
            case "rosnaco":
                $column = $_GET['column'];
                $sql = "SELECT * FROM zabiegi ORDER BY $column ASC;";
                break;
            case "malejaco":
                $column = $_GET['column'];
                $sql = "SELECT * FROM zabiegi ORDER BY $column DESC;";
                break;
        }
    }

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Uslugi'];
        echo $id . " " . $row['Nazwa'] . " " . $row['Cena'] . "<br/>";
    }
}

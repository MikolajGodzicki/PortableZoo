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
    <form method='POST' action='./Options/Zwierzeta/Zwierzeta_insert.php'>
        Rodzaj zwierza:
        <input type='text' name='rodzaj' /><br />
        Imie:
        <input type='text' name='imie' /><br />
        Data urodzin:
        <input type='date' name='data' /><br />
        Kolor:
        <select name="kolor">
            <?php
            $db = CoreDatabase::get_instance();

            $sql = "SELECT * FROM kolory;";

            $result = $db->Query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Koloru'];
                echo "<option value='$id'>" . $row['ID_Koloru'] . ": "  . $row['Kolor'] . "</option>";
            }

            ?>
        </select><br />
        Właściciel:
        <select name="wlasciciel">
            <?php
            $db = CoreDatabase::get_instance();

            $sql = "SELECT * FROM wlasciciele;";

            $result = $db->Query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Wlasciciela'];
                echo "<option value='$id'>" . $row['ID_Wlasciciela'] . ": "   . $row['Imie'] . "</option>";
            }
            ?>
        </select><br />

        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    $sql = "SELECT * FROM Zwierzeta;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Uslugi'];
        echo $id . " " . $row['Nazwa'] . " " . $row['Cena'] . " <a href='modification.php?Option=Zwierzeta&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Zwierzeta WHERE ID_Uslugi=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Zwierzeta/Zwierzeta_modification.php'>
            Nazwa:
            <input type='text' name='nazwa' value='<?php echo $result['Nazwa']; ?>' /><br />
            Cena:
            <input type='number' step='0.01' name='cena' value='<?php echo $result['Cena']; ?>' /><br />
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type='submit' value='Zmień rekord' />
        </form>
<?php
    }
}

function OutList()
{
}

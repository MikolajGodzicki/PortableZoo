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
    <form method='POST' action='./Options/Wlasciciele/Wlasciciele_insert.php'>
        Nazwisko:
        <input type='text' name='nazwisko' required /><br />
        Imie:
        <input type='text' name='imie' required /><br />
        Ulica:
        <input type='text' name='ulica' required /><br />
        Miasto:
        <input type='text' name='miasto' required /><br />
        Poczta:
        <input type='text' name='poczta' required /><br />
        Numer Telefonu:
        <input type='text' name='telefon' required /><br />
        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    $sql = "SELECT * FROM Wlasciciele;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Wlasciciela'];
        echo $id . " " . $row['Imie'] . " " . $row['Nazwisko'] . " <a href='modification.php?Option=Wlasciciele&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Wlasciciele WHERE ID_Wlasciciela=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Wlasciciele/Wlasciciele_modification.php'>
            Nazwisko:
            <input type='text' name='nazwisko' value='<?php echo $result['Nazwisko']; ?>' required /><br />
            Imie:
            <input type='text' name='imie' value='<?php echo $result['Imie']; ?>' required /><br />
            Ulica:
            <input type='text' name='ulica' value='<?php echo $result['Ulica']; ?>' required /><br />
            Miasto:
            <input type='text' name='miasto' value='<?php echo $result['Miasto']; ?>' required /><br />
            Poczta:
            <input type='text' name='poczta' value='<?php echo $result['Poczta']; ?>' required /><br />
            Numer Telefonu:
            <input type='number' name='telefon' value='<?php echo $result['Telefon']; ?>' required /><br />
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type='submit' value='Zmień rekord' />
        </form>
<?php
    }
}

function OutList()
{
}

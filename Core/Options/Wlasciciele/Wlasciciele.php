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
        <input type='text' name='nazwisko' pattern="[A-Za-z]{1,}" required /><br />
        Imie:
        <input type='text' name='imie' pattern="[A-Za-z]{1,}" required /><br />
        Ulica:
        <input type='text' name='ulica' pattern="[A-Za-z]{1,}" required /><br />
        Miasto:
        <input type='text' name='miasto' pattern="[A-Za-z]{1,}" required /><br />
        Poczta:
        <input type='text' name='poczta' pattern="[0-9]{2}-[0-9]{3}" placeholder="00-000" required /><br />
        Numer Telefonu:
        <input type='text' name='telefon' pattern="[0-9]{9}" placeholder="123456789" required /><br />
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
            <input type='text' name='nazwisko' value='<?php echo $result['Nazwisko']; ?>' pattern="[A-Za-z]{1,}" required /><br />
            Imie:
            <input type='text' name='imie' value='<?php echo $result['Imie']; ?>' pattern="[A-Za-z]{1,}" required /><br />
            Ulica:
            <input type='text' name='ulica' value='<?php echo $result['Ulica']; ?>' pattern="[A-Za-z]{1,}" required /><br />
            Miasto:
            <input type='text' name='miasto' value='<?php echo $result['Miasto']; ?>' pattern="[A-Za-z]{1,}" required /><br />
            Poczta:
            <input type='text' name='poczta' value='<?php echo $result['Poczta']; ?>' pattern="[0-9]{2}-[0-9]{3}" required /><br />
            Numer Telefonu:
            <input type='text' name='telefon' value='<?php echo $result['Telefon']; ?>' pattern="[0-9]{9}" required /><br />
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
        <h3>Kolumny</h3>
        <?php
        $rows = $db->GetColumnNames("wlasciciele");
        $i = 0;
        foreach ($rows as $row) {
            $name = $row[0];
            echo "<label>$name</label>";
            if (isset($_GET["Kolumna$i"])) {
                echo "<input type='checkbox' name='Kolumna" . $i . "' value='$name' checked/><br/>";
            } else {
                echo "<input type='checkbox' name='Kolumna" . $i . "' value='$name'/><br/>";
            }
            $i++;
        }
        ?>

        <h3>Opcje</h3>
        <input type="hidden" name="Option" value="wlasciciele" />
        <label>Sortuj </label>
        <select name="order_sym" required>
            <?php
            $syms = array("ASC", "DESC");
            $names = array("rosnąco", "malejąco");
            ShowSelectWithArrays($syms, $names, 'order_sym');
            ?>
        </select>
        <label>według</label>
        <?php
        ShowSelect("column", $db, "wlasciciele");
        ?>
        <br />
        <button type="submit" name="type" value="sort">Sortuj</button>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="wlasciciele" />
        <button type="submit" name="type" value="reset">Resetuj</button>
    </form>


<?php

    $sql = "SELECT * FROM wlasciciele;";
    $array = array();

    if (!isset($_GET['type'])) {
        echo "<hr>";
        echo "Brak wyników<br/>";
        return;
    }

    if (isset($_GET['type'])) {
        switch ($_GET['type']) {
            case "sort":
                $column = $_GET['column'];
                $order_sym = $_GET['order_sym'];


                $rows = $db->GetColumnNames("wlasciciele");
                $i = 0;
                foreach ($rows as $row) {
                    $name = $row[0];
                    if (isset($_GET['Kolumna' . $i]) == "on") {
                        array_push($array, $_GET['Kolumna' . $i]);
                    }
                    $i++;
                }

                if (count($array) == 0) {
                    echo "<hr>";
                    echo "Brak wyników<br/>";
                    return;
                } else {
                    $sql = "SELECT " . join(", ", $array) . " FROM wlasciciele";
                }

                $sql = $sql . " ORDER BY $column $order_sym;";
                break;
            case "reset":
                header("location: ./out.php?Option=wlasciciele");
                return;
                break;
        }
    }

    echo "<hr>";

    $result = $db->Query($sql);
    if (mysqli_num_rows($result) == 0) {
        echo "Brak wyników<br/>";
        return;
    }

    echo "<table>";
    echo "<tr>";
    foreach ($array as $item) {
        echo "<td>$item</td>";
    }
    echo "</tr>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        for ($i = 0; $i < count($row); $i++) {
            echo "<td>" . $row[$i] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

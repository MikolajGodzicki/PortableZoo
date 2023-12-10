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
    <form method='POST' action='./Options/Wykorzystane_Leki/Wykorzystane_Leki_insert.php'>
        Lek:
        <select name="lek" required>
            <?php
            $db = CoreDatabase::get_instance();

            $sql = "SELECT * FROM leki;";

            $result = $db->Query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Leku'];
                echo "<option value='$id'>" . $row['Nazwa'] . "</option>";
            }

            ?>
        </select><br />
        Wizyta:
        <select name="wizyta" required>
            <?php
            $db = CoreDatabase::get_instance();

            $sql = "SELECT * FROM wizyty;";

            $result = $db->Query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Wizyty'];
                echo "<option value='$id'>" . $id . ": "  . $row['Kiedy'] . "</option>";
            }

            ?>
        </select><br />
        Ilość:
        <input type='number' name='ilosc' required /><br />


        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    //$sql = "SELECT * FROM Wykorzystane_Leki;";
    $sql = "SELECT wykorzystane_leki.ID_Operacji, wykorzystane_leki.Ilosc, leki.Nazwa, wizyty.ID_Wizyty ,wizyty.Kiedy FROM Wykorzystane_Leki INNER JOIN leki ON leki.ID_Leku = wykorzystane_leki.ID_Leku INNER JOIN wizyty ON wizyty.ID_Wizyty = wykorzystane_leki.ID_Wizyty";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Operacji'];
        echo $id . ": " . $row['Nazwa']  . " x" . $row['Ilosc'] . ", " . $row['Kiedy'] . " <a href='modification.php?Option=Wykorzystane_Leki&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Wykorzystane_Leki WHERE ID_Operacji=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Wykorzystane_Leki/Wykorzystane_Leki_modification.php'>
            Lek:
            <select name="lek" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql = "SELECT * FROM leki;";

                $result_ = $db->Query($sql);
                while ($row = mysqli_fetch_array($result_)) {
                    $id_ = $row['ID_Leku'];
                    if ($id_ == $result['ID_Leku']) {
                        echo "<option value='$id_' selected>" . $row['Nazwa'] . "</option>";
                    } else {
                        echo "<option value='$id_'>" . $row['Nazwa'] . "</option>";
                    }
                }

                ?>
            </select><br />
            Wizyta:
            <select name="wizyta" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql = "SELECT * FROM wizyty;";

                $result_ = $db->Query($sql);
                while ($row = mysqli_fetch_array($result_)) {
                    $id_ = $row['ID_Wizyty'];
                    if ($id_ == $result['ID_Wizyty']) {
                        echo "<option value='$id_' selected>" . $id_ . ": "  . $row['Kiedy'] . "</option>";
                    } else {
                        echo "<option value='$id_'>" . $id_ . ": "  . $row['Kiedy'] . "</option>";
                    }
                }

                ?>
            </select><br />
            Ilość:
            <input type='number' name='ilosc' value='<?php echo $result['Ilosc']; ?>' required /><br />
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
        $rows = $db->GetColumnNames("wykorzystane_leki");
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
        <input type="hidden" name="Option" value="wykorzystane_leki" />
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
        ShowSelect("column", $db, "wykorzystane_leki");
        ?><br />
        <label>Ilość:</label>
        <select id="range_sym" name="range_sym" onchange="GetOption('ilosc')" required>
            <option value='none'>brak</option>
            <?php
            $syms = array("=", ">", ">=", "<", "<=");
            $names = array("równa", "większa od", "większa lub równa", "mniejsza od", "mniejsza lub równa");
            ShowSelectWithArrays($syms, $names, 'range_sym');
            ?>
        </select>
        <input type="number" id="ilosc" name="ilosc" value="<?php echo (isset($_GET['ilosc'])) ? $_GET['ilosc'] : ' '; ?>" required />

        <script>
            function GetOption(input) {
                let opt = document.getElementById("range_sym").value;

                if (opt == "none") {
                    document.getElementById(input).type = "hidden";
                } else {
                    document.getElementById(input).type = "number";
                }
            }

            GetOption("ilosc");
        </script>


        <br />
        <button type="submit" name="type" value="sort">Sortuj</button>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="wykorzystane_leki" />
        <button type="submit" name="type" value="reset">Resetuj</button>
    </form>


<?php
    $sql = "SELECT * FROM wykorzystane_leki;";
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
                $range_sym = $_GET['range_sym'];


                $rows = $db->GetColumnNames("wykorzystane_leki");
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
                    $sql = "SELECT " . join(", ", $array) . " FROM wykorzystane_leki";
                }

                $ilosc = $_GET['ilosc'];

                if ($range_sym != "none") {
                    $sql = $sql . " WHERE Ilosc $range_sym '$ilosc'";
                }


                $sql = $sql . " ORDER BY $column $order_sym;";
                break;
            case "reset":
                header("location: ./out.php?Option=wykorzystane_leki");
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

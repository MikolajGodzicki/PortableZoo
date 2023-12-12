<?php

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
        <input type='text' name='rodzaj' pattern="[A-Za-z]{1,}" required /><br />
        Imie:
        <input type='text' name='imie' pattern="[A-Za-z]{1,}" required /><br />
        Data urodzin:
        <input type='date' name='data' required /><br />
        Kolor:
        <select name="kolor" required>
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
        <select name="wlasciciel" required>
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

?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Imie</th>
                <th scope="col">Data urodzin</th>
                <th scope="col">Działanie</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Zwierza'];
                $imie = $row['Imie'];
                $data = $row['Data_urodzin'];
                $link = "<a href='modification.php?Option=Zwierzeta&id=$id'>Edytuj</a>";
                echo "
                    <tr>
                        <th scope='row'>$id</th>
                        <td>$imie</td>
                        <td>$data</td>
                        <td>$link</td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>
    <?php

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Zwierzeta WHERE ID_Zwierza=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Zwierzeta/Zwierzeta_modification.php'>
            Rodzaj zwierza:
            <input type='text' name='rodzaj' pattern="[A-Za-z]{1,}" value='<?php echo $result['Rodzaj_zwierza']; ?>' required /><br />
            Imie:
            <input type='text' name='imie' pattern="[A-Za-z]{1,}" value='<?php echo $result['Imie']; ?>' required /><br />
            Data urodzin:
            <input type='date' name='data' value='<?php echo $result['Data_urodzin']; ?>' required /><br />
            Kolor:
            <select name="kolor" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql_ = "SELECT * FROM kolory;";

                $result_ = $db->Query($sql_);
                while ($row = mysqli_fetch_array($result_)) {
                    $id_ = $row['ID_Koloru'];
                    if ($id_ == $result['ID_Koloru']) {
                        echo "<option value='$id_' selected>" . $row['ID_Koloru'] . ": "  . $row['Kolor'] . "</option>";
                    } else {
                        echo "<option value='$id_'>" . $row['ID_Koloru'] . ": "  . $row['Kolor'] . "</option>";
                    }
                }

                ?>
            </select><br />
            Właściciel:
            <select name="wlasciciel" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql_ = "SELECT * FROM wlasciciele;";

                $result_ = $db->Query($sql_);
                while ($row = mysqli_fetch_array($result_)) {
                    $id_ = $row['ID_Wlasciciela'];
                    if ($id_ == $result['ID_Wlasciciela']) {
                        echo "<option value='$id_' selected>" . $row['ID_Wlasciciela'] . ": "   . $row['Imie'] . "</option>";
                    } else {
                        echo "<option value='$id_'>" . $row['ID_Wlasciciela'] . ": "   . $row['Imie'] . "</option>";
                    }
                }
                ?>
            </select><br />
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type='submit' class="btn btn-secondary" value='Zmień rekord' />
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
        $rows = $db->GetColumnNames("zwierzeta");
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
        <input type="hidden" name="Option" value="zwierzeta" />
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
        ShowSelect("column", $db, "zwierzeta");
        ?><br />
        <label>Data urodzin:</label>
        <select id="range_sym" name="range_sym" onchange="GetOption('kiedy')" required>
            <option value='none'>brak</option>
            <?php
            $syms = array("=", ">", "<");
            $names = array("w dniu", "później niż", "wcześniej niż");
            ShowSelectWithArrays($syms, $names, 'range_sym');
            ?>
        </select>
        <input type="date" id="kiedy" name="kiedy" value="<?php echo (isset($_GET['kiedy'])) ? $_GET['kiedy'] : ''; ?>" required />

        <script>
            function GetOption(input) {
                let opt = document.getElementById("range_sym").value;

                if (opt == "none") {
                    document.getElementById(input).type = "hidden";
                } else {
                    document.getElementById(input).type = "date";
                }
            }

            GetOption("kiedy");
        </script>

        <br />
        <button type="submit" name="type" value="sort">Sortuj</button>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="zwierzeta" />
        <button type="submit" name="type" value="reset">Resetuj</button>
    </form>


<?php
    $sql = "SELECT * FROM zwierzeta;";
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


                $rows = $db->GetColumnNames("zwierzeta");
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
                    $sql = "SELECT " . join(", ", $array) . " FROM zwierzeta";
                }

                $kiedy = $_GET['kiedy'];

                if ($range_sym != "none") {
                    $sql = $sql . " WHERE Data_urodzin $range_sym '$kiedy'";
                }

                $sql = $sql . " ORDER BY $column $order_sym;";
                break;
            case "reset":
                header("location: ./out.php?Option=zwierzeta");
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

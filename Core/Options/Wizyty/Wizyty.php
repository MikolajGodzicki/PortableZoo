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
    <form class="Form" method='POST' action='./Options/Wizyty/Wizyty_insert.php'>
        <div class="mb-3">
            <label for="zwierza" class="form-label">ID Zwierzaka:</label>
            <select class="form-select" name="zwierzak" id="zwierzak" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql = "SELECT ID_Zwierza, Imie FROM zwierzeta;";

                $result = $db->Query($sql);
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['ID_Zwierza'];
                    echo "<option value='$id'>" . $row['ID_Zwierza'] . ": " . $row['Imie'] . "</option>";
                }

                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="kiedy" class="form-label">Kiedy:</label>
            <input type='date' class="form-control" id="kiedy" name='kiedy' required />
        </div>

        <input type='submit' class="btn btn-primary" value='Dodaj rekord' />
    </form>
<?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    //$sql = "SELECT * FROM Wizyty;";
    $sql = "SELECT wizyty.ID_Wizyty, wizyty.Kiedy, zwierzeta.Imie, zwierzeta.ID_Zwierza FROM wizyty INNER JOIN zwierzeta ON zwierzeta.ID_Zwierza = wizyty.ID_Zwierzaka;";

    $result = $db->Query($sql);


?>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Zwierzęcie</th>
                <th scope="col">Data wizyty</th>
                <th scope="col">Działanie</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Wizyty'];
                $id_zwierza = $row['ID_Zwierza'];
                $imie = $row['Imie'];
                $kiedy = $row['Kiedy'];
                $link = "<a href='modification.php?Option=Wizyty&id=$id'><button type='button' class='btn btn-success'>Edytuj</button></a>";
                echo "
                <tr>
                    <th scope='row'>$id</th>
                    <td>$id_zwierza - $imie</td>
                    <td>$kiedy</td>
                    <td>$link</td>
                </tr>
            ";
            }
            ?>
        </tbody>
    </table>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Wizyty'];
        echo $id . ": " . $row['ID_Zwierza'] . " " . $row['Imie'] . ", " . $row['Kiedy'] . " <a href='modification.php?Option=Wizyty&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Wizyty WHERE ID_Wizyty=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form class="Form" method='POST' action='./Options/Wizyty/Wizyty_modification.php'>
            <div class="mb-3">
                <label for="zwierza" class="form-label">ID Zwierzaka:</label>
                <select class="form-select" name="zwierzak" id="zwierzak" required>
                    <?php
                    $db = CoreDatabase::get_instance();

                    $sql_ = "SELECT ID_Zwierza, Imie FROM zwierzeta;";

                    $result_ = $db->Query($sql_);
                    while ($row = mysqli_fetch_array($result_)) {
                        $id_ = $row['ID_Zwierza'];
                        if ($id_ == $result['ID_Zwierzaka']) {
                            echo "<option value='$id_' selected>" . $row['ID_Zwierza'] . ": " . $row['Imie'] . "</option>";
                        } else {
                            echo "<option value='$id_'>" . $row['ID_Zwierza'] . ": " . $row['Imie'] . "</option>";
                        }
                    }

                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="kiedy" class="form-label">Kiedy:</label>
                <input type='date' class="form-control" id="kiedy" name='kiedy' value='<?php echo $result['Kiedy']; ?>' required />
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" required />
            <input type='submit' class="btn btn-primary" value='Zmień rekord' />
        </form>
    <?php
    }
}

function OutList()
{
    $db = CoreDatabase::get_instance();

    ?>
    <form class="Form" method="GET" action="out.php">
        <h3>Kolumny</h3>
        <div class="mb-3">
            <?php
            $rows = $db->GetColumnNames("wizyty");
            $i = 0;
            foreach ($rows as $row) {
                $name = $row[0];
                echo "<div class='form-check'><label for='Kolumna$i' class='form-check-label'>$name</label>";
                if (isset($_GET["Show"]) == "all") {
                    echo "<input type='checkbox' class='form-check-input' id='Kolumna" . $i . "' name='Kolumna" . $i . "' value='$name' checked/><br/>";
                } else if (isset($_GET["Kolumna$i"])) {
                    echo "<input type='checkbox' class='form-check-input' id='Kolumna" . $i . "' name='Kolumna" . $i . "' value='$name' checked/><br/>";
                } else {
                    echo "<input type='checkbox' class='form-check-input' id='Kolumna" . $i . "' name='Kolumna" . $i . "' value='$name'/><br/>";
                }
                echo "</div>";
                $i++;
            }
            ?>
        </div>

        <h3>Opcje</h3>
        <div class="mb-3">
            <input type="hidden" name="Option" value="Wizyty" />
            <label for="order_sym" class="form-label">Sortuj</label>
            <select class="form-select" id="order_sym" name="order_sym" required>
                <?php
                $syms = array("ASC", "DESC");
                $names = array("rosnąco", "malejąco");
                ShowSelectWithArrays($syms, $names, 'order_sym');
                ?>
            </select>
            <label>według</label>
            <?php
            ShowSelect("column", $db, "wizyty");
            ?>
        </div>
        <div class="mb-3">
            <label>Data:</label>
            <select class="form-select" id="range_sym" name="range_sym" onchange="GetOption('kiedy')" required>
                <option value='none'>brak</option>
                <?php
                $syms = array("=", ">", "<");
                $names = array("w dniu", "później niż", "wcześniej niż");
                ShowSelectWithArrays($syms, $names, 'range_sym');
                ?>
            </select>
            <input type="date" class="form-control" id="kiedy" name="kiedy" value="<?php echo (isset($_GET['kiedy'])) ? $_GET['kiedy'] : ''; ?>" required />
        </div>

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

        <button type="submit" class="btn btn-success" name="type" value="sort">Sortuj</button>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="Wizyty" />
        <button type="submit" class="Button btn btn-danger" name="type" value="reset">Resetuj</button>
    </form>


<?php
    $sql = "SELECT * FROM wizyty;";
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


                $rows = $db->GetColumnNames("wizyty");
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
                    $sql = "SELECT " . join(", ", $array) . " FROM wizyty";
                }

                $kiedy = $_GET['kiedy'];

                if ($range_sym != "none") {
                    $sql = $sql . " WHERE kiedy $range_sym '$kiedy'";
                }

                $sql = $sql . " ORDER BY $column $order_sym;";
                break;
            case "reset":
                echo "<hr>";
                echo "Brak wyników<br/>";
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

    echo "<table class='table table-striped'>
    <thead class='table-dark'>";
    echo "<tr>";
    foreach ($array as $item) {
        echo "<td>$item</td>";
    }
    echo "</tr>
    </thead>
    <tbody>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        for ($i = 0; $i < count($row); $i++) {
            echo "<td>" . $row[$i] . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>
    </table>";
}

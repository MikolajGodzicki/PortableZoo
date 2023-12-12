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
    <form class="Form" method='POST' action='./Options/Zwierzeta/Zwierzeta_insert.php'>
        <div class="mb-3">
            <label for="rodzaj" class="form-label">Rodzaj zwierza:</label>
            <input type='text' class="form-control" id="rodzaj" name='rodzaj' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" required />
        </div>
        <div class="mb-3">
            <label for="imie" class="form-label">Imie:</label>
            <input type='text' class="form-control" id="imie" name='imie' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" required />
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data urodzin:</label>
            <input type='date' class="form-control" id="data" name='data' required />
        </div>
        <div class="mb-3">
            <label for="kolor" class="form-label">Kolor:</label>

            <select class="form-select" id="kolor" name="kolor" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql = "SELECT * FROM kolory;";

                $result = $db->Query($sql);
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['ID_Koloru'];
                    echo "<option value='$id'>" . $row['ID_Koloru'] . ": "  . $row['Kolor'] . "</option>";
                }

                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="wlasciciel" class="form-label">Właściciel:</label>

            <select class="form-select" id="wlasciciel" name="wlasciciel" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql = "SELECT * FROM wlasciciele;";

                $result = $db->Query($sql);
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['ID_Wlasciciela'];
                    echo "<option value='$id'>" . $row['ID_Wlasciciela'] . ": "   . $row['Imie'] . "</option>";
                }
                ?>
            </select>
        </div>

        <input class="btn btn-primary" type='submit' value='Dodaj rekord' />
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
        <thead class="table-dark">
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
                $link = "<a href='modification.php?Option=Zwierzeta&id=$id'><button type='button' class='btn btn-success'>Edytuj</button></a>";
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
        <form class="Form" method='POST' action='./Options/Zwierzeta/Zwierzeta_modification.php'>
            <div class="mb-3">
                <label for="rodzaj" class="form-label">Rodzaj zwierza:</label>
                <input type='text' class="form-control" id="rodzaj" name='rodzaj' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" value='<?php echo $result['Rodzaj_zwierza']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="imie" class="form-label">Imie:</label>
                <input type='text' class="form-control" id="imie" name='imie' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" value='<?php echo $result['Imie']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data urodzin:</label>
                <input type='date' class="form-control" id="data" name='data' value='<?php echo $result['Data_urodzin']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="kolor" class="form-label">Kolor:</label>

                <select class="form-select" id="kolor" name="kolor" required>
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
                </select>
            </div>
            <div class="mb-3">
                <label for="wlasciciel" class="form-label">Właściciel:</label>

                <select class="form-select" id="wlasciciel" name="wlasciciel" required>
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
                </select>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
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
            $rows = $db->GetColumnNames("zwierzeta");
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
            <input type="hidden" name="Option" value="Zwierzeta" />
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
            ShowSelect("column", $db, "zwierzeta");
            ?>
        </div>
        <div class="mb-3">
            <label>Data urodzin:</label>
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
        <input type="hidden" name="Option" value="Zwierzeta" />
        <button type="submit" class="Button btn btn-danger" name="type" value="reset">Resetuj</button>
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

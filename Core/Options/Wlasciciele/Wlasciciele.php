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
    <form class="Form" method='POST' action='./Options/Wlasciciele/Wlasciciele_insert.php'>
        <div class="mb-3">
            <label for="nazwisko" class="form-label">Nazwisko:</label>
            <input type='text' class="form-control" id="nazwisko" name='nazwisko' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" required />
        </div>
        <div class="mb-3">
            <label for="imie" class="form-label">Imie:</label>
            <input type='text' class="form-control" id="imie" name='imie' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" required />
        </div>
        <div class="mb-3">
            <label for="ulica" class="form-label">Ulica:</label>
            <input type='text' class="form-control" id="ulica" name='ulica' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" required />
        </div>
        <div class="mb-3">
            <label for="miasto" class="form-label">Miasto:</label>
            <input type='text' class="form-control" id="miasto" name='miasto' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" required />
        </div>
        <div class="mb-3">
            <label for="poczta" class="form-label">Poczta:</label>
            <input type='text' class="form-control" id="poczta" name='poczta' pattern="[0-9]{2}-[0-9]{3}" placeholder="00-000" required />
        </div>
        <div class="mb-3">
            <label for="telefon" class="form-label">Numer Telefonu:</label>
            <input type='text' class="form-control" id="telefon" name='telefon' pattern="[0-9]{9}" placeholder="123456789" required />
        </div>
        <input class="btn btn-primary" type='submit' value='Dodaj rekord' />
    </form>
<?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    $sql = "SELECT * FROM Wlasciciele;";

    $result = $db->Query($sql);

?>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nazwisko</th>
                <th scope="col">Imię</th>
                <th scope="col">Działanie</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Wlasciciela'];
                $imie = $row['Imie'];
                $nazwisko = $row['Nazwisko'];
                $link = "<a href='modification.php?Option=Wlasciciele&id=$id'><button type='button' class='btn btn-success'>Edytuj</button></a>";
                echo "
            <tr>
                <th scope='row'>$id</th>
                <td>$imie</td>
                <td>$nazwisko</td>
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
        $sql = "SELECT * FROM Wlasciciele WHERE ID_Wlasciciela=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Wlasciciele/Wlasciciele_modification.php'>
            <div class="mb-3">
                <label for="nazwisko" class="form-label">Nazwisko:</label>
                <input type='text' class="form-control" id="nazwisko" name='nazwisko' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" value='<?php echo $result['Nazwisko']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="imie" class="form-label">Imie:</label>
                <input type='text' class="form-control" id="imie" name='imie' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" value='<?php echo $result['Imie']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="ulica" class="form-label">Ulica:</label>
                <input type='text' class="form-control" id="ulica" name='ulica' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" value='<?php echo $result['Ulica']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="miasto" class="form-label">Miasto:</label>
                <input type='text' class="form-control" id="miasto" name='miasto' pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,}" value='<?php echo $result['Miasto']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="poczta" class="form-label">Poczta:</label>
                <input type='text' class="form-control" id="poczta" name='poczta' pattern="[0-9]{2}-[0-9]{3}" placeholder="00-000" value='<?php echo $result['Poczta']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="telefon" class="form-label">Numer Telefonu:</label>
                <input type='text' class="form-control" id="telefon" name='telefon' pattern="[0-9]{9}" placeholder="123456789" value='<?php echo $result['Telefon']; ?>' required />
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
            $rows = $db->GetColumnNames("wlasciciele");
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
            <input type="hidden" name="Option" value="wlasciciele" />
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
            ShowSelect("column", $db, "wlasciciele");
            ?>
        </div>
        <button type="submit" class="btn btn-success" name="type" value="sort">Sortuj</button>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="wlasciciele" />
        <button type="submit" class="Button btn btn-danger" name="type" value="reset">Resetuj</button>
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

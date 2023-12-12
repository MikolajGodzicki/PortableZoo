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
    <form class="Form" method='POST' action='./Options/Leki/Leki_insert.php'>
        <div class="mb-3">
            <label for="nazwa" class="form-label">Nazwa:</label>
            <input type='text' class="form-control" id="nazwa" name='nazwa' required />
        </div>
        <div class="mb-3">
            <label for="cena" class="form-label">Cena:</label>
            <input type='number' class="form-control" id="cena" step='0.01' name='cena' required />
        </div>
        <input type='submit' class="btn btn-primary" value='Dodaj rekord' />
    </form>
<?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    $sql = "SELECT * FROM Leki;";

    $result = $db->Query($sql);
?>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Cena</th>
                <th scope="col">Działanie</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Leku'];
                $nazwa = $row['Nazwa'];
                $cena = $row['Cena'];
                $link = "<a href='modification.php?Option=Leki&id=$id'><button type='button' class='btn btn-success'>Edytuj</button></a>";
                echo "
            <tr>
                <th scope='row'>$id</th>
                <td>$nazwa</td>
                <td>$cena</td>
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
        $sql = "SELECT * FROM Leki WHERE ID_Leku=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form class="Form" method='POST' action='./Options/Leki/Leki_modification.php'>
            <div class="mb-3">
                <label for="nazwa" class="form-label">Nazwa:</label>
                <input type='text' class="form-control" id="nazwa" name='nazwa' value='<?php echo $result['Nazwa']; ?>' required />
            </div>
            <div class="mb-3">
                <label for="cena" class="form-label">Cena:</label>
                <input type='number' class="form-control" id="cena" step='0.01' name='cena' value='<?php echo $result['Cena']; ?>' required />
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
    <form method="GET" action="out.php">
        <h3>Kolumny</h3>
        <?php
        $rows = $db->GetColumnNames("leki");
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
        <input type="hidden" name="Option" value="leki" />
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
        ShowSelect("column", $db, "leki");
        ?><br />
        <label>Cena:</label>
        <select id="range_sym" name="range_sym" onchange="GetOption('cena')" required>
            <option value='none'>brak</option>
            <?php
            $syms = array("=", ">", ">=", "<", "<=");
            $names = array("równa", "większa od", "większa lub równa", "mniejsza od", "mniejsza lub równa");
            ShowSelectWithArrays($syms, $names, 'range_sym');
            ?>
        </select>
        <input type="number" step="0.01" id="cena" name="cena" value="<?php echo (isset($_GET['cena'])) ? $_GET['cena'] : ' '; ?>" required />

        <script>
            function GetOption(input) {
                let opt = document.getElementById("range_sym").value;

                if (opt == "none") {
                    document.getElementById(input).type = "hidden";
                } else {
                    document.getElementById(input).type = "number";
                }
            }

            GetOption("cena");
        </script>

        <br />
        <button type="submit" name="type" value="sort">Sortuj</button>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="leki" />
        <button type="submit" name="type" value="reset">Resetuj</button>
    </form>


<?php

    $sql = "SELECT * FROM leki;";
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


                $rows = $db->GetColumnNames("leki");
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
                    $sql = "SELECT " . join(", ", $array) . " FROM leki";
                }

                $cena = $_GET['cena'];

                if ($range_sym != "none") {
                    $sql = $sql . " WHERE Cena $range_sym $cena";
                }

                $sql = $sql . " ORDER BY $column $order_sym;";
                break;
            case "reset":
                header("location: ./out.php?Option=leki");
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

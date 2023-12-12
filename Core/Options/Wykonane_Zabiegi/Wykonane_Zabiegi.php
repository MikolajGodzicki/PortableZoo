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
    <form class="Form" method='POST' action='./Options/Wykonane_Zabiegi/Wykonane_Zabiegi_insert.php'>
        <div class="mb-3">
            <label for="zabieg" class="form-label">Zabieg:</label>
            <select class="form-select" id="zabieg" name="zabieg" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql = "SELECT * FROM zabiegi;";

                $result = $db->Query($sql);
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['ID_Uslugi'];
                    echo "<option value='$id'>" . $row['Nazwa'] . "</option>";
                }

                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="wizyta" class="form-label">Wizyta:</label>
            <select class="form-select" id="wizyta" name="wizyta" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql = "SELECT * FROM wizyty;";

                $result = $db->Query($sql);
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['ID_Wizyty'];
                    echo "<option value='$id'>" . $id . ": "  . $row['Kiedy'] . "</option>";
                }

                ?>
            </select>
        </div>

        <input type='submit' class="btn btn-primary" value='Dodaj rekord' />
    </form>
<?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    //$sql = "SELECT * FROM Wykonane_Zabiegi;";
    $sql = "SELECT wykonane_zabiegi.ID_Operacji, zabiegi.Nazwa, wizyty.Kiedy FROM wykonane_zabiegi INNER JOIN zabiegi ON wykonane_zabiegi.ID_Zabiegu = zabiegi.ID_Uslugi INNER JOIN wizyty ON wizyty.ID_Wizyty = wykonane_zabiegi.ID_Wizyty;";

    $result = $db->Query($sql);

?>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Zabieg</th>
                <th scope="col">Kiedy</th>
                <th scope="col">Działanie</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Operacji'];
                $nazwa = $row['Nazwa'];
                $kiedy = $row['Kiedy'];
                $link = "<a href='modification.php?Option=Wykonane_Zabiegi&id=$id'><button type='button' class='btn btn-success'>Edytuj</button></a>";
                echo "
                    <tr>
                        <th scope='row'>$id</th>
                        <td>$nazwa</td>
                        <td>$kiedy</td>
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
        $sql = "SELECT * FROM Wykonane_Zabiegi WHERE ID_Operacji=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form class="Form" method='POST' action='./Options/Wykonane_Zabiegi/Wykonane_Zabiegi_modification.php'>
            <div class="mb-3">
                <label for="zabieg" class="form-label">Zabieg:</label>
                <select class="form-select" id="zabieg" name="zabieg" required>
                    <?php
                    $db = CoreDatabase::get_instance();

                    $sql = "SELECT * FROM zabiegi;";

                    $result_ = $db->Query($sql);
                    while ($row = mysqli_fetch_array($result_)) {
                        $id_ = $row['ID_Uslugi'];
                        if ($id_ == $result['ID_Zabiegu']) {
                            echo "<option value='$id_' selected>" . $row['Nazwa'] . "</option>";
                        } else {
                            echo "<option value='$id_'>" . $row['Nazwa'] . "</option>";
                        }
                    }

                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="wizyta" class="form-label">Wizyta:</label>
                <select class="form-select" id="wizyta" name="wizyta" required>
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
    <form method="GET" action="out.php">
        <h3>Kolumny</h3>
        <?php
        $rows = $db->GetColumnNames("wykonane_zabiegi");
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
        <input type="hidden" name="Option" value="wykonane_zabiegi" />
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
        ShowSelect("column", $db, "wykonane_zabiegi");
        ?><br />

        <button type="submit" name="type" value="sort">Sortuj</button>
    </form>

    <form method="GET" action="out.php">
        <input type="hidden" name="Option" value="wykonane_zabiegi" />
        <button type="submit" name="type" value="reset">Resetuj</button>
    </form>


<?php

    $sql = "SELECT * FROM wykonane_zabiegi;";
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

                $rows = $db->GetColumnNames("wykonane_zabiegi");
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
                    $sql = "SELECT " . join(", ", $array) . " FROM wykonane_zabiegi";
                }

                $sql = $sql . " ORDER BY $column $order_sym;";
                break;
            case "reset":
                header("location: ./out.php?Option=wykonane_zabiegi");
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

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
    <form method='POST' action='./Options/Zabiegi/Zabiegi_insert.php'>
        Nazwa:
        <input type='text' name='nazwa' required /><br />
        Cena:
        <input type='number' step='0.01' name='cena' required /><br />
        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    $sql = "SELECT * FROM zabiegi;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Uslugi'];
        echo $id . " " . $row['Nazwa'] . " " . $row['Cena'] . " <a href='modification.php?Option=Zabiegi&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM zabiegi WHERE ID_Uslugi=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Zabiegi/Zabiegi_modification.php'>
            Nazwa:
            <input type='text' name='nazwa' value='<?php echo $result['Nazwa']; ?>' required /><br />
            Cena:
            <input type='number' step='0.01' name='cena' value='<?php echo $result['Cena']; ?>' required /><br />
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
        <input type="hidden" name="Option" value="Zabiegi" />
        <label>Sortuj </label>
        <select name="order_sym" required>
            <option value='ASC'>rosnąco</option>
            <option value='DESC'>malejąco</option>
        </select>
        <label>według</label>
        <?php
        ShowSelect("column", $db, "zabiegi");
        ?>
        <label>Cena:</label>
        <select id="range_sym" name="range_sym" onchange="GetOption('cena')" required>
            <option value='none'>brak</option>
            <option value='>'>większa od</option>
            <option value='>='>większa lub równa </option>
            <option value='<'>mniejsza od</option>
            <option value='<='>mniejsza lub równa</option>
        </select>
        <input type="number" step="0.01" id="cena" name="cena" required />
        <label>Grupuj według</label>
        <select id="grouping_sym" name="grouping_sym" required>
            <option value='none'>brak</option>
            <!-- Dodać opcje grupowania według kolumn -->
        </select>
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
        <input type="hidden" name="Option" value="Zabiegi" />
        <button type="submit" name="type" value="reset">Resetuj</button>
    </form>


<?php

    $sql = "SELECT * FROM zabiegi;";

    if (isset($_GET['type'])) {
        switch ($_GET['type']) {
            case "sort":
                $column = $_GET['column'];
                $order_sym = $_GET['order_sym'];
                $range_sym = $_GET['range_sym'];
                $cena = $_GET['cena'];
                if ($range_sym == "none") {
                    $sql = "SELECT * FROM zabiegi ORDER BY $column $order_sym;";
                } else {
                    $sql = "SELECT * FROM zabiegi WHERE Cena $range_sym $cena ORDER BY $column $order_sym;";
                }
                break;
            case "reset":
                $sql = "SELECT * FROM zabiegi;";
                break;
        }
    }

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Uslugi'];
        echo $id . " " . $row['Nazwa'] . " " . $row['Cena'] . "<br/>";
    }
}

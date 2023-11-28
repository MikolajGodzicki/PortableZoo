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

    $sql = "SELECT * FROM Wykorzystane_Leki;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Operacji'];
        echo $id . " " . $row['ID_Leku'] . " " . $row['ID_Wizyty'] . " " . $row['Ilosc'] . " <a href='modification.php?Option=Wykorzystane_Leki&id=$id'>Edytuj</a><br/>";
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
}

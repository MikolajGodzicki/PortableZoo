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
    <form method='POST' action='./Options/Wykonane_Zabiegi/Wykonane_Zabiegi_insert.php'>
        Lek:
        <select name="zabieg" required>
            <?php
            $db = CoreDatabase::get_instance();

            $sql = "SELECT * FROM zabiegi;";

            $result = $db->Query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Uslugi'];
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

        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    //$sql = "SELECT * FROM Wykonane_Zabiegi;";
    $sql = "SELECT wykonane_zabiegi.ID_Operacji, zabiegi.Nazwa, wizyty.Kiedy FROM wykonane_zabiegi INNER JOIN zabiegi ON wykonane_zabiegi.ID_Zabiegu = zabiegi.ID_Uslugi INNER JOIN wizyty ON wizyty.ID_Wizyty = wykonane_zabiegi.ID_Wizyty;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Operacji'];
        echo $id . ": " . $row['Nazwa'] . ", " . $row['Kiedy'] . " <a href='modification.php?Option=Wykonane_Zabiegi&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Wykonane_Zabiegi WHERE ID_Operacji=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Wykonane_Zabiegi/Wykonane_Zabiegi_modification.php'>
            Zabieg:
            <select name="zabieg" required>
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
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type='submit' value='Zmień rekord' />
        </form>
<?php
    }
}

function OutList()
{
}

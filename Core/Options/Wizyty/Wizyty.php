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
    <form method='POST' action='./Options/Wizyty/Wizyty_insert.php'>
        ID Zwierzaka:
        <select name="zwierzak" required>
            <?php
            $db = CoreDatabase::get_instance();

            $sql = "SELECT ID_Zwierza, Imie FROM zwierzeta;";

            $result = $db->Query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['ID_Zwierza'];
                echo "<option value='$id'>" . $row['ID_Zwierza'] . ": " . $row['Imie'] . "</option>";
            }

            ?>
        </select><br />
        Kiedy:
        <input type='date' name='kiedy' required /><br />

        <input type='submit' value='Dodaj rekord' />
    </form>
    <?php
}

function ModificationList()
{
    $db = CoreDatabase::get_instance();

    //$sql = "SELECT * FROM Wizyty;";
    $sql = "SELECT wizyty.ID_Wizyty, wizyty.Kiedy, zwierzeta.Imie, zwierzeta.ID_Zwierza FROM wizyty INNER JOIN zwierzeta ON zwierzeta.ID_Zwierza = wizyty.ID_Zwierzaka;";

    $result = $db->Query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Wizyty'];
        echo $id . ": " . $row['ID_Zwierza'] . " " . $row['Imie'] . ", " . $row['Kiedy'] . " <a href='modification.php?Option=Wizyty&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Wizyty WHERE ID_Wizyty=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Wizyty/Wizyty_modification.php'>
            ID Zwierzaka:
            <select name="zwierzak" required>
                <?php
                $db = CoreDatabase::get_instance();

                $sql_ = "SELECT ID_Zwierza, Imie FROM zwierzeta;";

                $result_ = $db->Query($sql_);
                while ($row = mysqli_fetch_array($result_)) {
                    $id_ = $row['ID_Zwierza'];
                    echo "<option value='$id_'>" . $row['ID_Zwierza'] . ": " . $row['Imie'] . "</option>";
                }

                ?>
            </select><br />

            Kiedy:
            <input type='date' name='kiedy' value='<?php echo $result['Kiedy']; ?>' required /><br />
            <input type="hidden" name="id" value="<?php echo $id; ?>" required />
            <input type='submit' value='Zmień rekord' />
        </form>
<?php
    }
}

function OutList()
{
}

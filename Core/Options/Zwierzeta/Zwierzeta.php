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
    <form method='POST' action='./Options/Zwierzeta/Zwierzeta_insert.php'>
        Rodzaj zwierza:
        <input type='text' name='rodzaj' required /><br />
        Imie:
        <input type='text' name='imie' required /><br />
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
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID_Zwierza'];
        echo $id . " " . $row['Imie'] . " " . $row['Data_urodzin'] . " <a href='modification.php?Option=Zwierzeta&id=$id'>Edytuj</a><br/>";
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Zwierzeta WHERE ID_Zwierza=$id;";
        $result = mysqli_fetch_array($db->Query($sql));

    ?>
        <form method='POST' action='./Options/Zwierzeta/Zwierzeta_modification.php'>
            Rodzaj zwierza:
            <input type='text' name='rodzaj' value='<?php echo $result['Rodzaj_zwierza']; ?>' required /><br />
            Imie:
            <input type='text' name='imie' value='<?php echo $result['Imie']; ?>' required /><br />
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
            <input type='submit' value='Zmień rekord' />
        </form>
<?php
    }
}

function OutList()
{
}

<?php
define("ACCESS", 'access');
define("AUTH_YES", 1);
define("AUTH_NO", 0);

define("ADDR", 'localhost');
define("LOGIN", 'root');
define("PASSWD", '');
define("CORE_DB", 'portablezoo');
define("AUTH_DB", 'portablezooauth');

define("USER_NAME", 'user_name');

define("HEADER_PRE_INDEX_PHP", "location: ../index.php");
define("PRE_INDEX_PHP", "../index.php");
define("PRE3_INDEX_PHP", "../../../index.php");
define("HEADER_LOGIN_PHP", "location: ./login.php");
define("LOGIN_PHP", "./login.php");
define("HEADER_AUTH_LOGIN_PHP", "location: ./auth/login.php");

function ShowAlert($text, $location)
{
    echo "
    <script>
        alert('" . $text . "');
        window.location.href='" . $location . "';
    </script>";
}

function ShowSelect($url_name, $db, $table)
{
?>
    <select name="<?php echo $url_name; ?>" required>
        <?php
        $rows = $db->GetColumnNames($table);
        foreach ($rows as $row) {
            $name = $row[0];
            echo "<option value=$name>$name</option>";
        }

        ?>
    </select>
<?php
}

function ShowSelectWithArrays($syms, $names, $type)
{
    for ($i = 0; $i < count($syms); $i++) {
        if ($_GET[$type] == $syms[$i]) {
            echo "<option value='" . $syms[$i] . "' selected>" . $names[$i] . "</option>";
        } else {
            echo "<option value='" . $syms[$i] . "'>" . $names[$i] . "</option>";
        }
    }
}

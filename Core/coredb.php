<?php
class CoreDatabase
{
    private $mysqli;
    private static $instance;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function Query($sql)
    {
        return $this->mysqli->query($sql);
    }

    public function MultiQuery($sql)
    {
        return $this->mysqli->multi_query($sql);
    }

    public function CreateTables()
    {
        if (!$this->CheckIfDatabaseIsCreated()) {
            ShowAlert("Najpierw utwórz bazę danych!", PRE_INDEX_PHP);
            return;
        }

        $sql = fopen("./tables.sql", "r") or die("Błąd przy otwieraniu pliku!");

        $this->MultiQuery(fread($sql, filesize("./tables.sql")));
        fclose($sql);
    }

    private function CheckIfDatabaseIsCreated()
    {
        $sql = "SELECT COUNT(SCHEMA_NAME) FROM information_schema.SCHEMATA WHERE SCHEMA_NAME='portablezoo';";

        $result = mysqli_fetch_array($this->Query($sql))[0];
        if ($result == 0) {
            return false;
        }

        return true;
    }

    public function CreateDatabase()
    {
        $db = "portablezoo";
        $sql = "CREATE DATABASE IF NOT EXISTS " . $db;
        $this->Query($sql);

        $this->mysqli->select_db($db);
    }

    private function __construct()
    {
        $login = "root";
        $passwd = "";
        $addr = "localhost";
        $this->mysqli = new mysqli($addr, $login, $passwd);
        $this->CreateDatabase();

        /*
        if (isset($_SESSION['db']) && !isset($_SESSION['creation'])) {
          if (!$this->CheckIfDatabaseIsCreated()) {
            ShowAlert("Najpierw utwórz bazę danych!", PRE_INDEX_PHP);
            return;
          }

          $this->mysqli->select_db($_SESSION['db']);
        }*/
    }
}

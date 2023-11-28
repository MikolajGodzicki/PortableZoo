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
        $sql = fopen("./tables.sql", "r") or die("Błąd przy otwieraniu pliku!");

        $this->MultiQuery(fread($sql, filesize("./tables.sql")));
        fclose($sql);
    }

    public function CheckIfDatabaseIsCreated()
    {
        $sql = "SELECT COUNT(SCHEMA_NAME) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='" . CORE_DB . "';";

        $result = mysqli_fetch_array($this->Query($sql))[0];
        if ($result == 0) {
            return false;
        }

        return true;
    }

    public function CheckIfTableIsCreated($table)
    {
        $sql = "SELECT COUNT(TABLE_NAME) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . CORE_DB . "' AND  TABLE_NAME = '" . $table . "';";

        $result = mysqli_fetch_array($this->Query($sql))[0];
        if ($result == 0) {
            return false;
        }

        return true;
    }

    public function CreateDatabase()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS " . CORE_DB;
        $this->Query($sql);

        $this->mysqli->select_db(CORE_DB);
    }

    private function __construct()
    {
        $this->mysqli = new mysqli(ADDR, LOGIN, PASSWD);

        if ($this->CheckIfDatabaseIsCreated()) {
            //ShowAlert("Najpierw utwórz bazę danych!", PRE_INDEX_PHP);
            $this->mysqli->select_db(CORE_DB);
            return;
        }
    }
}

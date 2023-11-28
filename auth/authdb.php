<?php
class AuthDatabase
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

    private function CreateDatabase()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS " . AUTH_DB;
        $this->Query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS portablezooauth.users (
            id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            login varchar(256) NOT NULL,
            password varchar(256) NOT NULL
        );";
        $this->Query($sql);
    }

    public function Query($sql)
    {
        return $this->mysqli->query($sql);
    }

    public function MultiQuery($sql)
    {
        return $this->mysqli->multi_query($sql);
    }

    private function __construct()
    {
        $this->mysqli = new mysqli(ADDR, LOGIN, PASSWD);
        $this->CreateDatabase();
        $this->mysqli->select_db(AUTH_DB);
    }
}

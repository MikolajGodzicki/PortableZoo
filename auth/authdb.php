<?php
class AuthDatabase {
    private $mysqli;
    private static $instance;
  
    public static function get_instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    private function CreateDatabase($db)
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $db";
        $this->Query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS portablezooauth.users (
            id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            login varchar(256) NOT NULL,
            password varchar(256) NOT NULL
        );";
        $this->Query($sql);
    }

    public function Query($sql) {
        return $this->mysqli->query($sql);
    }

    public function MultiQuery($sql) {
        return $this->mysqli->multi_query($sql);
    }
  
    private function __construct() {
        $login = "root";
        $passwd = "";
        $addr = "localhost";
        $db = "portablezooauth";
        $this->mysqli = new mysqli($addr,$login,$passwd);
        $this->CreateDatabase($db);
        $this->mysqli->select_db($db);
    }
}
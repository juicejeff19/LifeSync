<?php
class Database {
    private $host = "k2fqe1if4c7uowsh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db_name = "f5c0mg0wpgh3tp94";
    private $username = "e2tauja07ogzxdht";
    private $password = "fi3kzuvhi1dhuwtw";
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}


/*class Database {
    private $host = "localhost";
    private $db_name = "lfdb";
    private $username = "root";
    private $password = "password";
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}*/
?>
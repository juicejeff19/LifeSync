<?php
//Get Heroku ClearDB connection information
$jawsdb_url = parse_url(getenv("JAWSDB_URL"));
$cleardb_server = $jawsdb_url["host"];
$cleardb_username = $jawsdb_url["user"];
$cleardb_password = $jawsdb_url["pass"];
$cleardb_db = substr($jawsdb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


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
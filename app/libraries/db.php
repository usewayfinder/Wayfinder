<?php

require_once(realpath(dirname(__FILE__)).'/../conf/db.php');

class DB {

    private $servername, $username, $password, $db, $conn;

    function __construct() {
        $this->servername = SERVER_ADDRESS;
        $this->username = USER_NAME;
        $this->password = PASSWORD;
        $this->db = DB_NAME;

        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        // set content to by utf8 compatible
        mysqli_set_charset($this->conn, 'utf8mb4');

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public function query($sql) {
        $content = false;
        $sql = $this->escape($sql);
        $results = $this->conn->query($sql);

        if($results->num_rows == 1) {
            $content = [$results->fetch_assoc()];
        } else if($results->num_rows > 1) {
            while($row = $results->fetch_assoc()) {
                $content[] = $row;
            }
        }
        return $content;
    }

    public function select($sql) {
        $this->query($sql);
        return $content;
    }

    public function lastInsertId() {
        return $this->conn->insert_id;
    }

    public function escape($string) {
        return mysqli_real_escape_string($this->conn, $string);
    }

    public function error() {
        return mysqli_error($this->conn);
    }

    public function info() {
        return mysqli_info($this->conn);
    }

    public function connection() {
        return $this->conn;
    }

}

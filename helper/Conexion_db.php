<?php

class Database
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this -> conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function query($sql){
        $result = mysqli_query($this -> conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function queryNotAll($sql){
        return mysqli_query($this -> conn, $sql);
    }

    public function execute($sql)
    {
        mysqli_query($this -> conn, $sql);
    }

    public function __destruct()
    {
        mysqli_close($this -> conn);
    }

    public function rollback() {
        mysqli_rollback($this->conn);
    }
    public function print($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}
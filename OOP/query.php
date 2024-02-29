<?php

const HOST = "127.0.0.1";
const USERNAME = "root";
const PASSWORD = "";
const SERVERNAME = "student_info";

class Query {
    private $connection;

    function __construct() {
        $mysql = new mysqli(HOST, USERNAME, PASSWORD, SERVERNAME);
        $this->connection = $mysql;

    }

    protected function query($sql) {
        try {
            $result = $this->connection->query($sql);

            return $result;
        } catch (\Throwable $th) {

            return $th;
        }

    }

    public function doesExist($id) {
        try {
            $sql = "SELECT * FROM students1 WHERE id = {$id}";
            
            
            $result = $this->connection->query($sql);

            return $result;


        } catch (\Throwable $th) {
            throw $th;
        }

    }
}

?>


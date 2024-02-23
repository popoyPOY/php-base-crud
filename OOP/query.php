<?php

const HOST = "127.0.0.1";
const USERNAME = "root";
const PASSWORD = "";
const SERVERNAME = "student_info";

class Query {
    private $POST = "127.0.0.1";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $SERVER_NAME = "student_info";

    function __construct() {
        $this->connection = new mysqli($HOST, $USERNAME, $PASSWORD, $SERVER_NAME);
    }

    private function Query($data) {
        $connection = new mysqli($HOST, $USERNAME, $PASSWORD, $SERVER_NAME);

        if ($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }
    
        $result = $connection->query($sql);
    
        return $result;
    }

    private function doesExist($id) {}
}


function Query($sql) {

}

function isExist($id) {
    echo $this->connection;
    if ($this->connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM students where ID = {$id}";

    $result = $this->connection->query($sql); 

    $fetch = $result->fetch_all();

    return $fetch;
}


$query = Query(1)->isExist(3);

?>


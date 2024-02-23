<?php

const HOST = "127.0.0.1";
const USERNAME = "root";
const PASSWORD = "";
const SERVERNAME = "student_info";


function Query($sql) {



    $connection = new mysqli(HOST, USERNAME, PASSWORD, SERVERNAME);

    if ($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $result = $connection->query($sql);

    return $result;
}

function isExist($id) {

    $connection = new mysqli(HOST, USERNAME, PASSWORD, SERVERNAME);


    if ($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM students where ID = {$id}";

    $result = $connection->query($sql); 

    $fetch = $result->fetch_all();


    return $fetch;
}
?>


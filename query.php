<?php


function Query($sql) {
    $HOST = "127.0.0.1";
    $USERNAME = "root";
    $PASSWORD = "";
    $SERVERNAME = "student_info";


    $connection = new mysqli($HOST, $USERNAME, $PASSWORD, $SERVERNAME);

    if ($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $result = $connection->query($sql);

    return $result;
}

function isExist($id) {
    $HOST = "127.0.0.1";
    $USERNAME = "root";
    $PASSWORD = "";
    $SERVERNAME = "student_info";

    $connection = new mysqli($HOST, $USERNAME, $PASSWORD, $SERVERNAME);


    if ($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM students where ID = {$id}";

    $result = $connection->query($sql); 

    $fetch = $result->fetch_all();


    return $fetch;
}
?>


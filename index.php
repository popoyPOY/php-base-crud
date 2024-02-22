<?php

include './query.php';
include './response.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {
 
 
    if (count($_GET) != 0) {
        $param = $_GET["id"];
        $sql = "SELECT * FROM students WHERE id = ".$param."";
        
        $data = Query($sql)->fetch_all();

        if ($data) {
            foreach($data as $row) {
                echo "id: " . $row[0]. " - school_id: " . $row[1]. " " . $row[2]. " ".$row[3]." ".$row[4]." birthday: ".$row[5]." gender: ".$row[6]." course: ".$row[7]." year: ".$row[8]." <br>";
            }
        }
        else {
            echo "Not found";
        }
    }
 
    else {
 
        $sql = "SELECT * FROM students";
 
        $data = Query($sql)->fetch_all();
 
        foreach($data as $row) {
            echo "<h1>id: " . $row[0]. " - school_id: " . $row[1]. " " . $row[2]. " ".$row[3]." ".$row[4]." birthday: ".$row[5]." gender: ".$row[6]." course: ".$row[7]." year: ".$row[8]." <br>";
        }
 
    }
 
}
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data) {


        $sql = "INSERT INTO students (id, school_id, first_name, middle_initial, last_name, birthday, gender, course, year) VALUES (NULL, {$data["school_id"]}, '{$data["first_name"]}', '{$data["middle_initial"]}', '{$data["last_name"]}', '{$data["birthday"]}', '{$data["gender"]}', '{$data["course"]}', '{$data["year"]}' )";



        $query = Query($sql);

        if($query) {
            echo "Data Added";
        } else
        {
            echo "Error"; 
        }
        
    }
}
 
 
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $json = file_get_contents('php://input');
 
    $data = json_decode($json, true);


    if ($data) {

        try {
            if(isExist($data["id"])) {
                $sql = "UPDATE `students` SET `school_id`='{$data["school_id"]}',`first_name`='{$data["first_name"]}',`middle_initial`='{$data["middle_initial"]}',`last_name`='{$data["last_name"]}',`birthday`='{$data["birthday"]}',`gender`='{$data["gender"]}',`course`='{$data["course"]}',`year`='{$data["year"]}' WHERE id={$data["id"]}";
    
                $query = Query($sql);
    
    
                if($query) {
                    echo "Data Updated";
                } else
                {
                    echo "Error"; 
                }
                }
            else 
            {
                NOT_FOUND();
            }
        } catch (\Throwable $th) {
            NOT_FOUND();
        }

    }
}
 
 
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    $id = $data["id"];

    if(isExist($id)) {
        $sql = "DELETE FROM students WHERE id = {$id}";
        if(Query($sql)) {
            $HTTP_OK;
            echo "DELETED";
        }
        else { 
            echo "NOT DELETED";
        }
    }
    else {
        echo "THIS BRO NOT EXIST";
    }
}
 
?>

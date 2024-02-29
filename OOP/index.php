<?php

include 'query.php';


class Student extends Query {

    function __construct() {
        parent::__construct();
    }

    public function getStudents($id=0) {
        try {
            $doesExist = $this->doesExist($id)->{"num_rows"};

            #var_dump($doesExist->{"num_rows"});
            
            if ($doesExist) return $this->query("SELECT * FROM students1 WHERE id = {$id}")->fetch_all();  
            
            if ($doesExist == 0) return $this->query("SELECT * FROM students1")->fetch_all();      
            
            return "ID: {$id} does not exist";
            
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function createStudents($data) {

        try {
            $sql = "INSERT INTO students1 (id, school_id, first_name, middle_initial, last_name, birthday, gender, course, year) VALUES (NULL, {$data["school_id"]}, '{$data["first_name"]}', '{$data["middle_initial"]}', '{$data["last_name"]}', '{$data["birthday"]}', '{$data["gender"]}', '{$data["course"]}', '{$data["year"]}' )";

            $query = $this->query($sql);

            if($query) return $query;

            
            return "Error";
            
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function updateStudents($data) {

        try {
            $sql = "UPDATE `students1` SET `school_id`='{$data["school_id"]}',`first_name`='{$data["first_name"]}',`middle_initial`='{$data["middle_initial"]}',`last_name`='{$data["last_name"]}',`birthday`='{$data["birthday"]}',`gender`='{$data["gender"]}',`course`='{$data["course"]}',`year`='{$data["year"]}' WHERE id={$data["id"]}";

            $doesExist = $this->doesExist($data["id"])->{"num_rows"};
    
    
            if($doesExist) return $this->query($sql);
    
            return "Error";

        } catch (\Throwable $th) {
            return $th;
        }

    }


    public function deleteStudents($data) {
        try {
            $doesExist = $this->doesExist($data["id"])->{"num_rows"};

            $id = $data["id"];
            $sql = "DELETE FROM students1 WHERE id = {$id}";


            if($doesExist) return $this->query($sql);

            return "DOES NOT EXIST";

        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}


$student = new Student();



if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (count($_GET) != 0)
    {

        $param = $_GET["id"];
        $information = $student->getStudents($param);


        foreach($information as $row) {
            echo "id: " . $row[0]. " - school_id: " . $row[1]. " " . $row[2]. " ".$row[3]." ".$row[4]." birthday: ".$row[5]." gender: ".$row[6]." course: ".$row[7]." year: ".$row[8]." <br>";
        }
    }
    else 
    {
        $information = $student->getStudents();


        foreach($information as $row) {
            echo "id: " . $row[0]. " - school_id: " . $row[1]. " " . $row[2]. " ".$row[3]." ".$row[4]." birthday: ".$row[5]." gender: ".$row[6]." course: ".$row[7]." year: ".$row[8]." <br>";
        }

    }
 
}
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data) {
        $sd = $student->createStudents($data);

        echo "updated";
    }
    else {
        return "Error";
    }



}
 
 
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $json = file_get_contents('php://input');
 
    $data = json_decode($json, true);

    if ($data) {
        $sd = $student->updateStudents($data);

        echo "added";
    }
    else {
        return "Error";
    }

}
 
 
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);


    if ($data) {
        $sd = $student->updateStudents($data);

        echo "deleted";
    }
    else {
        return "Error";
    }


}

?>
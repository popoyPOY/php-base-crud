<?php
include './query.php';


class Request {
     public function getStudents($name='') {
          try {
               if($name) {
                    $query = "SELECT * FROM students WHERE first_name OR last_name LIKE '{$name}'";

                    $data = Query($query)->fetch_all();
     
                    return $data;
               }
               else {
                    $query = "SELECT * FROM students";
                    $data = Query($query)->fetch_all();

                    return $data;
               }

          } catch (\Throwable $th) {
               return $th;
          }
     }

     public function addStudent($data) {
          try {
               $sql = "INSERT INTO students (id, school_id, first_name, middle_initial, last_name, birthday, gender, course, year) VALUES (NULL, {$data["school_id"]}, '{$data["first_name"]}', '{$data["middle_initial"]}', '{$data["last_name"]}', '{$data["birthday"]}', '{$data["gender"]}', '{$data["course"]}', '{$data["year"]}' )";

               $query = Query($sql);

               if($query) {
                   return $query;
               } else
               {
                   return "Error"; 
               }

          } catch (\Throwable $th) {
               throw $th;
          }

     }

     public function updateStudent($data) {
          try {
               $sql = "UPDATE `students` SET `school_id`='{$data["school_id"]}',`first_name`='{$data["first_name"]}',`middle_initial`='{$data["middle_initial"]}',`last_name`='{$data["last_name"]}',`birthday`='{$data["birthday"]}',`gender`='{$data["gender"]}',`course`='{$data["course"]}',`year`='{$data["year"]}' WHERE id={$data["id"]}";
    
               $query = Query($sql);

               if($query) {
                    return $query;
                } else
                {
                    return "Error"; 
                }
               
          } catch (\Throwable $th) {
               throw $th;
          }

     }


     public function deleteStudent($id) {
          try {
               $sql = "DELETE FROM students WHERE id = {$id}";
               if(Query($sql)) {
                   return "DELETED";
               }
               else { 
                   return "NOT DELETED";
               }
          } catch (\Throwable $th) {
               throw $th;
          }
     }

}


$json = file_get_contents('php://input');

$request = json_decode($json, true);

$obj = new Request();

$data = $obj->deleteStudent(3);

?>
<?php
include '../dbconfig.php';
session_start();
print_r($_POST);

$type = array("คุณครู", "ผู้ปกครอง");
$class_id = $_POST['class_id'];

$sql_class = "SELECT student_id FROM class_student WHERE class_id = '$class_id'";
$result = mysqli_query($conn, $sql_class);
if ($result) {
    foreach ($result as $row) {

        foreach ($type as $value) {

            $sql = "INSERT INTO sdq (student_id, class_id,type ) 
 VALUES ('$row[student_id]','$class_id','$value');";
            $rs = mysqli_query($conn, $sql);
            if ($rs) {
                echo "Add Successful";
            } else {
                echo "Add Failed";
            }
        }
    }
}

else{
    echo "No data";
}

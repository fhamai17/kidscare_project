<?php
session_start();
include '../dbconfig.php';

$back_date = $_POST['back_date'];
$std_array = $_POST['student_id'];
$parent_id = $_SESSION['user_id'];

print_r($_POST);
foreach ($std_array as $value){


$sql_class = "SELECT class_id from student 
WHERE student_id = '$value'";
$rs_class = mysqli_query($conn, $sql_class);
$row = mysqli_fetch_array($rs_class);
$class_id = $row['class_id'];
echo $sql_class;
$sql = "INSERT INTO backhome (backdate, student_id,class_id,parent_id,parent_update_time) 
VALUES ('$back_date', '$value','$class_id', '$parent_id', NOW());";
echo $sql;
$rs = mysqli_query($conn, $sql);
if ($rs) {
    echo "Add Successful";
} else {
    echo "Add Failed";
}


}

<?php
session_start();
include '../dbconfig.php';
$relation = $_POST['relation'];
$parent = $_SESSION['user_id'];
$student_id = $_POST['student'];
$other = $_POST['other'];
if($relation==="อื่นๆ"){
    $relation = $other;
}
print_r($_POST);
$sql = "INSERT INTO parent_relation (parent_id,relation,student_id,request_time)
VALUES('$parent','$relation','$student_id',NOW())";

$rs = mysqli_query($conn, $sql);
if($rs){
echo "Add Successful";
}else
{
echo "Add Failed";
}

?>



<?php
session_start();
include '../dbconfig.php';

$id = $_POST['id'];
$relation = $_POST['relation'];
$parent = $_SESSION['user_id'];
$student_id = $_POST['student'];
$other = $_POST['other'];
if($relation==="อื่นๆ"){
    $relation = $other;
}
print_r($_POST);
$sql = "UPDATE parent_relation SET parent_id='$parent', 
student_id ='$student_id', relation='$relation'
WHERE id = $id";


$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>



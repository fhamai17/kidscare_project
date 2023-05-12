<?php
session_start();
include '../dbconfig.php';


print_r($_POST);
$id = $_POST['id'];
$back_date = $_POST['back_date'];
$student_id = $_POST['student_id'];
$parent_id = $_SESSION['user_id'];

$sql = "UPDATE backhome SET backdate='$back_date',student_id='$student_id',
parent_id='$parent_id' ,parent_update_time=NOW()
WHERE id = '$id'";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}


?>

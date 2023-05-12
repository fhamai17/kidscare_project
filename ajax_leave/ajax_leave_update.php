<?php
include '../dbconfig.php';
session_start();
$id = $_POST['leave_id'];
$student_id = $_POST['student_id'];
$leave_type = $_POST['leave_type'];
$start_date = $_POST['start_date'];
$end_date =  $_POST['end_date'];
$days = $_POST['days'];
$reason = $_POST['reason'];
print_r($_POST);



$sql_class = "SELECT class_id FROM student WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $sql_class);
if ($result) {
    $row = mysqli_fetch_array($result);
    $class_id = $row['class_id'];

    $sql = "UPDATE student_leave SET student_id='$student_id' ,class_id = '$class_id',
    type = '$leave_type',start_date = '$start_date',
    end_date = '$end_date',days = '$days',reason = '$reason',
    parent_id = '$_SESSION[user_id]',isApprove = NULL ,parent_create_time=NOW()
    WHERE leave_id = $id";
    $rs = mysqli_query($conn, $sql);
    if($rs){
    echo "Update Successful";
    }else
    {
    echo "Update Failed";
    }
}




?>


